<?php
// Database connection parameters
$servername = "localhost"; // Change this if your database server is different
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "pims_pbu"; // Change this to your database name

// Create a new database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the form data
  $name = isset($_POST["name"]) ? $_POST["name"] : "";
  $description = isset($_POST["description"]) ? $_POST["description"] : "";

  // Prepare the SQL statement to insert data into the database
  $sql = "INSERT INTO infaq (name, description) VALUES ('$name', '$description')";

  // Execute the SQL statement
  if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
  } else {
    echo "Error: " . $conn->error;
  }
}

// Close the database connection
$conn->close();
?>


<script>
  function submitForm(nameField, descriptionField, linkId, linkUrl) {
    const name = document.getElementById(nameField).value;
    const description = document.getElementById(descriptionField).value;

    if (name.trim() === '' || description.trim() === '') {
      alert('Please fill in the name and description fields.');
    } else {
      // Create a FormData object and append the form data
      const formData = new FormData();
      formData.append('name', name);
      formData.append('description', description);

      // Send the form data to the server using fetch
      fetch('submit_infaq.php', {
          method: 'POST',
          body: formData
        })
        .then(response => response.text())
        .then(data => {
          alert(data); // Display the response from the server
          if (data === 'Data inserted successfully') {
            const link = document.getElementById(linkId);
            link.classList.remove('disabled-link');
            link.href = linkUrl;
            link.removeAttribute('onclick');
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('An error occurred while submitting the data. Please try again.');
        });
    }
  }
</script>
 

