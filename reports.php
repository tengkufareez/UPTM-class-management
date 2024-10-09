<?php
session_start();

echo "User ID from session: " . $_SESSION['user_id']; // for debugging
include 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    // Redirect to login page if not logged in
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

// styling for reports
echo "
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #333;
            color: white;
        }
        td {
            background-color: white;
        }
        .message {
            text-align: center;
            color: #888;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            background-color: #dc3545;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .btn:hover {
            background-color: #c82333;
        }
    </style>
    <div class='container'>
";

// If admin, show all users and their selected subjects
if ($role == 'admin') {
    echo "<h2>Admin Reports: All Students with Selected Subjects</h2>";

    $sql = "SELECT classes.class_name, classes.section, selected_classes.class_id 
        FROM selected_classes
        INNER JOIN classes ON selected_classes.class_id = classes.id
        WHERE selected_classes.user_id = '$user_id'";

$result = mysqli_query($conn, $sql);

    if (!$result) {
        echo "Error in query: " . mysqli_error($conn);
    }

    if ($result && $result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>User</th>
                    <th>Class Name</th>
                    <th>Section</th>
                    <th>Action</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['username']}</td>
                    <td>{$row['class_name']}</td>
                    <td>{$row['section']}</td>
                    <td><a href='remove_subject.php?id={$row['selection_id']}' class='btn'>Remove</a></td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<div class='message'>No users have selected subjects.</div>";
    }
} else { // If student, show only their selected subjects and allow removal
    echo "<h2>Your Selected Subjects</h2>";

    $sql = "SELECT classes.class_name, classes.section, selected_classes.id AS selection_id 
            FROM selected_classes
            INNER JOIN classes ON selected_classes.class_id = classes.id
            WHERE selected_classes.user_id = '$user_id'";

    $result = $conn->query($sql);

    if (!$result) {
        echo "Error in query: " . $conn->error;
    }
    

    if ($result && $result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>Class Name</th>
                    <th>Section</th>
                    <th>Action</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['class_name']}</td>
                    <td>{$row['section']}</td>
                    <td><a href='remove_subject.php?id={$row['selection_id']}' class='btn'>Remove</a></td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<div class='message'>You haven't selected any subjects.</div>";
    }
}

echo "</div>";
?>
