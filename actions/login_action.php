<?php
include('../includes/db.php');
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

// Check user
$sql = "SELECT * FROM Users WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['name'] = $user['name'];

        // Redirect based on role
        if ($user['role'] === 'Admin') {
            header('Location: ../pages/admin_dashboard.php');
        } elseif ($user['role'] === 'Faculty') {
            header('Location: ../pages/faculty_dashboard.php');
        } else {
            header('Location: ../pages/dashboard.php');
        }
    } else {
        echo "Invalid password!";
    }
} else {
    echo "No user found!";
}
?>
