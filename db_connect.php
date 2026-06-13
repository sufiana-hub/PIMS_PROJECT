<?php
$host = "lesbot-db-server.mysql.database.azure.com";
$username = "sufiana_admin";
$password = "YOUR_PASSWORD";
$db_name = "pims_db";

// Path to the certificate you just downloaded
$ssl_cert = __DIR__ . "/DigiCertGlobalRootG2.crt.pem";

$conn = mysqli_init();

// Tell PHP to use the specific Azure Certificate
mysqli_ssl_set($conn, NULL, NULL, $ssl_cert, NULL, NULL);

$success = mysqli_real_connect($conn, $host, $username, $password, $db_name, 3306, NULL, MYSQLI_CLIENT_SSL);

if (!$success) {
    die("Connection failed: " . mysqli_connect_error());
}
?>