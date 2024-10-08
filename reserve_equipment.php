<?php
session_start();
$error = '';
$success = '';

// Database connection
$servername = "localhost";
$usernameDB = "root"; // XAMPP username
$passwordDB = ""; // XAMPP password (usually empty)
$dbname = "FYP"; // Your database name

$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch available equipment for reservation
$sql = "SELECT * FROM equipment WHERE status = 'available'";
$equipment_result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the user is logged in
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id']; // Retrieve user_id from session
    } else {
        die("User not logged in");
    }

    $equipment_id = $_POST['equipment_id'];
    $reservation_date = $_POST['reservation_date'];
    $return_date = $_POST['return_date'];

    // Use prepared statement for reservation insertion
    $stmt = $conn->prepare("INSERT INTO reservations (user_id, equipment_id, reservation_date, return_date, status) VALUES (?, ?, ?, ?, 'pending')");
    $stmt->bind_param("iiss", $user_id, $equipment_id, $reservation_date, $return_date);

    if ($stmt->execute()) {
        $success = "Reservation request submitted successfully!";
        // Optionally, update the equipment status
        $sql_update = "UPDATE equipment SET status = 'reserved' WHERE equipment_id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("i", $equipment_id);
        $stmt_update->execute();
    } else {
        $error = "Error: " . $stmt->error;
    }
}

$conn->close(); // Close the connection
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reserve Equipment</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Reserve Equipment</h2>
    <?php if ($error): ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="alert alert-success">
            <?php echo $success; ?>
        </div>
    <?php endif; ?>
    
    <form method="POST" action="reserve_equipment.php">
        <div class="form-group">
            <label for="equipment_id">Select Equipment</label>
            <select class="form-control" id="equipment_id" name="equipment_id" required>
                <?php while ($row = $equipment_result->fetch_assoc()): ?>
                    <option value="<?php echo $row['equipment_id']; ?>">
                        <?php echo $row['label'] . " - " . $row['brand']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="reservation_date">Reservation Date</label>
            <input type="date" class="form-control" id="reservation_date" name="reservation_date" required>
        </div>
        <div class="form-group">
            <label for="return_date">Return Date</label>
            <input type="date" class="form-control" id="return_date" name="return_date" required>
        </div>
        <button type="submit" class="btn btn-primary">Reserve</button>
    </form>
</div>

</body>
</html>
