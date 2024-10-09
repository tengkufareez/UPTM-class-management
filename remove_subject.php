<?php
session_start();
include 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header('Location: login.php');
    exit();
}

// Check if a subject ID was provided in the URL
if (isset($_GET['id'])) {
    $selection_id = $_GET['id'];
    
    // Delete the selected subject from the database
    $sql = "DELETE FROM selected_classes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $selection_id);
    
    if ($stmt->execute()) {
        // Redirect back to reports page
        header('Location: reports.php');
        exit();
    } else {
        echo "Error removing subject: " . $conn->error;
    }
} else {
    echo "No subject selected for removal.";
}
?>
