<?php
session_start();
include 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch selected subjects for the logged-in user
$sql = "SELECT class_name, section FROM selected_classes 
        INNER JOIN classes ON selected_classes.class_id = classes.id 
        WHERE selected_classes.user_id = '$user_id'";
$result = $conn->query($sql);
?>

<?php include 'templates/header.php'; ?>

<div class="container mt-5">
    <h2 class="text-center">Your Selected Subjects</h2>
    <a href="view_classes.php" class="btn btn-secondary mb-3">Back to Classes</a>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Class Name</th>
                    <th>Section</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['class_name']; ?></td>
                            <td><?php echo $row['section']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2" class="text-center">No subjects selected</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'templates/footer.php'; ?>

<!-- Bootstrap JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
