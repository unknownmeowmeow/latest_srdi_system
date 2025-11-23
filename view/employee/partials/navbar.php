<?php
session_start();
require_once "../../controller/Main.php";

$fullname = $_SESSION['fullname'] ?? 'User';
$user_id = $_SESSION['user_id'] ?? 0;
$type_id = $_SESSION['type_id'] ?? 0;

$db = new db();

// Fetch notifications
// Only employees (type_id = 1) see their own; others see all
$notifications = $db->getNotifications($user_id, $type_id, 10); // limit = 10

// Count unread notifications
$unreadCount = 0;
foreach ($notifications as $notif) {
    if ($notif['status'] == 0) $unreadCount++;
}
?>

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand ps-3" href="dashboard.php">SRDI Dashboard</a>

    <ul class="navbar-nav ms-auto me-3 me-lg-4">

        <!-- Notification Bell -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle position-relative" id="notificationDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <?php if($unreadCount > 0): ?>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        <?= $unreadCount ?>
                        <span class="visually-hidden">unread notifications</span>
                    </span>
                <?php endif; ?>
            </a>

            <!-- Scrollable, bordered dropdown -->
            <ul class="dropdown-menu dropdown-menu-end p-2" aria-labelledby="notificationDropdown" 
                style="width: 350px; max-height: 400px; overflow-y: auto; border: 1px solid #ddd; border-radius: 5px;">
                <li class="dropdown-header fw-bold">Notifications</li>
                <li><hr class="dropdown-divider"></li>

                <?php if(!empty($notifications)): ?>
                    <?php foreach($notifications as $notif): ?>
                        <li>
                            <a class="dropdown-item <?= $notif['status'] == 0 ? 'fw-bold' : '' ?> mb-1" href="#">
                                <small class="text-muted"><?= date('M d, Y H:i', strtotime($notif['created_at'])) ?></small><br>
                                <span><?= htmlspecialchars($notif['message']) ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li><a class="dropdown-item text-center text-muted" href="#">No notifications</a></li>
                <?php endif; ?>

                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-center" href="notifications.php">See all notifications</a></li>
            </ul>
        </li>

        <!-- User Dropdown -->
        <li class="nav-item dropdown ms-3">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown">
                <i class="fas fa-user fa-fw"></i> <?= htmlspecialchars($fullname) ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                <li><a class="dropdown-item" href="http://localhost/srdi_system_v1/view/auth/login.php">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>
