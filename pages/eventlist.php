<?php
include('../includes/auth.php');
checkAuth();
checkRole('Student');
include('../includes/db.php');

// Get all events with registration status
$sql = "SELECT e.*, u.name as organizer_name,
        (SELECT COUNT(*) FROM Registrations WHERE event_id = e.id) as registered_count,
        (e.max_participants - (SELECT COUNT(*) FROM Registrations WHERE event_id = e.id)) as available_seats,
        (SELECT COUNT(*) FROM Registrations WHERE event_id = e.id AND user_id = {$_SESSION['user_id']}) as is_registered
        FROM Events e 
        JOIN Users u ON e.organizer_id = u.id
        ORDER BY e.date ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Event List</title>
    <style>
        .event-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
            padding: 20px;
            margin-left: 250px; /* For sidebar */
        }

        .event-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 15px;
            transition: transform 0.3s ease;
        }

        .event-card:hover {
            transform: translateY(-5px);
        }

        .event-title {
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .event-organizer {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .event-description {
            color: #666;
            font-size: 14px;
            margin-bottom: 15px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .event-info {
            font-size: 14px;
            margin-bottom: 5px;
        }

        .status-closed {
            background: #e74c3c;
            color: #fff;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
        }

        .status-open {
            background: #2ecc71;
            color: #fff;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
        }

        .btn-register {
            display: block;
            width: 100%;
            padding: 8px;
            text-align: center;
            background: #3498db;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-register:hover {
            background: #2980b9;
        }

        .btn-registered {
            background: #27ae60;
            cursor: default;
        }
    </style>
</head>
<body>
    <?php include 'studentslidebar.php'; ?>

    <div class="event-grid">
        <?php while($event = $result->fetch_assoc()): ?>
            <div class="event-card">
                <div class="event-title"><?php echo htmlspecialchars($event['name']); ?></div>
                <div class="event-organizer">By: <?php echo htmlspecialchars($event['organizer_name']); ?></div>
                <div class="event-description"><?php echo htmlspecialchars($event['description']); ?></div>
                
                <div class="event-info">
                    Date: <?php echo date('d M Y', strtotime($event['date'])); ?>
                </div>
                
                <div class="event-info">
                    <?php 
                    $deadline = strtotime($event['registration_deadline']);
                    $now = time();
                    if ($now > $deadline) {
                        echo '<span class="status-closed">Registration Closed</span>';
                    } else {
                        echo '<span class="status-open">Open until ' . date('d M Y', $deadline) . '</span>';
                    }
                    ?>
                </div>
                
                <div class="event-info">
                    Available Seats: <?php echo $event['available_seats']; ?> / <?php echo $event['max_participants']; ?>
                </div>

                <?php if ($event['is_registered'] > 0): ?>
                    <button class="btn-register btn-registered" disabled>Already Registered</button>
                <?php elseif ($now <= $deadline && $event['available_seats'] > 0): ?>
                    <a href="../actions/register_event.php?event_id=<?php echo $event['id']; ?>" 
                       class="btn-register">Register Now</a>
                <?php else: ?>
                    <button class="btn-register status-closed" disabled>Registration Closed</button>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>