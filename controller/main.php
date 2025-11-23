<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

class db
{
    private $con;

    public function __construct()
    {
        $this->con = mysqli_connect('localhost', 'root', '', 'srdi_system', 3306);
        if (!$this->con) {
            die("Database connection failed: " . mysqli_connect_error());
        }
    }

    public function getConnection()
    {
        return $this->con;
    }

    // Check if email already exists
    public function isEmailExists($email)
    {
        $email = $this->con->real_escape_string($email);
        $query = "SELECT email FROM employee WHERE email = '$email' LIMIT 1";
        $result = $this->con->query($query);

        if (!$result) {
            die("Query Failed: " . $this->con->error);
        }

        return $result->num_rows > 0;
    }

    // Register a new user (NO ROLE)
    public function registerUser($firstname, $middlename, $lastname, $email, $password, $address)
    {
        $firstname  = $this->con->real_escape_string($firstname);
        $middlename = $this->con->real_escape_string($middlename);
        $lastname   = $this->con->real_escape_string($lastname);
        $email      = $this->con->real_escape_string($email);
        $address    = $this->con->real_escape_string($address);

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Type_id = 1, status_id = 1
        $type_id = 1;
        $status_id = 1;

        $stmt = $this->con->prepare("
            INSERT INTO employee
            (firstname, middlename, lastname, email, password, address, type_id, status_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->bind_param(
            "ssssssii",
            $firstname,
            $middlename,
            $lastname,
            $email,
            $hashedPassword,
            $address,
            $type_id,
            $status_id
        );

        $success = $stmt->execute();

        if ($success) {
            $userId = $this->con->insert_id;
            $this->insertLog($userId, 'User registered');

            // Insert a notification for the new user
            $this->insertNotification($userId, "Welcome, $firstname! Your account has been created.");
        }

        return $success;
    }

    // Insert a notification
    public function insertNotification($user_id, $message)
    {
        $user_id = (int)$user_id;
        $message = $this->con->real_escape_string($message);

        $stmt = $this->con->prepare("
            INSERT INTO notifications (user_id, message, status, created_at) 
            VALUES (?, ?, 0, NOW())
        ");
        $stmt->bind_param("is", $user_id, $message);

        return $stmt->execute();
    }


    // Login check
    public function checkUsers($email, $password)
    {
        $email = $this->con->real_escape_string($email);

        $query = "SELECT * FROM employee WHERE email = '$email' LIMIT 1";
        $result = $this->con->query($query);

        if (!$result) {
            die("Query Failed: " . $this->con->error);
        }

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {

                $status = (int)$user['status_id'];
                $typeId = (int)$user['type_id'];

                // Map type_id to role name
                $roleName = match ($typeId) {
                    1 => 'Researcher',
                    2 => 'Section Head',
                    3 => 'Division Chief',
                    4 => 'Admin',
                    default => 'Unknown'
                };

                // Add role name to the user array
                $user['role_name'] = $roleName;

                // Return user array if status is approved
                if ($status === 2) {
                    $this->insertLog($user['id'], 'User logged in');
                    return $user;
                } elseif ($status === 1) {
                    $this->insertLog($user['id'], 'Pending login attempt');
                    return ['error' => 'pending', 'message' => 'Your account is pending approval.'];
                } else {
                    $this->insertLog($user['id'], 'Rejected login attempt');
                    return ['error' => 'rejected', 'message' => 'Your account is rejected or inactive.'];
                }
            } else {
                return ['error' => 'invalid', 'message' => 'Incorrect password.'];
            }
        } else {
            return ['error' => 'notfound', 'message' => 'User not found.'];
        }
    }


    // Insert activity log
    public function insertLog($user_id, $activity)
    {
        $user_id = (int) $user_id;
        $activity = $this->con->real_escape_string($activity);

        $stmt = $this->con->prepare("INSERT INTO activity_logs (activities, user_id) VALUES (?, ?)");
        $stmt->bind_param("si", $activity, $user_id);

        return $stmt->execute();
    }

    public function getResearchStatusCounts($user_id = null)
    {
        if ($user_id !== null) {
            $query = "SELECT status_id, COUNT(*) AS total FROM research WHERE user_id = ? GROUP BY status_id";
            $stmt = $this->con->prepare($query);
            $stmt->bind_param("i", $user_id);
        } else {
            $query = "SELECT status_id, COUNT(*) AS total FROM research GROUP BY status_id";
            $stmt = $this->con->prepare($query);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $statusMap = [1 => 'pending', 2 => 'approved', 3 => 'revised', 4 => 'cancelled', 5 => 'published'];
        $counts = array_fill_keys(array_values($statusMap), 0);

        while ($row = $result->fetch_assoc()) {
            $id = (int)$row['status_id'];
            if (isset($statusMap[$id])) $counts[$statusMap[$id]] = (int)$row['total'];
        }

        $stmt->close();
        return $counts;
    }

    public function getMonthlyResearchCounts($year, $user_id = null)
    {
        if ($user_id !== null) {
            $query = "SELECT MONTH(created_at) AS month, COUNT(*) AS total FROM research WHERE YEAR(created_at)=? AND user_id=? GROUP BY MONTH(created_at)";
            $stmt = $this->con->prepare($query);
            $stmt->bind_param("ii", $year, $user_id);
        } else {
            $query = "SELECT MONTH(created_at) AS month, COUNT(*) AS total FROM research WHERE YEAR(created_at)=? GROUP BY MONTH(created_at)";
            $stmt = $this->con->prepare($query);
            $stmt->bind_param("i", $year);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[(int)$row['month']] = (int)$row['total'];
        }

        $stmt->close();
        return $data;
    }

    public function getAllResearch($user_id = null)
    {
        $query = "SELECT r.*, e.firstname AS leader_firstname, e.lastname AS leader_lastname
              FROM research r
              LEFT JOIN employee e ON r.user_id = e.id";

        if ($user_id !== null) $query .= " WHERE r.user_id=?";
        $query .= " ORDER BY r.created_at DESC";

        $stmt = $this->con->prepare($query);
        if ($user_id !== null) $stmt->bind_param("i", $user_id);

        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) $data[] = $row;

        $stmt->close();
        return $data;
    }



    public function getNotifications($user_id, $type_id, $limit = 10)
    {
        if ($type_id == 1) {
            // Employee: only their own notifications
            $sql = "SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC LIMIT ?";
            $stmt = $this->con->prepare($sql);
            $stmt->bind_param("ii", $user_id, $limit);
        } else {
            // Other roles: see all notifications
            $sql = "SELECT * FROM notifications ORDER BY created_at DESC LIMIT ?";
            $stmt = $this->con->prepare($sql);
            $stmt->bind_param("i", $limit);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $notifications = [];
        while ($row = $result->fetch_assoc()) {
            $notifications[] = $row;
        }

        $stmt->close();
        return $notifications;
    }




    public function getEmployees()
    {
        $sql = "SELECT firstname, lastname FROM employee ORDER BY firstname ASC, lastname ASC";
        $result = $this->con->query($sql);
        $employees = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $employees[] = $row;
            }
        }
        return $employees;
    }


    public function uploadResearch($title, $description, $members, $file_name, $user_id, $user_type, $startDate, $endDate)
    {
        // Use session fullname as uploader name
        $uploaderName = isset($_SESSION['fullname']) ? $_SESSION['fullname'] : 'You';

        // Insert research including user_id as the research leader
        $stmt = $this->con->prepare(
            "INSERT INTO research 
        (title, description, member, filePath, startDate, endDate, status_id, type_id, user_id, created_at, updated_at)
        VALUES (?, ?, ?, ?, ?, ?, 1, ?, ?, NOW(), NOW())"
        );
        $stmt->bind_param("ssssssis", $title, $description, $members, $file_name, $startDate, $endDate, $user_type, $user_id);
        $success = $stmt->execute();

        if ($success) {
            // 1️⃣ Insert notification for the uploader themselves
            $this->insertNotification($user_id, "New research uploaded by You: {$title}");

            // 2️⃣ Insert notifications for all employees with type_id 2 or 4
            $result = $this->con->query("SELECT id, type_id FROM employee WHERE type_id IN (2, 4)");
            if ($result) {
                while ($user = $result->fetch_assoc()) {
                    $messageToSend = "New research uploaded by {$uploaderName}: {$title}";
                    $this->insertNotification($user['id'], $messageToSend);
                }
            }
        }

        $stmt->close();
        return $success;
    }

    // Fetch all research by status_id
    public function getResearchByStatus($status_id)
    {
        // Prepare the SQL statement
        $stmt = $this->con->prepare("SELECT * FROM research WHERE status_id = ? ORDER BY created_at DESC");
        if (!$stmt) {
            die("Prepare failed: " . $this->con->error);
        }

        // Bind the status_id parameter
        $stmt->bind_param("i", $status_id);

        // Execute the statement
        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }

        // Get the result set
        $result = $stmt->get_result();
        $research = $result->fetch_all(MYSQLI_ASSOC);

        // Close the statement
        $stmt->close();

        return $research;
    }

