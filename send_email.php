<?php
// Database connection settings
$host = "localhost";
$username = "root";
$password = "";
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

  // Set the recipient email address
  $recipient = "pimsprojectt@gmail.com"; // Replace with your desired recipient email address

  // Set the email headers
  $headers = "From: $name <$email>\r\n";
  $headers .= "Reply-To: $email\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

  // Compose the email message
  $emailMessage = "Name: $name\n";
  $emailMessage .= "Email: $email\n";
  $emailMessage .= "Subject: $subject\n";
  $emailMessage .= "Message:\n$message";

  // Send the email
  $emailSuccess = mail($recipient, $subject, $emailMessage, $headers);

  // Insert the form data into the database
  $sql = "INSERT INTO feedback (name, email, subject, feedback) VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssss", $name, $email, $subject, $message);
  $dbSuccess = $stmt->execute();

  // Prepare the response data
  $response = [
    'success' => ($emailSuccess && $dbSuccess)
  ];

  // Send the response as JSON
  header('Content-Type: application/json');
  echo json_encode($response);
} else {
  // If the request method is not POST, return an error response
  $response = [
    'success' => false
  ];

  header('Content-Type: application/json');
  echo json_encode($response);
}

// Close the database connection
$conn->close();
?>
