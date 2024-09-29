<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'student') {
    header('Location: login.php');
    exit();
}

include 'includes/header.php'; // Include the header with user info
include 'includes/sidebar.php'; // Include sidebar for navigation
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserve Equipment</title>
    
    <!-- Bootstrap for Styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<main class="container-fluid" style="margin-left: 200px;"> <!-- Adjust to match sidebar width -->
    <div class="row">
        <!-- Main content area -->
        <div class="col-md-8 offset-md-2"> <!-- Adjusted for better alignment -->
            <h2 class="text-primary mb-4">Reserve Equipment</h2>

            <!-- Equipment Reservation Form -->
            <form method="post" action="process_reservation.php" class="shadow p-4 rounded bg-light">
                <!-- Equipment Selection -->
                <div class="form-group">
                    <label for="equipment" class="font-weight-bold">Select Equipment:</label>
                    <select id="equipment" name="equipment" class="form-control" required>
                        <option value="">-- Select Equipment --</option>
                        <option value="Camera">Camera</option>
                        <option value="Projector">Projector</option>
                        <option value="Microphone">Microphone</option>
                        <option value="Lighting Kit">Lighting Kit</option>
                    </select>
                </div>

                <!-- Reservation Date -->
                <div class="form-group">
                    <label for="date" class="font-weight-bold">Reservation Date:</label>
                    <input type="date" id="date" name="date" class="form-control" required>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary btn-block">Reserve</button>
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
