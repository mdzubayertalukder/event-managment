<?php
include('../includes/db.php');

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$role = $_POST['role'];

// Check if email already exists
$checkEmail = "SELECT * FROM Users WHERE email = '$email'";
$result = $conn->query($checkEmail);

if ($result->num_rows > 0) {
    // Email already exists
    ?>
    <script>
        alert("This email is already registered!");
        window.location.href = '../pages/register.php';
    </script>
    <?php
} else {
    // Email is unique, proceed with registration
    $sql = "INSERT INTO Users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')";
    
    if ($conn->query($sql) === TRUE) {
        ?>
        <script>
            alert("Registration successful!");
            window.location.href = '../pages/login.php';
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("Error: Registration failed!");
            window.location.href = '../pages/register.php';
        </script>
        <?php
    }
}

$conn->close();
?>