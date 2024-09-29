<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

include 'db_connect.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reservation_id = $_POST['reservation_id'];
    $action = $_POST['action'];

    // Update the reservation status based on the action
    if ($action === 'approve') {
        $query = "UPDATE reservations SET status = 'approved' WHERE id = $reservation_id";
    } elseif ($action === 'reject') {
        $query = "UPDATE reservations SET status = 'rejected' WHERE id = $reservation_id";
    }

    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = "Reservation status updated successfully.";
    } else {
        $_SESSION['message'] = "Failed to update reservation status.";
    }

    header('Location: manage_reservations.php');
    exit();
}
?>
