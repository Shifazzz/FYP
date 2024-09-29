<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

include 'includes/header.php'; // Include header
include 'includes/admin_sidebar.php'; // Include sidebar
include 'db_connect.php'; // Include database connection

// Fetch equipment that requires maintenance
$query = "SELECT * FROM equipment WHERE status = 'available'"; // Fetch all available equipment for now
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance Reminders</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<main class="container-fluid" style="margin-left: 220px;">
    <div class="row">
        <div class="col-md-9 mx-auto">
            <h2 class="text-primary mb-4">Maintenance Reminders</h2>

            <!-- Display equipment due for maintenance -->
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Equipment</th>
                        <th>Category</th>
                        <th>Last Maintenance Date</th>
                        <th>Next Maintenance Due</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['category']; ?></td>
                            <td><?php echo date('Y-m-d', strtotime('-6 months')); // Dummy last maintenance date ?></td>
                            <td><?php echo date('Y-m-d', strtotime('+6 months')); // Dummy next maintenance due ?></td>
                            <td>
                                <a href="schedule_maintenance.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-info">Schedule Maintenance</a>
                                <a href="view_maintenance_history.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-secondary">View History</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<!-- Footer -->
<?php include 'includes/footer.php'; ?>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
