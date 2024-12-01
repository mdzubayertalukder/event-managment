<?php
// File: ../actions/logout_action.php
session_start();

// Destroy the session
session_destroy();

// Clear all session variables
$_SESSION = array();

// Redirect to login page
header("Location: ../pages/login.php");
exit();
?>