<?php
session_start();
require_once "../../controller/Main.php";

$fullname = $_SESSION['fullname'] ?? 'User';
$user_id = $_SESSION['user_id'] ?? 0;
$type_id = $_SESSION['type_id'] ?? 0;

$db = new db();

// Get all research for the user based on type
$researchList = $db->getResearchForUser($user_id, $type_id);

// Filter only Published research (status_id = 5)
$researchList = array_filter($researchList, function($r) {
    return $r['status_id'] == 5;
});

// Add team leader and decided by names
foreach ($researchList as $key => $research) {
    $researchList[$key]['team_leader'] = $db->getEmployeeName($research['user_id']);
    $researchList[$key]['decided_by'] = $research['desisyon_id'] ? $db->getEmployeeName($research['desisyon_id']) : '-';
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
            <h1 class="mt-4">Published Research</h1>

            <?php if ($researchList): ?>
                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-list"></i> Published Research</div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Team Leader</th>
                                    <th>Members</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Research File</th>
                                    <th>Compliance File</th>
                                    <th>Status</th>
                                    <th>Decided By</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($researchList as $research): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($research['title']) ?></td>
                                        <td><?= htmlspecialchars($research['team_leader']) ?></td>
                                        <td><?= htmlspecialchars($research['member']) ?></td>
                                        <td><?= htmlspecialchars($research['startDate']) ?></td>
                                        <td><?= htmlspecialchars($research['endDate']) ?></td>
                                        <td>
                                            <?php if (!empty($research['filePath'])): ?>
                                                <a href="research/<?= htmlspecialchars($research['filePath']) ?>" target="_blank">View Research</a>
                                            <?php else: ?> N/A <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if (!empty($research['compliance'])): ?>
                                                <a href="compliance/<?= htmlspecialchars($research['compliance']) ?>" target="_blank">View Compliance</a>
                                            <?php else: ?> N/A <?php endif; ?>
                                        </td>
                                        <td><span class="badge bg-primary">Published</span></td>
                                        <td><?= htmlspecialchars($research['decided_by']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php else: ?>
                <p>No published research found.</p>
            <?php endif; ?>
        </main>
        <?php include 'partials/footer.php'; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
