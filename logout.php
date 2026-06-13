<?php
session_start();

// Destroy the session to logout the user
session_destroy();

// Redirect the user to the login page after logout
header("Location: index.php");
exit();
?>
