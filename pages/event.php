<?php
include('../includes/auth.php');
checkAuth();
checkRole('Faculty');
include('../includes/db.php');
include('../includes/header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        

        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 20px;
            background: #f4f4f4;
        }

        .create-btn {
            background: #2c3e50;
            color: #fff;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
            margin-bottom: 20px;
        }

        .create-btn:hover {
            background: #34495e;
        }

        .event-table {
            width: 100%;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-collapse: collapse;
        }

        .event-table th, 
        .event-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .event-table th {
            background: #2c3e50;
            color: #fff;
        }

        .action-btn {
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            margin-right: 5px;
            color: #fff;
        }

        .edit-btn {
            background: #3498db;
        }

        .delete-btn {
            background: #e74c3c;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="sidebar">
        <?php include 'sidebar.php'; ?>

        </div>

        <div class="main-content">
            <h2>Welcome, Prof. <?php echo $_SESSION['name']; ?>!</h2>
            <a href="create_event.php" class="create-btn">Create New Event</a>

            <table class="event-table">
                <thead>
                    <tr>
                        <th>Event Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Deadline</th>
                        <th>Venue</th>
                        <th>status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM Events WHERE organizer_id = {$_SESSION['user_id']}";
                    $result = $conn->query($sql);

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$row['name']}</td>";
                        echo "<td>{$row['date']}</td>";
                        echo "<td>{$row['start_time']}</td>";
                        echo "<td>{$row['registration_deadline']}</td>";
                        echo "<td>{$row['venue']}</td>";
                        echo "<td>{$row['status']}</td>";
                        echo "<td>
                                <a href='edit_event.php?id={$row['id']}' class='action-btn edit-btn'>Edit</a>
                                <a href='../actions/delete_event.php?id={$row['id']}' class='action-btn delete-btn' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                            </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>