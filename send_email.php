<?php
// Database connection settings
$host = "lesbot-db-server.mysql.database.azure.com";
$username = "sufiana_admin";
$password = "YOUR_DATABASE_PASSWORD"; // Put the password you created for the server here
$db_name = "pims_db"; 

// Azure requires SSL for the connection
$conn = mysqli_init();
mysqli_ssl_set($conn, NULL, NULL, NULL, NULL, NULL);
mysqli_real_connect($conn, $host, $username, $password, $db_name, 3306, MYSQLI_CLIENT_SSL);

if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}


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
