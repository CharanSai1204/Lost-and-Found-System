<?php
session_start(); // Start the session (ensure this is present at the beginning of the code)

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page or any other desired page after logout
header('Location:login.php'); 
exit();
?>
