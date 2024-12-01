<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .sidebar {
            width: 250px;
            background: #2c3e50;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
        }

        .sidebar ul {
            list-style: none;
            padding: 20px 0;
        }

        .sidebar ul li {
            padding: 15px 25px;
            border-bottom: 1px solid #34495e;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            display: block;
            font-size: 16px;
        }

        .sidebar ul li:hover {
            background: #34495e;
        }
    </style>
</head>
<body>
<div class="sidebar">
    <ul>
        <li><a href="faculty_dashboard.php">Dashboard</a></li>
        <li><a href="event.php">Events</a></li>
        <li><a href="registration_list.php">Registrations</a></li>
        <li><a href="profile.php">Profile</a></li>
        <li><a href="../actions/logout_action.php">Log Out</a></li>
    </ul>
</div>
</body>
</html>