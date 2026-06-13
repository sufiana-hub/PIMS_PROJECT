<?php
// session.php
require_once('db_connect.php'); // Use the secure connection we made
session_start();

// Check if the session variable exists (we used 'email' in login.php)
if(!isset($_SESSION['email'])){
    header("location: login.php");
    die();
}

$user_check = $_SESSION['email'];

// Fetch the user's name from the database to create $login_session
$ses_sql = mysqli_query($conn, "SELECT fullname FROM signup WHERE email = '$user_check'");
$row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);

$login_session = $row['fullname'];

if(!isset($login_session)){
    header("location: login.php");
    die();
}
?>