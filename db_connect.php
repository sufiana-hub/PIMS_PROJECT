<?php
// db_connect.php
date_default_timezone_set("Asia/Kuala_Lumpur");

$host = "lesbot-db-server.mysql.database.azure.com";
$username = "sufiana_admin";
$password = "YOUR_DATABASE_PASSWORD"; // Replace with your actual password
$db_name = "pims_db"; 

// Initialize the secure SSL connection for Azure
$conn = mysqli_init();
mysqli_ssl_set($conn, NULL, NULL, NULL, NULL, NULL);
$success = mysqli_real_connect($conn, $host, $username, $password, $db_name, 3306, MYSQLI_CLIENT_SSL);

if (!$success) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to sanitize inputs (Solves the 'Parameter $input' warnings)
function sanitizeInput($conn, $input) {
    return mysqli_real_escape_string($conn, trim($input));
}
?>