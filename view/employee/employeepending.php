<?php
session_start();
require_once "../../controller/Main.php";

$fullname = $_SESSION['fullname'] ?? 'User';
$user_id = $_SESSION['user_id'] ?? 0;
$type_id = $_SESSION['type_id'] ?? 0;

$db = new db();

// Only allow admin
if ($type_id != 4) {
    header("Location: ../../auth/login.php");
    exit;
}

$alert = null;

// Handle approve/reject actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['employee_id'], $_POST['action'])) {
        $empId = intval($_POST['employee_id']);
        $action = $_POST['action']; // "approve" or "reject"

        $newStatus = $action === 'approve' ? 2 : 3; // 2=Approved, 3=Rejected
        $success = $db->updateEmployeeStatus($empId, $newStatus, $user_id);

        if ($success) {
            $alert = [
                'icon' => 'success',
                'title' => ucfirst($action) . 'd!',
                'text' => "Employee status has been updated."
            ];
        } else {
            $alert = [
                'icon' => 'error',
                'title' => 'Failed',
                'text' => 'Unable to update employee status.'
            ];
        }
    }
}

// Fetch pending employees
$pendingEmployees = $db->getEmployeesByStatus(1); // 1 = pending
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'partials/header.php'; ?>

<body class="sb-nav-fixed">
    <?php include 'partials/navbar.php'; ?>
    <div id="layoutSidenav">
        <?php include 'partials/sidebar.php'; ?>
        <div id="layoutSidenav_content">
            <main class="container-fluid px-4">
                <h1 class="mt-4">Pending Employees</h1>

                <?php if ($pendingEmployees): ?>
                    <div class="card mb-4">
                        <div class="card-header"><i class="fas fa-users"></i> Pending Employees</div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pendingEmployees as $emp): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($emp['firstname'] . ' ' . $emp['lastname']) ?></td>
                                            <td><?= htmlspecialchars($emp['email']) ?></td>
                            
                                            <td>
                                                <form method="POST" class="d-inline">
                                                    <input type="hidden" name="employee_id" value="<?= $emp['id'] ?>">
                                                    <button type="submit" name="action" value="approve" class="btn btn-success btn-sm">Approve</button>
                                                    <button type="submit" name="action" value="reject" class="btn btn-danger btn-sm">Reject</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php else: ?>
                    <p>No pending employees found.</p>
                <?php endif; ?>

            </main>
            <?php include 'partials/footer.php'; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php if($alert): ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: '<?= $alert['icon'] ?>',
                title: '<?= $alert['title'] ?>',
                text: '<?= $alert['text'] ?>',
                confirmButtonColor: '#3085d6'
            }).then(() => {
                window.location.href = '';
            });
        </script>
    <?php endif; ?>
</body>
</html>
