<?php
session_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'config.php';
include 'templates/header.php';
?>

<div class="jumbotron text-center">
    <h1 class="display-4">Welcome to University Poly-Tech Malaysia (UPTM)</h1>
    <p class="lead">Manage and select classes with ease through our UPTM Class Management System.</p>
    <hr class="my-4">
    <p>Login or register to get started.</p>
    <a class="btn btn-primary btn-lg" href="login.php" role="button">Login</a>
    <a class="btn btn-secondary btn-lg" href="register.php" role="button">Register</a>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <h2>Admin Features</h2>
            <p>Admins can manage class sections, update availability, and ensure smooth operation of the class selection process.</p>
        </div>
        <div class="col-md-4">
            <h2>User Features</h2>
            <p>Users can view available classes, select their desired classes, and manage their selections.</p>
        </div>
        <div class="col-md-4">
            <h2>Secure System</h2>
            <p>Our system ensures data security with proper authentication and user role management.</p>
        </div>
    </div>
</div>

<?php include 'templates/footer.php'; ?>
