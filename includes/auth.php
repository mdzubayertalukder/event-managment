<?php
session_start();

// Redirect if not logged in
function checkAuth() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: /pages/login.php');
        exit;
    }
}

// Check user role
function checkRole($role) {
    if ($_SESSION['role'] !== $role) {
        header('Location: /pages/dashboard.php');
        exit;
    }
}
?>
