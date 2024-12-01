<?php
include('../includes/auth.php');
checkAuth();
checkRole('Student');
include('../includes/db.php');

// Get user's registration count
$userRegCountSql = "SELECT COUNT(*) as total FROM Registrations WHERE user_id = {$_SESSION['user_id']}";
$userRegResult = $conn->query($userRegCountSql);
$userRegistrations = $userRegResult->fetch_assoc()['total'];

// Get upcoming events count
$upcomingEventsSql = "SELECT COUNT(*) as total FROM Events WHERE date > CURDATE()";
$upcomingResult = $conn->query($upcomingEventsSql);
$upcomingEvents = $upcomingResult->fetch_assoc()['total'];

// Get running events count
$runningEventsSql = "SELECT COUNT(*) as total FROM Events WHERE date = CURDATE()";
$runningResult = $conn->query($runningEventsSql);
$runningEvents = $runningResult->fetch_assoc()['total'];

// Get detailed event information
$eventsSql = "SELECT e.*, u.name as organizer_name, 
              (SELECT COUNT(*) FROM Registrations WHERE event_id = e.id) as registered_count,
              (e.max_participants - (SELECT COUNT(*) FROM Registrations WHERE event_id = e.id)) as available_seats
              FROM Events e 
              JOIN Users u ON e.organizer_id = u.id
              ORDER BY e.date ASC";
$eventsResult = $conn->query($eventsSql);
?>
 <div class="wrapper">
 <?php include 'studentslidebar.php'; ?>

<div class="main-content">
    <!-- Statistics Cards -->
    <section id="dashboard">
        <h2>Welcome, <?php echo $_SESSION['name']; ?>!</h2>
        <div class="stats">
            <div class="stat-card">
                <h3>Your Registrations</h3>
                <p class="stat-number"><?php echo $userRegistrations; ?></p>
            </div>
            <div class="stat-card">
                <h3>Upcoming Events</h3>
                <p class="stat-number"><?php echo $upcomingEvents; ?></p>
            </div>
            <div class="stat-card">
                <h3>Running Events</h3>
                <p class="stat-number"><?php echo $runningEvents; ?></p>
            </div>
        </div>
    </section>

    <!-- Events Table -->
    <section id="events">
        <h3>Available Events</h3>
        <table class="events-table">
            <thead>
                <tr>
                    <th>Event Title</th>
                    <th>Organizer</th>
                    <th>Date & Time</th>
                    <th>Registration Deadline</th>
                    <th>Available Seats</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($event = $eventsResult->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($event['name']); ?></td>
                    <td><?php echo htmlspecialchars($event['organizer_name']); ?></td>
                    <td><?php echo date('d M Y h:i A', strtotime($event['date'] . ' ' . $event['start_time'])); ?></td>
                    <td><?php echo date('d M Y h:i A', strtotime($event['registration_deadline'])); ?></td>
                    <td>
                        <?php echo $event['available_seats']; ?> / <?php echo $event['max_participants']; ?>
                    </td>
                    <td>
                        <a href="event_details.php?id=<?php echo $event['id']; ?>" class="btn-details">Details</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </section>
</div>
</div>
<style>
/* Reset and base styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background: #f4f4f4;
}

/* Wrapper and layout */
.wrapper {
    display: flex;
    min-height: 100vh;
}

/* Sidebar styling */
.sidebar {
    width: 250px;
    background: #2c3e50;
    min-height: 100vh;
    position: fixed;
    left: 0;
    top: 0;
    z-index: 1000;
}

/* Main content area */
.main-content {
    flex: 1;
    margin-left: 250px; /* Same as sidebar width */
    padding: 20px;
    background: #f4f4f4;
    min-height: 100vh;
}

/* Statistics cards */
.stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    text-align: center;
}

.stat-number {
    font-size: 24px;
    font-weight: bold;
    color: #2c3e50;
}

