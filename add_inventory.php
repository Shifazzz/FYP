<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

include 'includes/header.php'; // Include header
include 'includes/admin_sidebar.php'; // Include sidebar
include 'db_connect.php'; // Include database connection

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $status = $_POST['status'];

    // Insert equipment into the database
    $query = "INSERT INTO equipment (name, category, status) VALUES ('$name', '$category', '$status')";
    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = "New equipment added successfully!";
    } else {
        $_SESSION['message'] = "Failed to add equipment.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Inventory</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<main class="container-fluid" style="margin-left: 220px;"> <!-- Adjust the margin-left to accommodate the sidebar -->
    <div class="row">
        <div class="col-md-9 mx-auto">
            <h2 class="text-primary mb-4">Add New Equipment</h2>

            <!-- Display success or error messages -->
            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-info">
                    <?php 
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                    ?>
                </div>
            <?php endif; ?>

            <!-- Equipment Add Form -->
            <form method="post" action="add_inventory.php" class="shadow p-4 rounded bg-light">
                <div class="form-group">
                    <label for="name" class="font-weight-bold">Equipment Name:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="category" class="font-weight-bold">Category:</label>
                    <select id="category" name="category" class="form-control" required>
                        <option value="">-- Select Category --</option>
                        <option value="Camera">Camera</option>
                        <option value="Projector">Projector</option>
                        <option value="Microphone">Microphone</option>
                        <option value="Lighting Kit">Lighting Kit</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="status" class="font-weight-bold">Status:</label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="available">Available</option>
                        <option value="unavailable">Unavailable</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Add Equipment</button>
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
