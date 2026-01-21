<?php
session_start();

// Clear all session data
$_SESSION = [];

// Destroy the session
session_destroy();

// Redirect back to login page
header("Location: index.php");
exit;
?>