/* Events table */
.events-table {
    width: 100%;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    margin-top: 20px;
    border-collapse: collapse;
}

.events-table th,
.events-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.events-table th {
    background: #2c3e50;
    color: #fff;
}

.btn-details {
    display: inline-block;
    padding: 6px 12px;
    background: #3498db;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    transition: background 0.3s;
}

.btn-details:hover {
    background: #2980b9;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .sidebar {
        width: 0;
        overflow: hidden;
    }
    
    .main-content {
        margin-left: 0;
    }
}
</style>
<?php
include('../includes/auth.php');
checkAuth();
checkRole('Student');
include('../includes/db.php');

// Get user's registration count
$userRegCountSql = "SELECT COUNT(*) as total FROM Registrations WHERE user_id = {$_SESSION['user_id']}";
$userRegResult = $conn->query($userRegCountSql);
$userRegistrations = $userRegResult->fetch_assoc()['total'];

// Get upcoming events count
$upcomingEventsSql = "SELECT COUNT(*) as total FROM Events WHERE date > CURDATE()";
$upcomingResult = $conn->query($upcomingEventsSql);
$upcomingEvents = $upcomingResult->fetch_assoc()['total'];

// Get running events count
$runningEventsSql = "SELECT COUNT(*) as total FROM Events WHERE date = CURDATE()";
$runningResult = $conn->query($runningEventsSql);
$runningEvents = $runningResult->fetch_assoc()['total'];

// Get detailed event information
$eventsSql = "SELECT e.*, u.name as organizer_name, 
              (SELECT COUNT(*) FROM Registrations WHERE event_id = e.id) as registered_count,
              (e.max_participants - (SELECT COUNT(*) FROM Registrations WHERE event_id = e.id)) as available_seats
              FROM Events e 
              JOIN Users u ON e.organizer_id = u.id
              ORDER BY e.date ASC";
$eventsResult = $conn->query($eventsSql);
?>

<div class="main-content">
    <!-- Statistics Cards -->
    <section id="dashboard">
        <h2>Welcome, <?php echo $_SESSION['name']; ?>!</h2>
        <div class="stats">
            <div class="stat-card">
                <h3>Your Registrations</h3>
                <p class="stat-number"><?php echo $userRegistrations; ?></p>
            </div>
            <div class="stat-card">
                <h3>Upcoming Events</h3>
                <p class="stat-number"><?php echo $upcomingEvents; ?></p>
            </div>
            <div class="stat-card">
                <h3>Running Events</h3>
                <p class="stat-number"><?php echo $runningEvents; ?></p>
            </div>
        </div>
    </section>

    <!-- Events Table -->
    <section id="events">
        <h3>Available Events</h3>
        <table class="events-table">
            <thead>
                <tr>
                    <th>Event Title</th>
                    <th>Organizer</th>
                    <th>Date & Time</th>
                    <th>Registration Deadline</th>
                    <th>Available Seats</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($event = $eventsResult->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($event['name']); ?></td>
                    <td><?php echo htmlspecialchars($event['organizer_name']); ?></td>
                    <td><?php echo date('d M Y h:i A', strtotime($event['date'] . ' ' . $event['start_time'])); ?></td>
                    
                    <td>
                        <?php echo $event['available_seats']; ?> / <?php echo $event['max_participants']; ?>
                    </td>
                    <td>
                        <a href="event_details.php?id=<?php echo $event['id']; ?>" class="btn-details">Details</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </section>
</div>

<style>
.stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    text-align: center;
}

.stat-number {
    font-size: 24px;
    font-weight: bold;
    color: #2c3e50;
    margin-top: 10px;
}

.events-table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.events-table th,
.events-table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.events-table th {
    background: #2c3e50;
    color: #fff;
}

.btn-details {
    display: inline-block;
    padding: 6px 12px;
    background: #3498db;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    transition: background 0.3s;
}

.btn-details:hover {
    background: #2980b9;
}
</style>