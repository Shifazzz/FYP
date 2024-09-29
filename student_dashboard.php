<?php
session_start();

// Check if the user is logged in and has the role 'student'
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'student') {
    header('Location: login.php');
    exit();
}

include 'includes/header.php'; // Include the header
?>

<div class="container-fluid">
    <div class="row">
        <!-- Include the Sidebar -->
        <?php include 'includes/sidebar.php'; ?>

        <!-- Main content area -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h2 class="text-primary">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
                <p class="lead text-muted">Your one-stop portal for managing equipment reservations.</p>
            </div>

            <!-- Quick Actions with Card Layout -->
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body text-center">
                            <i class="fas fa-plus-circle fa-3x text-primary mb-3"></i>
                            <h5 class="card-title">Reserve Equipment</h5>
                            <a href="reserve_equipment.php" class="btn btn-primary btn-block">Reserve Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body text-center">
                            <i class="fas fa-calendar-check fa-3x text-success mb-3"></i>
                            <h5 class="card-title">View My Reservations</h5>
                            <a href="view_reservations.php" class="btn btn-success btn-block">View Reservations</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body text-center">
                            <i class="fas fa-search fa-3x text-info mb-3"></i>
                            <h5 class="card-title">Check Availability</h5>
                            <a href="check_availability.php" class="btn btn-info btn-block">Check Availability</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Include Footer -->
<?php include 'includes/footer.php'; ?>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
