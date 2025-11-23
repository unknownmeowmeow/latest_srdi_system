<?php
session_start();
require_once "../../controller/Main.php";

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/login.php");
    exit;
}

// Session variables
$fullname = $_SESSION['fullname'] ?? 'User';
$type_id = $_SESSION['type_id'] ?? 0;
$session_user_id = $_SESSION['user_id'] ?? 0;

$db = new db();

// Status mapping
$statusText = [1 => 'Pending', 2 => 'Approved', 3 => 'Revised', 4 => 'Cancelled', 5 => 'Published'];
$bgColors = [
    'pending' => 'secondary',
    'approved' => 'success',
    'revised' => 'info',
    'cancelled' => 'warning',
    'published' => 'primary'
];

// Determine which research to fetch
if ($type_id == 1) {
    // Employee: own research only
    $statusCountsRaw = $db->getResearchStatusCounts($session_user_id);
    $allResearch = $db->getAllResearch($session_user_id);
    $monthlyCounts = $db->getMonthlyResearchCounts(date('Y'), $session_user_id);
} else {
    // Other types: see all research
    $statusCountsRaw = $db->getResearchStatusCounts();
    $allResearch = $db->getAllResearch();
    $monthlyCounts = $db->getMonthlyResearchCounts(date('Y'));
}

// Prepare status counts (use keys from getResearchStatusCounts)
$statusMap = [1 => 'pending', 2 => 'approved', 3 => 'revised', 4 => 'cancelled', 5 => 'published'];
$statusCounts = [];
foreach ($statusMap as $id => $name) {
    $statusCounts[$name] = $statusCountsRaw[$name] ?? 0;
}

// Prepare monthly data
$monthLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
$monthlyData = [];
for ($i = 1; $i <= 12; $i++) {
    $monthlyData[] = $monthlyCounts[$i] ?? 0;
}
?>

<?php include 'partials/header.php'; ?>

<body class="sb-nav-fixed">
    <?php include 'partials/navbar.php'; ?>
    <div id="layoutSidenav">
        <?php include 'partials/sidebar.php'; ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Welcome, <?= htmlspecialchars($fullname) ?>!</li>
                    </ol>

                    <!-- Status Cards -->
                    <div class="row">
                        <?php foreach ($statusCounts as $key => $count):
                            $color = $bgColors[$key] ?? 'dark';
                        ?>
                            <div class="col-md-2">
                                <div class="card bg-<?= $color ?> text-white mb-4">
                                    <div class="card-body"><?= ucfirst($key) ?>: <?= $count ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Monthly Chart -->
                    <div class="card mb-4">
                        <div class="card-header"><i class="fas fa-chart-line me-1"></i> Monthly Research (<?= date('Y') ?>)</div>
                        <div class="card-body">
                            <canvas id="monthlyChart" width="400" height="150"></canvas>
                        </div>
                    </div>

                    <!-- Research Table -->
                    <div class="card mb-4">
                        <div class="card-header"><i class="fas fa-table me-1"></i> Research List</div>
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>File</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Member(s)</th>
                                        <th>Research Leader</th>
                                        <th>Compliance</th>
                                        <th>Comment</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($allResearch as $r): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($r['title']) ?></td>
                                            <td><?= htmlspecialchars($r['description']) ?></td>
                                            <td>
                                                <?php if (!empty($r['filePath'])): ?>
                                                    <a href="research/<?= htmlspecialchars($r['filePath']) ?>" target="_blank">View File</a>
                                                    <?php else: ?>N/A<?php endif; ?>
                                            </td>
                                            <td><?= htmlspecialchars($r['startDate']) ?></td>
                                            <td><?= htmlspecialchars($r['endDate']) ?></td>
                                            <td><?= htmlspecialchars($r['member']) ?></td>
                                            <td>
                                                <?= ($type_id == 1 && $r['user_id'] == $session_user_id)
                                                    ? 'You'
                                                    : htmlspecialchars($r['leader_firstname'] . ' ' . $r['leader_lastname']) ?>
                                            </td>
                                            <td>
                                                <?php if (!empty($r['compliance'])): ?>
                                                    <a href="compliance/<?= htmlspecialchars($r['compliance']) ?>" target="_blank">View PDF</a>
                                                    <?php else: ?>N/A<?php endif; ?>
                                            </td>
                                            <td><?= htmlspecialchars($r['comment']) ?></td>
                                            <td><?= htmlspecialchars($statusText[$r['status_id']] ?? 'Unknown') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                            </table>
                        </div>
                    </div>

                </div>
            </main>
            <?php include 'partials/footer.php'; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('monthlyChart').getContext('2d');
        const monthlyChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($monthLabels) ?>,
                datasets: [{
                    label: 'Research Count',
                    data: <?= json_encode($monthlyData) ?>,
                    backgroundColor: '#0d6efd',
                    borderColor: '#0d6efd',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        stepSize: 1
                    }
                }
            }
        });
    </script>
</body>

</html>