<?php
include 'config.php';
session_start();

if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        $class_name = $_POST['class_name'];
        $section = $_POST['section'];
        $sql = "INSERT INTO classes (class_name, section) VALUES ('$class_name', '$section')";
        $conn->query($sql);
    } elseif (isset($_POST['update'])) {
        $id = $_POST['id'];
        $class_name = $_POST['class_name'];
        $section = $_POST['section'];
        $available = isset($_POST['available']) ? 1 : 0;
        $sql = "UPDATE classes SET class_name='$class_name', section='$section', available='$available' WHERE id='$id'";
        $conn->query($sql);
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM classes WHERE id='$id'";
        $conn->query($sql);
    }
}

$result = $conn->query("SELECT * FROM classes");
include 'templates/header.php';
?>

<h1>Manage Classes</h1>
<form method="post" action="manage_classes.php" class="form-inline mb-3">
    <div class="form-group mr-2">
        <label for="class_name" class="sr-only">Class Name</label>
        <input type="text" name="class_name" class="form-control" placeholder="Class Name" required>
    </div>
    <div class="form-group mr-2">
        <label for="section" class="sr-only">Section</label>
        <input type="text" name="section" class="form-control" placeholder="Section" required>
    </div>
    <button type="submit" name="add" class="btn btn-primary">Add Class</button>
</form>

<h2>Update or Delete Classes</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Class Name</th>
            <th>Section</th>
            <th>Available</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <form method="post" action="manage_classes.php">
                <td><?php echo $row['id']; ?><input type="hidden" name="id" value="<?php echo $row['id']; ?>"></td>
                <td><input type="text" name="class_name" value="<?php echo $row['class_name']; ?>"></td>
                <td><input type="text" name="section" value="<?php echo $row['section']; ?>"></td>
                <td><input type="checkbox" name="available" value="1" <?php if ($row['available']) echo "checked"; ?>></td>
                <td>
                <input type="submit" name="update" value="Update">
                <input type="submit" name="delete" value="Delete">
            </td>
        </form>
    </tr>
    <?php } ?>
</table>
<a href="dashboard.php">Back to Dashboard</a>
