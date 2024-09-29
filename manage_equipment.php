<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

include 'includes/header.php';
include 'includes/admin_sidebar.php';
include 'db_connect.php';

$name = '';
$category = '';
$status = 'available'; // Default value
$edit_mode = false; // Flag to check if we're editing equipment

// Handle form submission for adding or editing
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $status = $_POST['status'];

    if (isset($_POST['edit_id'])) { // Edit mode
        $id = $_POST['edit_id'];
        $update_query = "UPDATE equipment SET name='$name', category='$category', status='$status' WHERE id='$id'";
        if (mysqli_query($conn, $update_query)) {
            $success_message = "Equipment updated successfully!";
        } else {
            $error_message = "Error updating equipment: " . mysqli_error($conn);
        }
    } else { // Add mode
        $insert_query = "INSERT INTO equipment (name, category, status) VALUES ('$name', '$category', '$status')";
        if (mysqli_query($conn, $insert_query)) {
            $success_message = "Equipment added successfully!";
        } else {
            $error_message = "Error adding equipment: " . mysqli_error($conn);
        }
    }
}

// Handle edit request
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit_mode = true;
    $query = "SELECT * FROM equipment WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    $equipment = mysqli_fetch_assoc($result);
    $name = $equipment['name'];
    $category = $equipment['category'];
    $status = $equipment['status'];
}

// Handle delete request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete_query = "DELETE FROM equipment WHERE id='$id'";
    if (mysqli_query($conn, $delete_query)) {
        $success_message = "Equipment deleted successfully!";
    } else {
        $error_message = "Error deleting equipment: " . mysqli_error($conn);
    }
}

// Fetch all equipment for display
$query = "SELECT * FROM equipment";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Equipment</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<main class="container-fluid" style="margin-left: 220px;">
    <div class="row">
        <div class="col-md-9 mx-auto">
            <h2 class="text-primary mb-4"><?php echo $edit_mode ? 'Edit' : 'Add'; ?> Equipment</h2>

            <!-- Display success or error message -->
            <?php if (isset($success_message)): ?>
                <div class="alert alert-success"><?php echo $success_message; ?></div>
            <?php elseif (isset($error_message)): ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php endif; ?>

            <!-- Equipment Form -->
            <form method="post" class="shadow p-4 rounded bg-light">
                <div class="form-group">
                    <label for="name" class="font-weight-bold">Equipment Name:</label>
                    <input type="text" id="name" name="name" class="form-control" value="<?php echo $name; ?>" required>
                </div>

                <div class="form-group">
                    <label for="category" class="font-weight-bold">Category:</label>
                    <input type="text" id="category" name="category" class="form-control" value="<?php echo $category; ?>" required>
                </div>

                <div class="form-group">
                    <label for="status" class="font-weight-bold">Status:</label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="available" <?php if ($status == 'available') echo 'selected'; ?>>Available</option>
                        <option value="in maintenance" <?php if ($status == 'in maintenance') echo 'selected'; ?>>In Maintenance</option>
                        <option value="out of stock" <?php if ($status == 'out of stock') echo 'selected'; ?>>Out of Stock</option>
                    </select>
                </div>

                <?php if ($edit_mode): ?>
                    <input type="hidden" name="edit_id" value="<?php echo $id; ?>">
                <?php endif; ?>

                <button type="submit" class="btn btn-primary btn-block"><?php echo $edit_mode ? 'Update' : 'Add'; ?> Equipment</button>
            </form>

            <!-- Display Equipment List -->
            <h2 class="text-primary mt-5">Equipment Inventory</h2>
            <table class="table table-bordered mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th>Equipment Name</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['category']; ?></td>
                            <td><?php echo ucfirst($row['status']); ?></td>
                            <td>
                                <a href="manage_equipment.php?edit=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="manage_equipment.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this equipment?');">Delete</a>
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
