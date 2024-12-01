<?php
include('../includes/db.php');
session_start();

// Check user permission
if ($_SESSION['role'] !== 'Faculty' && $_SESSION['role'] !== 'Admin') {
    echo "Unauthorized action.";
    exit;
}

$name = $_POST['name'];
$description = $_POST['description'];
$category = $_POST['category'];
$date = $_POST['date'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$venue = $_POST['venue'];
$registration_deadline = $_POST['registration_deadline'];
$max_participants = $_POST['max_participants'];
$organizer_id = $_SESSION['user_id'];

// Insert into Events table
$sql = "INSERT INTO Events (name, description, category, date, start_time, end_time, venue, registration_deadline, max_participants, organizer_id, is_approved)
        VALUES ('$name', '$description', '$category', '$date', '$start_time', '$end_time', '$venue', '$registration_deadline', '$max_participants', '$organizer_id', TRUE)";

if ($conn->query($sql) === TRUE) {
    echo "Event created successfully!";
    header('Location: ../pages/faculty_dashboard.php'); // Redirect back to dashboard
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
