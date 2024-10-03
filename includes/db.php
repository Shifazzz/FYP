<?php
$host = 'localhost';  // XAMPP runs on localhost
$db = 'inventory_management';  // Your database name
$user = 'root';  // Default MySQL username in XAMPP is 'root'
$pass = '';  // Default MySQL password in XAMPP is blank

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
