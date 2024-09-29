<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

include 'includes/header.php'; // Include header with logout and user info
include 'includes/admin_sidebar.php'; // Include admin sidebar
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<main class="container-fluid" style="margin-left: 220px;"> <!-- Adjust margin for sidebar -->
    <div class="row">
        <div class="col-md-9 mx-auto">
            <h2 class="text-primary mb-4">Admin Dashboard</h2>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body text-center">
                            <i class="fas fa-calendar-alt fa-3x text-primary mb-3"></i>
                            <h5 class="card-title">View Reservations</h5>
                            <a href="view_reservations.php" class="btn btn-primary btn-block">View Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body text-center">
                            <i class="fas fa-boxes fa-3x text-success mb-3"></i>
                            <h5 class="card-title">Manage Inventory</h5>
                            <a href="inventory.php" class="btn btn-success btn-block">Manage Inventory</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body text-center">
                            <i class="fas fa-tools fa-3x text-warning mb-3"></i>
                            <h5 class="card-title">Maintenance Reminders</h5>
                            <a href="maintenance_reminders.php" class="btn btn-warning btn-block">View Reminders</a>
                        </div>
                    </div>
                </div>
            </div>

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
