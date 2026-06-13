<?php
// Database connection settings
$host = "localhost";
$username = "root";
$password = "Sufi123?!";
$database = "pims_pbu"; // Update with your database name

// Create a new database connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize form inputs
function sanitize($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Get the form data and sanitize inputs
  $name = sanitize($_POST["name"]);
  $email = sanitize($_POST["email"]);
  $subject = sanitize($_POST["subject"]);
  $message = sanitize($_POST["message"]);

  // Insert the form data into the database
  $sql = "INSERT INTO feedback (name, email, subject, feedback) VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssss", $name, $email, $subject, $message);
  $dbSuccess = $stmt->execute();

  if ($dbSuccess) {
    echo "Success";
  } else {
    http_response_code(500);
    echo "Database Error";
  }
} else {
  http_response_code(400);
  echo "Bad Request";
}

// Close the database connection
$conn->close();
?>
