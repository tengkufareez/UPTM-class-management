<?php
session_start();
include 'config.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'templates/header.php';
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">
                <?php echo ($_SESSION['role'] == 'admin') ? 'Admin' : 'Student'; ?> Dashboard
            </h1>
            <p class="text-center">Welcome, <?php echo $_SESSION['username']; ?>.</p>
            
            <?php if ($_SESSION['role'] == 'admin'): ?>
                <!-- Admin Dashboard Content -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Manage Classes</h5>
                                <p class="card-text">Add, update, or delete class sections.</p>
                                <a href="manage_classes.php" class="btn btn-primary">Go to Manage Classes</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">View Classes</h5>
                                <p class="card-text">View all available classes and their sections.</p>
                                <a href="view_classes.php" class="btn btn-primary">Go to View Classes</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">System Reports</h5>
                                <p class="card-text">Generate and view reports on class registrations.</p>
                                <a href="reports.php" class="btn btn-primary">Go to Reports</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <!-- Student Dashboard Content -->
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">View Available Classes</h5>
                                <p class="card-text">Browse and select from the available class sections.</p>
                                <a href="view_classes.php" class="btn btn-primary">Go to View Classes</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'templates/footer.php'; ?>
