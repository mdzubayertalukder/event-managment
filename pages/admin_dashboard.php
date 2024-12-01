<?php
include('../includes/auth.php');
checkAuth();
checkRole('Admin');
include('../includes/header.php');

echo "<h2>Welcome, Admin {$_SESSION['name']}!</h2>";
echo "<a href='create_event.php'>Create New Event</a>";

// Fetch all events
$sql = "SELECT * FROM Events";
$result = $conn->query($sql);

echo "<h3>All Events:</h3>";
while ($row = $result->fetch_assoc()) {
    echo "<p>{$row['name']} - {$row['date']} at {$row['venue']}</p>";
}
?>
