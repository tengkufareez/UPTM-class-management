<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'user'; // Default role is user

    // Check if it's an admin registration
    if (isset($_POST['admin_key'])) {
        $admin_key = $_POST['admin_key'];
        $correct_admin_key = "admin123"; // Secure predefined key

        if ($admin_key == $correct_admin_key) {
            $role = 'admin'; // Set role to admin if key matches
        } else {
            echo "<p class='error'>Invalid Admin Key. You cannot register as an admin.</p>";
            exit();
        }
    }

    // Insert the new user into the database
    $sql = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$password', '$role')";

    if ($conn->query($sql) === TRUE) {
        echo "<p class='success'>Registration successful! Redirecting...</p>";
        header('Refresh: 2; URL=login.php');
    } else {
        echo "<p class='error'>Error: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #218838;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }

        .success {
            color: green;
            margin-bottom: 10px;
        }

        .toggle {
            text-align: center;
            margin-top: 20px;
        }

        .toggle a {
            color: #007bff;
            text-decoration: none;
        }

        .toggle a:hover {
            text-decoration: underline;
        }

        .admin-key {
            display: none;
        }

        .admin-section h2 {
            margin-top: 30px;
        }
    </style>

    <script>
        function toggleAdminKey() {
            var adminKeyField = document.querySelector('.admin-key');
            adminKeyField.style.display = adminKeyField.style.display === 'block' ? 'none' : 'block';
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Register as a User</h2>
        <form method="POST" action="register.php">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>

        <div class="toggle">
            <p>Want to register as an admin? <a href="#" onclick="toggleAdminKey()">Click here</a></p>
        </div>

        <div class="admin-key admin-section">
            <h2>Register as an Admin</h2>
            <form method="POST" action="register.php">
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="text" name="admin_key" placeholder="Admin Registration Key" required><br>
                <button type="submit">Register as Admin</button>
            </form>
        </div>
    </div>
</body>
</html>
