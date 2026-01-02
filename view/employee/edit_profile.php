<?php

// Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
session_start();
require_once "../../controller/Main.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.php");
    exit;
}

$db = new db();
$userId = $_SESSION['user_id'];
$user = $db->getEmployeeById($userId);

// If form submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $firstname  = trim($_POST['firstname']);
    $middlename = trim($_POST['middlename']);
    $lastname   = trim($_POST['lastname']);
    $email      = trim($_POST['email']);
    $address    = trim($_POST['address']);

    // Email validation: must end with @dmmmsu.edu.ph
    if (!preg_match('/^[a-zA-Z0-9._%+-]+@dmmmsu\.edu\.ph$/', $email)) {
        $error = "Email must end with @dmmmsu.edu.ph.";
    } else {
        $updated = $db->updateEmployeeProfile($userId, $firstname, $middlename, $lastname, $email, $address);

        if ($updated) {
            // Update session values immediately
            $_SESSION['fullname'] = trim($firstname . ' ' . $lastname);

            // Get updated type name from DB (optional, in case type changes)
            $userUpdated = $db->getEmployeeById($userId);
            $_SESSION['typeName'] = $userUpdated['typename'] ?? $_SESSION['typeName'];

            // Set success message for SweetAlert in profile.php
            $_SESSION['message'] = "Profile updated successfully.";

            // Redirect to profile page
            header("Location: profile.php");
            exit;
        } else {
            $error = "Failed to update profile.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background: #f3f6fa;
            min-height: 100vh;
            padding: 30px;
            font-family: "Inter", sans-serif;
        }

        .form-wrapper {
            max-width: 650px;
            margin: 0 auto;
            border: 2px solid gray;
            padding: 35px;
            border-radius: 20px;
            background: #ffffffaa;
            backdrop-filter: blur(6px);
        }

        .page-title {
            font-weight: 700;
            margin-bottom: 25px;
        }

        .btn-custom {
            padding: 10px 18px;
            border-radius: 10px;
        }
    </style>
</head>

<body>

    <div class="form-wrapper">

        <h2 class="page-title">Edit Profile</h2>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST">

            <div class="mb-3">
                <label class="form-label">First Name</label>
                <input type="text" name="firstname" class="form-control" value="<?= htmlspecialchars($user['firstname']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Middle Name</label>
                <input type="text" name="middlename" class="form-control" value="<?= htmlspecialchars($user['middlename']); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Last Name</label>
                <input type="text" name="lastname" class="form-control" value="<?= htmlspecialchars($user['lastname']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control"
                    value="<?= htmlspecialchars($user['email']); ?>"
                    required
                    pattern="^[a-zA-Z0-9._%+-]+@dmmmsu\.edu\.ph$"
                    title="Email must end with @dmmmsu.edu.ph">

            </div>

            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control" rows="2"><?= htmlspecialchars($user['address']); ?></textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="profile.php" class="btn btn-outline-secondary btn-custom">Cancel</a>
                <button type="submit" class="btn btn-primary btn-custom">Save Changes</button>
            </div>

        </form>

    </div>

</body>

</html>