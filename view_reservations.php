<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'student') {
    header('Location: login.php');
    exit();
}

include 'includes/header.php';
include 'includes/sidebar.php';  // Include sidebar here
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Reservations</title>

    <!-- Bootstrap for Styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<main class="container-fluid" style="margin-left: 200px;"> <!-- Adjust for sidebar width -->
    <div class="row">
        <!-- Main content area -->
        <div class="col-md-9 mx-auto">
            <h2 class="text-primary mb-4">My Reservations</h2>

            <!-- Reservation Table -->
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Equipment</th>
                        <th>Date Reserved</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Camera</td>
                        <td>2024-09-20</td>
                        <td><span class="badge badge-success">Approved</span></td>
                    </tr>
                    <tr>
                        <td>Projector</td>
                        <td>2024-09-18</td>
                        <td><span class="badge badge-warning">Pending</span></td>
                    </tr>
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
