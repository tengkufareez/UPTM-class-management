<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$class_id = $_GET['id'];

// Check if the student has already selected this class
$sql_check = "SELECT * FROM selected_classes WHERE user_id = '$user_id' AND class_id = '$class_id'";
$result_check = $conn->query($sql_check);

if ($result_check->num_rows == 0) {
    // If not selected, insert into selected_classes
    $sql = "INSERT INTO selected_classes (user_id, class_id) VALUES ('$user_id', '$class_id')";
    $conn->query($sql);
}

// Redirect back to the available classes page
header('Location: view_classes.php');
exit();
?>