    public function getResearchForUser($user_id, $type_id)
    {
        if ($type_id == 1) {
            // Type 1 sees only their own research
            $stmt = $this->con->prepare("SELECT * FROM research WHERE user_id = ? ORDER BY created_at DESC");
            $stmt->bind_param("i", $user_id);
        } else {
            // Type 2,3,4 see all research
            $stmt = $this->con->prepare("SELECT * FROM research ORDER BY created_at DESC");
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $research = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $research;
    }

    // Update research status (Approve = 2, Revise = 3)
    public function updateResearchStatus($research_id, $status_id, $updatedByUserId)
    {
        // 1️⃣ Update research status and desisyon_id
        $stmt = $this->con->prepare("
        UPDATE research 
        SET status_id = ?, desisyon_id = ?, updated_at = NOW() 
        WHERE id = ?
    ");
        if (!$stmt) {
            die("Prepare failed: " . $this->con->error);
        }
        $stmt->bind_param("iii", $status_id, $updatedByUserId, $research_id);
        $success = $stmt->execute();
        $stmt->close();

        if (!$success) return false; // stop if update failed

        // 2️⃣ Fetch research info
        $stmt2 = $this->con->prepare("SELECT title, user_id FROM research WHERE id = ?");
        $stmt2->bind_param("i", $research_id);
        $stmt2->execute();
        $researchData = $stmt2->get_result()->fetch_assoc();
        $stmt2->close();

        if (!$researchData) return false;

        $researchOwnerId = $researchData['user_id'];
        $researchTitle = $researchData['title'];

        // 3️⃣ Fetch updater name
        $stmt3 = $this->con->prepare("SELECT firstname, lastname FROM employee WHERE id = ?");
        $stmt3->bind_param("i", $updatedByUserId);
        $stmt3->execute();
        $updater = $stmt3->get_result()->fetch_assoc();
        $stmt3->close();

        $updaterName = $updater ? $updater['firstname'] . ' ' . $updater['lastname'] : 'Unknown';

        // 4️⃣ Determine status text
        $statusText = $status_id == 2 ? "Approved" : ($status_id == 3 ? "Revised" : "Unknown");

        // 5️⃣ Insert notification for research owner
        $message = "Your research '{$researchTitle}' has been {$statusText} by {$updaterName})";
        $this->insertNotification($researchOwnerId, $message);

        // 6️⃣ Insert activity log for updater
        $activity = "Updated research '{$researchTitle}' status to {$statusText})";
        $this->insertLog($updatedByUserId, $activity);

        return true;
    }

    public function getResearchByStatuses(array $statuses): array
    {
        if (empty($statuses)) return [];

        // Prepare placeholders for IN clause
        $placeholders = implode(',', array_fill(0, count($statuses), '?'));

        $types = str_repeat('i', count($statuses)); // 'i' for integer
        $stmt = $this->con->prepare("SELECT * FROM research WHERE status_id IN ($placeholders) ORDER BY startDate DESC");

        if (!$stmt) {
            die("Prepare failed: " . $this->con->error);
        }

        // Bind parameters dynamically
        $stmt->bind_param($types, ...$statuses);
        $stmt->execute();
        $result = $stmt->get_result();
        $research = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();
        return $research;
    }
    public function getEmployeeName($id)
    {
        $stmt = $this->con->prepare("SELECT firstname, lastname FROM employee WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $res ? $res['firstname'] . ' ' . $res['lastname'] : 'Unknown';
    }

    public function updateResearchStatusExtended($research_id, $status_id, $updatedByUserId, $comment = null, $complianceFile = null)
    {
        $research_id = intval($research_id);
        $status_id = intval($status_id);
        $updatedByUserId = intval($updatedByUserId);

        if ($status_id == 2) { // Approved
            $stmt = $this->con->prepare("
            UPDATE research 
            SET status_id = ?, desisyon_id = ?, comment = NULL, compliance = NULL, updated_at = NOW()
            WHERE id = ?
        ");
            $stmt->bind_param("iii", $status_id, $updatedByUserId, $research_id);
            $stmt->execute();
            $stmt->close();
            $statusText = "Approved";
        } elseif ($status_id == 3 || $status_id == 4) { // Revised
            $stmt = $this->con->prepare("
            UPDATE research 
            SET status_id = ?, desisyon_id = ?, comment = ?, compliance = ?, updated_at = NOW()
            WHERE id = ?
        ");
            $stmt->bind_param("iissi", $status_id, $updatedByUserId, $comment, $complianceFile, $research_id);
            $stmt->execute();
            $stmt->close();
            $statusText = "Revised";
        } elseif ($status_id == 5) { // Published
            $stmt = $this->con->prepare("
            UPDATE research 
            SET status_id = ?, desisyon_id = ?, updated_at = NOW()
            WHERE id = ?
        ");
            $stmt->bind_param("iii", $status_id, $updatedByUserId, $research_id);
            $stmt->execute();
            $stmt->close();
            $statusText = "Published";
        } else {
            return false; // Unknown status
        }

        // Get research info
        $stmt2 = $this->con->prepare("SELECT title, user_id FROM research WHERE id = ?");
        $stmt2->bind_param("i", $research_id);
        $stmt2->execute();
        $info = $stmt2->get_result()->fetch_assoc();
        $stmt2->close();

        $owner = $info['user_id'];
        $title = $info['title'];

        $updater = $this->getEmployeeName($updatedByUserId);

        $message = "Your research '{$title}' has been {$statusText} by {$updater}.";

        $this->insertNotification($owner, $message);
        $this->insertLog($updatedByUserId, "Updated research '{$title}' to {$statusText}");

        return true;
    }
    // Update a specific employee's status
    public function updateEmployeeStatusById($id, $status)
    {
        $stmt = $this->con->prepare("UPDATE employee SET status_id = ? WHERE id = ? AND status_id = 1");
        $stmt->bind_param("ii", $status, $id);
        return $stmt->execute();
    }
    // In Main.php inside your db class
    public function getEmployeesByStatus($statusId = 1)
    {
        $statusId = intval($statusId); // sanitize input
        $sql = "SELECT * FROM employee WHERE status_id = $statusId";
        $result = $this->con->query($sql);

        $employees = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $employees[] = $row;
            }
        }
        return $employees;
    }

    // Update employee status
    // Update employee status with log and notification
    public function updateEmployeeStatus($id, $status_id, $admin_id = 0)
    {
        $id = intval($id);
        $status_id = intval($status_id);
        $admin_id = intval($admin_id); // The user performing the action

        // Get old status for logging
        $oldStatusResult = $this->con->query("SELECT status_id, firstname, lastname FROM employee WHERE id = $id");
        if (!$oldStatusResult || $oldStatusResult->num_rows == 0) {
            return false; // Employee not found
        }

        $row = $oldStatusResult->fetch_assoc();
        $oldStatus = $row['status_id'];
        $employeeName = $row['firstname'] . ' ' . $row['lastname'];

        // Update employee status
        $updateSql = "UPDATE employee SET status_id = $status_id, updated_at = NOW() WHERE id = $id";
        $success = $this->con->query($updateSql);

        if ($success) {
            // Determine status text
            $statusText = $status_id == 2 ? 'Approved' : ($status_id == 3 ? 'Rejected' : 'Updated');

            // Insert activity log
            $activity = "Changed status of $employeeName from $oldStatus to $statusText";
            $this->insertLog($admin_id, $activity);

            // Insert notification for employee
            $notifMessage = "Your account status has been $statusText by admin.";
            $this->insertNotification($id, $notifMessage);
        }

        return $success;
    }
}
