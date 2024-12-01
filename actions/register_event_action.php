<?php
include('../includes/db.php');
session_start();

$user_id = $_SESSION['user_id'];
$event_id = $_POST['event_id'];

// Check if already registered
$sql = "SELECT * FROM Registrations WHERE user_id = $user_id AND event_id = $event_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "You are already registered for this event.";
    exit;
}

// Insert registration
$sql = "INSERT INTO Registrations (user_id, event_id) VALUES ($user_id, $event_id)";
if ($conn->query($sql) === TRUE) {
    echo "Registration successful!";
    header('Location: ../pages/dashboard.php'); // Redirect to dashboard
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
