<?php
session_start();
require_once "../../controller/Main.php";

$fullname = $_SESSION['fullname'] ?? 'User';
$user_id = $_SESSION['user_id'] ?? 0;
$type_id = $_SESSION['type_id'] ?? 0;

$db = new db();

// Only allow type_id = 4
if ($type_id != 4) {
    header("Location: ../../auth/login.php");
    exit;
}

$alert = null;
$backupDir = "C:/xampp/htdocs/srdi_system_v1/view/employee/backup/";
if (!is_dir($backupDir)) mkdir($backupDir, 0777, true);

// Get existing backups
$backupFiles = glob($backupDir . "*.sql");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Backup
    if (isset($_POST['backup'])) {
        $customName = trim($_POST['backup_name']);
        $backupFile = $backupDir . ($customName ? $customName : "backup_" . date("Ymd_His")) . ".sql";

        $mysqldumpPath = "C:/xampp/mysql/bin/mysqldump.exe"; 
        $dbHost = "localhost";
        $dbUser = "root";
        $dbPass = "";
        $dbName = "srdi_system";

        $command = "\"$mysqldumpPath\" --user=$dbUser --password=$dbPass --host=$dbHost $dbName > \"$backupFile\"";
        system($command, $returnVar);

        if ($returnVar === 0) {
            $alert = [
                'icon' => 'success',
                'title' => 'Backup Successful!',
                'text' => 'Backup saved as: ' . basename($backupFile)
            ];
            $backupFiles = glob($backupDir . "*.sql"); // refresh backup list
        } else {
            $alert = [
                'icon' => 'error',
                'title' => 'Backup Failed',
                'text' => 'Check mysqldump path and folder permissions.'
            ];
        }
    }

    // Restore
    if (isset($_POST['restore']) && isset($_POST['restore_file'])) {
        $restoreFile = $backupDir . $_POST['restore_file'];
        if (file_exists($restoreFile)) {
            $mysqlPath = "C:/xampp/mysql/bin/mysql.exe";
            $dbHost = "localhost";
            $dbUser = "root";
            $dbPass = "";
            $dbName = "srdi_system";

            $command = "\"$mysqlPath\" --user=$dbUser --password=$dbPass --host=$dbHost $dbName < \"$restoreFile\"";
            system($command, $returnVar);

            if ($returnVar === 0) {
                $alert = [
                    'icon' => 'success',
                    'title' => 'Restore Successful!',
                    'text' => 'Database restored from: ' . basename($restoreFile)
                ];
            } else {
                $alert = [
                    'icon' => 'error',
                    'title' => 'Restore Failed',
                    'text' => 'Check mysql path and folder permissions.'
                ];
            }
        } else {
            $alert = [
                'icon' => 'error',
                'title' => 'File Not Found',
                'text' => 'Selected backup file does not exist.'
            ];
        }
    }
}
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
                <h1 class="mt-4">Backup & Restore Database</h1>

                <div class="row gy-4 mt-3">

                    <!-- Backup Card -->
                    <div class="col-lg-6 col-md-8 col-12">
                        <div class="card shadow-sm">
                            <div class="card-header bg-success text-white">
                                <h5 class="mb-0">Backup Database</h5>
                            </div>
                            <div class="card-body">
                                <p>Save your current database state to a backup file.</p>
                                <form method="POST" class="d-grid">
                                    <input type="text" name="backup_name" class="form-control mb-3" placeholder="Optional: Enter a name or date for backup">
                                    <button type="submit" name="backup" class="btn btn-success btn-lg">Backup Now</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Restore Card -->
                    <div class="col-lg-6 col-md-8 col-12">
                        <div class="card shadow-sm">
                            <div class="card-header bg-warning text-dark">
                                <h5 class="mb-0">Restore Database</h5>
                            </div>
                            <div class="card-body">
                                <p>Select a backup file to restore the database. This action cannot be undone.</p>
                                <form method="POST">
                                    <select class="form-select mb-3" name="restore_file" required>
                                        <option value="">-- Select Backup File --</option>
                                        <?php foreach ($backupFiles as $file): ?>
                                            <option value="<?= basename($file) ?>"><?= basename($file) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <button type="submit" name="restore" class="btn btn-warning btn-lg w-100">Restore Selected Backup</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
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
            });
        </script>
    <?php endif; ?>
</body>
</html>
            