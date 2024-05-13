<?php
// Start the session
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Optionally, you can redirect the user or send a response
// header('Location: login.php');
// exit();
echo json_encode(array("success" => true));
?>