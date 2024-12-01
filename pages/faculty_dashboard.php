<?php
include('../includes/auth.php');
checkAuth();
checkRole('Faculty');
include('../includes/db.php');
include('../includes/header.php');

// Get total events for current faculty
$eventCountSql = "SELECT COUNT(*) as total_events FROM Events WHERE organizer_id = {$_SESSION['user_id']}";
$eventResult = $conn->query($eventCountSql);
$totalEvents = $eventResult->fetch_assoc()['total_events'];

// Get total registrations for faculty's events
$registrationSql = "SELECT COUNT(*) as total_registrations FROM Registrations r 
                    JOIN Events e ON r.event_id = e.id 
                    WHERE e.organizer_id = {$_SESSION['user_id']}";
$registrationResult = $conn->query($registrationSql);
$totalRegistrations = $registrationResult->fetch_assoc()['total_registrations'];

// Get registered students details
$studentsSql = "SELECT u.name, u.email, e.name as event_name, r.registration_date 
                FROM Users u 
                JOIN Registrations r ON u.id = r.user_id 
                JOIN Events e ON r.event_id = e.id 
                WHERE e.organizer_id = {$_SESSION['user_id']}
                ORDER BY r.registration_date DESC";
$studentsResult = $conn->query($studentsSql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Dashboard</title>
    <style>
        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: #2c3e50;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
        }

        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 20px;
            background: #f4f4f4;
        }

        .stats-container {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            flex: 1;
            text-align: center;
        }

        .stat-number {
            font-size: 36px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .stat-label {
            color: #666;
            font-size: 16px;
        }

        .registrations-table {
            width: 100%;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-top: 20px;
            border-collapse: collapse;
        }

        .registrations-table th,
        .registrations-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .registrations-table th {
            background: #2c3e50;
            color: #fff;
        }

        .registrations-table tr:hover {
            background: #f5f5f5;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <?php include('../includes/sidebar.php'); ?>
        
        <div class="main-content">
            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-number"><?php echo $totalEvents; ?></div>
                    <div class="stat-label">Total Events Created</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number"><?php echo $totalRegistrations; ?></div>
                    <div class="stat-label">Total Registrations</div>
                </div>
            </div>

            <h2>Student Registrations</h2>
            <table class="registrations-table">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Email</th>
                        <th>Event Name</th>
                        <th>Registration Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $studentsResult->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['event_name']); ?></td>
                        <td><?php echo date('d M Y', strtotime($row['registration_date'])); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>