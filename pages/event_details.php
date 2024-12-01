<?php
include('../includes/auth.php');
checkAuth();
include('../includes/db.php');
include('../includes/header.php');

// Get event ID from query string
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Event ID is missing or invalid.";
    exit;
}

// Sanitize the event ID
$event_id = (int) $_GET['id']; // Cast to integer to prevent SQL injection

// Fetch event details
$sql = "SELECT * FROM Events WHERE id = $event_id";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $event = $result->fetch_assoc();
} else {
    echo "Event not found.";
    exit;
}
?>

<h2>Event Details</h2>
<p><strong>Name:</strong> <?php echo htmlspecialchars($event['name']); ?></p>
<p><strong>Description:</strong> <?php echo htmlspecialchars($event['description']); ?></p>
<p><strong>Category:</strong> <?php echo htmlspecialchars($event['category']); ?></p>
<p><strong>Date:</strong> <?php echo htmlspecialchars($event['date']); ?></p>
<p><strong>Time:</strong> <?php echo htmlspecialchars($event['start_time']) . " - " . htmlspecialchars($event['end_time']); ?></p>
<p><strong>Venue:</strong> <?php echo htmlspecialchars($event['venue']); ?></p>
<p><strong>Registration Deadline:</strong> <?php echo htmlspecialchars($event['registration_deadline']); ?></p>
<p><strong>Maximum Participants:</strong> <?php echo htmlspecialchars($event['max_participants']); ?></p>

<?php
// Check if the user is already registered
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM Registrations WHERE user_id = $user_id AND event_id = $event_id";
$registration_result = $conn->query($sql);

if ($registration_result && $registration_result->num_rows > 0) {
    echo "<p>You are already registered for this event.</p>";
} elseif (strtotime($event['registration_deadline']) < time()) {
    echo "<p>Registration is closed.</p>";
} else {
    // Display registration form
?>
    <form method="POST" action="../actions/register_event_action.php">
        <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
        <button type="submit">Register for this Event</button>
    </form>
<?php } ?>

<?php include('../includes/footer.php'); ?>
