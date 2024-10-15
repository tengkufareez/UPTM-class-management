<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <title>University Class Management</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="index.php"><img src="images/uptmlogo.png" width="70px"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php echo basename($_SERVER['SCRIPT_NAME']) == 'dashboard.php' ? 'active' : ''; ?>"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                <li class="nav-item <?php echo basename($_SERVER['SCRIPT_NAME']) == 'manage_classes.php' ? 'active' : ''; ?>"><a class="nav-link" href="manage_classes.php">Manage Classes</a></li>
            <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] == 'user'): ?>
                <li class="nav-item <?php echo basename($_SERVER['SCRIPT_NAME']) == 'view_classes.php' ? 'active' : ''; ?>"><a class="nav-link" href="view_classes.php">View Classes</a></li>
            <?php endif; ?>
            <?php if (isset($_SESSION['username'])): ?>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            <?php else: ?>
                <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
<div class="container">
