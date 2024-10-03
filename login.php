<?php
session_start();
$error = '';

// Database connection
$servername = "localhost";
$usernameDB = "root"; // default XAMPP username
$passwordDB = ""; // default XAMPP password (usually empty)
$dbname = "FYP"; // replace with your database name

$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data and sanitize input
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Query to check if username exists
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Check if password matches
        if ($row['password'] === $password) { // Direct comparison
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            // Redirect based on role
            if ($_SESSION['role'] === 'student') {
                header('Location: student_dashboard.php');
                exit();
            } elseif ($_SESSION['role'] === 'admin') {
                header('Location: admin_dashboard.php');
                exit();
            }
        } else {
            $error = 'Invalid username or password';
        }
    } else {
        $error = 'Invalid username or password';
    }
}

$conn->close(); // Close connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - School of Design & Arts</title>

    <!-- Add Bootstrap CSS for layout and design -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- Custom styles -->
    <style>
        /* Your existing styles */
    </style>
</head>
<body>

    <div class="login-container">
        <!-- Left Section with Image -->
        <div class="left-section">
            <img src="images/giphy.gif" alt="Login Image">
        </div>

        <!-- Right Section with Form -->
        <div class="right-section">
            <h2>Login</h2>
            <!-- Error Display -->
            <?php if ($error): ?>
                <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="login.php">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <p class="mt-3">Don't have an account? <a href="register.php">Register here</a></p>
            </form>
        </div>
    </div>

</body>
</html>
