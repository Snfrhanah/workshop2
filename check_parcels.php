<?php
// Initialize the session
session_start();

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "bitd123";
$dbname = "workshop";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sample logic to check for ready-to-pickup parcels
$username = $_SESSION['username'];
$sql = "SELECT COUNT(*) AS count FROM parcel WHERE student_id = '$username' AND parcel_Status = 'READY TO PICKUP'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $readyToPickup = $row['count'] > 0;
} else {
    $readyToPickup = false;
}

// Return the result as JSON
echo json_encode(['readyToPickup' => $readyToPickup]);

// Close the database connection
$conn->close();
?>
