<?php include('../includes/db.php'); ?>
<?php include('../includes/header.php'); ?>

<!-- External CSS file linking -->
<link rel="stylesheet" type="text/css" href="../assets/style.css">

<div class="login-container">
    <!-- Logo Section -->
    <div class="logo">
        <img src="../images/logo.png" alt="Logo"> <!-- Replace with your logo URL -->
    </div>

    <!-- Login Form -->
    <form method="POST" action="../actions/login_action.php" class="login-form">
        <h2>Login</h2>
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Login</button>

        <!-- Create Account Link -->
        <p class="create-account">Don't have an account? <a href="../pages/register.php">Create an account</a></p>
    </form>
</div>

<?php include('../includes/footer.php'); ?>