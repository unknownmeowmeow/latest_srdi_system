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

if (!$user) {
    die("User not found in database.");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Profile</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css">

    <style>
        body {
            background: #f3f6fa;
            min-height: 100vh;
            padding: 30px;
            font-family: "Inter", sans-serif;
        }

        .profile-wrapper {
            max-width: 600px;
            margin: 0 auto;
            border: 2px solid gray;
            padding: 35px;
            border-radius: 20px;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-header img {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            margin-bottom: 15px;
            background: #d9d9d9;
        }

        .info-box {
            padding: 18px 22px;
            border: 1px solid #dcdcdc;
            border-radius: 12px;
            background: #ffffff88;
            margin-bottom: 15px;
            backdrop-filter: blur(4px);
        }

        .info-box label {
            font-size: 0.75rem;
            font-weight: 600;
            color: #6c757d;
            text-transform: uppercase;
            margin-bottom: 3px;
            display: block;
        }

        .info-box p {
            font-size: 1.05rem;
            margin: 0;
            font-weight: 500;
            color: #333;
        }

        .actions {
            margin-top: 20px;
        }

        .btn-custom {
            width: 48%;
            padding: 10px;
            border-radius: 10px;
        }
    </style>
</head>

<body>

    <div class="profile-wrapper">

        <div class="profile-header">


            <h2 class="fw-bold mb-0">
                <?= strtoupper(htmlspecialchars($user['firstname'] . " " . $user['lastname'])); ?>
                </h3>
                <div class="text-muted fw-semibold mt-2">
                    <span class="badge bg-primary-subtle text-primary px-3 py-2" style="font-size: 0.80 rem;">
                        <?= strtoupper(htmlspecialchars($user['typename'])); ?>
                    </span>
                </div>


        </div>

        <!-- INFO LAYOUT WITHOUT WHITE CARD -->
        <div class="info-box">
            <label><i class="bi bi-person"></i> First Name</label>
            <p><?= htmlspecialchars($user['firstname']); ?></p>
        </div>

        <div class="info-box">
            <label><i class="bi bi-person-lines-fill"></i> Middle Name</label>
            <p><?= htmlspecialchars($user['middlename']); ?></p>
        </div>

        <div class="info-box">
            <label><i class="bi bi-person-fill"></i> Last Name</label>
            <p><?= htmlspecialchars($user['lastname']); ?></p>
        </div>

        <div class="info-box">
            <label><i class="bi bi-envelope"></i> Email</label>
            <p><?= htmlspecialchars($user['email']); ?></p>
        </div>

        <div class="info-box">
            <label><i class="bi bi-geo-alt"></i> Address</label>
            <p><?= htmlspecialchars($user['address']); ?></p>
        </div>

        <div class="actions d-flex justify-content-between">
            <a href="dashboard.php" class="btn btn-outline-secondary btn-custom">Back</a>
            <a href="edit_profile.php" class="btn btn-primary btn-custom">Edit Profile</a>
        </div>

    </div>
    <?php
    if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
        $msg = $_SESSION['message'];
        unset($_SESSION['message']); // remove so it only shows once
    ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '<?= $msg; ?>',
                confirmButtonColor: '#4A6CF7'
            });
        </script>
    <?php } ?>

</body>

</html>