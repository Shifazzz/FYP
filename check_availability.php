<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'student') {
    header('Location: login.php');
    exit();
}

include 'includes/header.php'; // Include the header with user info
include 'includes/sidebar.php'; // Include the sidebar for navigation
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Availability</title>

    <!-- Bootstrap for Styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<main class="container-fluid" style="margin-left: 220px;"> <!-- Adjust margin to leave space for sidebar -->
    <div class="row">
        <!-- Main content area -->
        <div class="col-md-9 mx-auto">
            <h2 class="text-primary mb-4">Check Equipment Availability</h2>

            <!-- Availability Form -->
            <form method="post" action="availability_result.php" class="shadow p-4 rounded bg-light">
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

                <!-- Submit Button -->
                <button type="submit" class="btn btn-info btn-block">Check Availability</button>
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
