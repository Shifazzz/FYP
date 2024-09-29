<?php
session_start(); // Start the session to access session variables
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Inventory System</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <?php if (isset($_SESSION['role'])): ?>
                <!-- Display the dashboard link based on user role -->
                <?php if ($_SESSION['role'] === 'student'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="student_dashboard.php">Dashboard</a>
                    </li>
                <?php elseif ($_SESSION['role'] === 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_dashboard.php">Dashboard</a>
                    </li>
                <?php endif; ?>
                <!-- Logout link for logged-in users -->
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            <?php else: ?>
                <!-- Login link for non-logged-in users -->
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
