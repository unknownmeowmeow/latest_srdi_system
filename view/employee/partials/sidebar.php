<?php
$type_id = $_SESSION['type_id'] ?? 0;
?>
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="dashboard.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <div class="sb-sidenav-menu-heading">Research</div>

                <!-- Research Dropdown -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseResearch" aria-expanded="false" aria-controls="collapseResearch">
                    <div class="sb-nav-link-icon"><i class="fas fa-flask"></i></div>
                    Research
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseResearch" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="approved.php"><i class="fas fa-check-circle me-1"></i> Approved</a>
                        <a class="nav-link" href="cancel.php"><i class="fas fa-times-circle me-1"></i> Cancelled</a>
                        <a class="nav-link" href="revised.php"><i class="fas fa-ban me-1"></i> Revised</a>
                        <a class="nav-link" href="publish.php"><i class="fas fa-upload me-1"></i> Published</a>
                        <a class="nav-link" href="pending.php"><i class="fas fa-upload me-1"></i> Pending</a>
                        <?php if ($type_id == 1): ?>
                            <a class="nav-link" href="upload.php"><i class="fas fa-file-upload me-1"></i> Upload Research</a>
                        <?php endif; ?>
                    </nav>
                </div>

                <?php if ($type_id == 4): ?>
                    <div class="sb-sidenav-menu-heading">Administration</div>
                    <a class="nav-link" href="backup.php"><i class="fas fa-file-upload me-1"></i> Backup and restore</a>
                    <a class="nav-link" href="employeepending.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>Employee Pending
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            <?= htmlspecialchars($fullname) ?>
        </div>
    </nav>
</div>

<style>
    #sidenavAccordion .nav-link {
        padding: 0.75rem 1rem;
        display: flex;
        align-items: center;
    }

    #sidenavAccordion .sb-nav-link-icon {
        margin-right: 0.5rem;
        min-width: 20px;
        text-align: center;
    }

    .sb-sidenav-menu-nested .nav-link {
        padding-left: 2rem;
    }
</style>