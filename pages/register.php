<?php include('../includes/db.php'); ?>
<?php include('../includes/header.php'); ?>

<!-- External CSS file linking -->
<link rel="stylesheet" type="text/css" href="../assets/style.css">

<div class="register-container">
    <!-- Logo Section -->
    <div class="logo">
        <img src="../images/logo.png" alt="Logo"> <!-- Replace with your logo URL -->
    </div>

    <!-- Registration Form -->
    <form method="POST" action="../actions/register_action.php" class="register-form">
        <h2>Register</h2>
        <label>Name:</label>
        <input type="text" name="name" required>
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <label>Role:</label>
        <select name="role" required>
            <option value="Student">Student</option>
            <option value="Faculty">Faculty</option>
        </select>
        <button type="submit">Register</button>

        <!-- Login Link -->
        <p class="login-link">Already have an account? <a href="../pages/login.php">Login here</a></p>
    </form>
</div>

<?php include('../includes/footer.php'); ?>