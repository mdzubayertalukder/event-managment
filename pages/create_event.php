<?php
include('../includes/auth.php');
checkAuth();
checkRole('Faculty');
include('../includes/db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
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

        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 20px;
            background: #f4f4f4;
        }

        .form-container {
            max-width: 800px;
            margin: 20px auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .form-title {
            text-align: center;
            margin-bottom: 30px;
            color: #2c3e50;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .submit-btn {
            background: #2c3e50;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 4px;
            width: 100%;
            cursor: pointer;
        }

        .submit-btn:hover {
            background: #34495e;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="sidebar">
            <ul>
            <?php include 'sidebar.php'; ?>

            </ul>
        </div>

        <div class="main-content">
            <div class="form-container">
                <h2 class="form-title">Create New Event</h2>
                <form method="POST" action="../actions/event_action.php">
                <div class="form-group">
    <label>Event Name</label>
    <input type="text" name="name" required>
</div>

<div class="form-group">
    <label>Description</label>
    <textarea name="description" required></textarea>
</div>

<div class="form-group">
    <label>Category</label>
    <select name="category">
        <option value="Academic">Academic</option>
        <option value="Cultural">Cultural</option>
        <option value="Sports">Sports</option>
        <option value="Social">Social</option>
    </select>
</div>

<div class="form-group">
    <label>Date</label>
    <input type="date" name="date" required>
</div>

<div class="form-group">
    <label>Start Time</label>
    <input type="time" name="start_time" required>
</div>

<div class="form-group">
    <label>Registration Deadline</label>
    <input type="datetime-local" name="registration_deadline" required>
</div>

<div class="form-group">
    <label>Venue</label>
    <input type="text" name="venue" required>
</div>

<div class="form-group">
    <label>Status</label>
    <select name="status">
        <option value="Active">Active</option>
        <option value="Upcoming">Upcoming</option>
        <option value="Closed">Closed</option>
    </select>
</div>
                    <button type="submit" class="submit-btn">Create Event</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>