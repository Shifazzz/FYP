<?php
session_start();
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Dummy credentials for testing
    $users = [
        'student1' => ['password' => 'password123', 'role' => 'student'],
        'admin1' => ['password' => 'adminpassword', 'role' => 'admin']
    ];

    // Retrieve form data and sanitize input
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Check if username exists and password matches
    if (isset($users[$username]) && $users[$username]['password'] === $password) {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $users[$username]['role'];

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
}
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
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f4f4f9;
        }

        .login-container {
            display: flex;
            max-width: 900px;
            width: 100%;
            background-color: white;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .left-section {
            flex: 1;
            background-color: #f4f7fc;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .left-section img {
            max-width: 100%;
            max-height: 100%;
            border-radius: 0 0 0 10px;
        }

        .right-section {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: #ffffff;
        }

        .right-section h2 {
            text-align: center;
            margin-bottom: 20px;
            font-family: 'Arial', sans-serif;
            color: #333;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .form-group label {
            font-weight: bold;
        }

        .alert-danger {
            margin-bottom: 20px;
        }
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
            </form>
        </div>
    </div>

</body>
</html>
