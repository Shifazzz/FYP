<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

include 'includes/header.php'; // Include header
include 'includes/admin_sidebar.php'; // Include admin sidebar
include 'db_connect.php'; // Include database connection

// Fetch all reservations
$query = "SELECT r.id, r.student_username, e.name AS equipment_name, r.start_date, r.end_date, r.status 
          FROM reservations r 
          JOIN equipment e ON r.equipment_id = e.id";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Reservations</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<main class="container-fluid" style="margin-left: 220px;"> <!-- Adjust the margin-left to accommodate the sidebar -->
    <div class="row">
        <div class="col-md-9 mx-auto">
            <h2 class="text-primary mb-4">Manage Reservations</h2>

            <!-- Reservation Table -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Student Username</th>
                        <th>Equipment</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['student_username']; ?></td>
                        <td><?php echo $row['equipment_name']; ?></td>
                        <td><?php echo $row['start_date']; ?></td>
                        <td><?php echo $row['end_date']; ?></td>
                        <td><?php echo ucfirst($row['status']); ?></td>
                        <td>
                            <?php if ($row['status'] === 'pending'): ?>
                                <form method="post" action="process_reservation.php" style="display: inline-block;">
                                    <input type="hidden" name="reservation_id" value="<?php echo $row['id']; ?>">
                                    <input type="hidden" name="action" value="approve">
                                    <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                </form>
                                <form method="post" action="process_reservation.php" style="display: inline-block;">
                                    <input type="hidden" name="reservation_id" value="<?php echo $row['id']; ?>">
                                    <input type="hidden" name="action" value="reject">
                                    <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                </form>
                            <?php else: ?>
                                <span class="badge badge-secondary"><?php echo ucfirst($row['status']); ?></span>
                            <?php endif; ?>
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
