<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

include 'includes/header.php'; // Include header
include 'includes/admin_sidebar.php'; // Include sidebar
include 'db_connect.php'; // Include database connection

// Fetch equipment details
if (isset($_GET['id'])) {
    $equipment_id = $_GET['id'];
    $query = "SELECT * FROM equipment WHERE id = '$equipment_id'";
    $result = mysqli_query($conn, $query);
    $equipment = mysqli_fetch_assoc($result);
} else {
    header('Location: maintenance.php');
    exit();
}

// Handle form submission for scheduling maintenance
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $maintenance_date = $_POST['maintenance_date'];
    $comments = $_POST['comments'];

    // Insert maintenance log into the database (dummy table for now)
    $insert_query = "INSERT INTO maintenance_logs (equipment_id, maintenance_date, comments) VALUES ('$equipment_id', '$maintenance_date', '$comments')";
    if (mysqli_query($conn, $insert_query)) {
        $success_message = "Maintenance scheduled successfully!";
    } else {
        $error_message = "Error scheduling maintenance: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Maintenance</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<main class="container-fluid" style="margin-left: 220px;"> <!-- Adjust the margin-left for the sidebar -->
    <div class="row">
        <div class="col-md-9 mx-auto">
            <h2 class="text-primary mb-4">Schedule Maintenance for <?php echo $equipment['name']; ?></h2>

            <!-- Display success or error message -->
            <?php if (isset($success_message)): ?>
                <div class="alert alert-success"><?php echo $success_message; ?></div>
            <?php elseif (isset($error_message)): ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php endif; ?>

            <!-- Maintenance Scheduling Form -->
            <form method="post" class="shadow p-4 rounded bg-light">
                <!-- Maintenance Date -->
                <div class="form-group">
                    <label for="maintenance_date" class="font-weight-bold">Maintenance Date:</label>
                    <input type="date" id="maintenance_date" name="maintenance_date" class="form-control" required>
                </div>

                <!-- Comments -->
                <div class="form-group">
                    <label for="comments" class="font-weight-bold">Comments (optional):</label>
                    <textarea id="comments" name="comments" class="form-control" rows="4"></textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary btn-block">Schedule Maintenance</button>
            </form>
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
