<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>PIMS</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets\img\pimslogo.png" rel="icon">
  <link href="assets\img\pimslogo.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Open Sans', sans-serif;
      background-color: #f4f4f4;
      color: #333;
    }

    header {
      background-color: #fff;
      box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
      padding: 20px 0;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      z-index: 9999;
    }

    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .navbar ul {
      display: flex;
      list-style: none;
      margin: 0;
      padding: 0;
    }

    .navbar ul li {
      margin-right: 20px;
    }

    .navbar ul li:last-child {
      margin-right: 0;
    }

    .navbar ul li a {
      color: #000;
      text-decoration: none;
      transition: 0.3s;
    }

    .navbar ul li a:hover {
      color: #6c757d;
    }

    .card {
      background-color: #fff;
      box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      padding: 30px;
      max-width: 800px;
      margin: 100px auto;
      text-align: center;
    }

    .card h2 {
      font-size: 24px;
      margin-bottom: 10px;
    }

    .card h4 {
      font-size: 16px;
      margin-bottom: 20px;
      color: #6c757d;
    }

    .card form div {
      margin-bottom: 15px;
    }

    .card form label {
      display: block;
      text-align: left;
      margin-bottom: 5px;
    }

    .card form input[type="text"] {
      width: 100%;
      padding: 10px;
      border-radius: 4px;
      border: 1px solid #ddd;
      outline: none;
    }

    .card form .submit-button {
      background-color: #6c757d;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 4px;
      cursor: pointer;
    }

    .card form .submit-button:hover {
      background-color: #555;
    }

    .card .error-message {
      color: red;
      margin-top: 10px;
    }

    table {
      width: 100%;
      margin-top: 30px;
      border-collapse: collapse;
    }

    th,
    td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #f2f2f2;
    }
  </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="index.php">PIMS PBU<img src="assets\img\pimslogo.png" alt="" class="img-fluid"></a></h1>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="index.php">Utama</a></li>
          <li><a class="nav-link scrollto o" href="activity.php">Menu PIMS</a></li>
          <li><a class="nav-link scrollto" href="infaq.php">Sumbangan</a></li>
          <li><a class="getstarted scrollto" href="logout.php" id="logout-btn">Log Keluar</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <script>
        // Add event listeners to the "Log Keluar" button
        document.getElementById("logout-btn").addEventListener("click", logout);

        // Function to handle the "Log Keluar" button click
        function logout(event) {
          event.preventDefault(); // Prevent the default link behavior

          // Display pop-up box message
          var confirmation = confirm("Adakah anda pasti?");

          // If user clicks "Okey"
          if (confirmation) {
            // Redirect user to index.php
            window.location.href = "index.php";
          }
        }
      </script>

    </div>
  </header><!-- End Header -->

  <div class="card">
    <h2>TEMPAHAN IFTAR PELAJAR DI PUSAT ISLAM<img src="assets\img\pimslogo.png" alt="" class="img-fluid"></h2>
    <h4><b>First come, first serve</b></h4>

    <form id="reservation-form" method="POST" onsubmit="return validateForm()">
      <div>
        <label for="fname"><b>NAMA PENUH:</b></label>
        <input type="text" id="fname" name="fname" placeholder="Nama Penuh" required>
      </div>

      <div>
        <label for="lname"><b>NO KAD MATRIK:</b></label>
        <input type="text" id="lname" name="lname" placeholder="Kad Matrik" required>
      </div>

      <div>
        <label for="telephone"><b>NO TELEFON:</b></label>
        <input type="text" id="telephone" name="telephone" placeholder="No Telefon" required>
      </div>

      <div>
        <label for="room"><b>NO BILIK:</b></label>
        <input type="text" id="room" name="room" placeholder="No Bilik" required>
      </div>

      <div>
        <div><b> *Sila semak semula data anda bagi mengelakkan kekeliruan pihak rapi* </b></div>
        <input type="submit" class="submit-button" value="Submit">
      </div>

      <p class="error-message" id="error-message"></p>
    </form>

<?php
// Database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "pims_pbu";

$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the form data
  $fullname = sanitizeInput($conn, $_POST['fname']);
  $nomatric = sanitizeInput($conn, $_POST['lname']);
  $telephoneno = sanitizeInput($conn, $_POST['telephone']);
  $roomno = sanitizeInput($conn, $_POST['room']);

  // Check if the limit has been reached
  $limitQuery = "SELECT COUNT(*) AS total FROM ramadhan";
  $limitResult = mysqli_query($conn, $limitQuery);
  $limitData = mysqli_fetch_assoc($limitResult);
  $currentCount = (int) $limitData['total'];

  if ($currentCount >= 30) {
    echo "<script>alert('You have reached the limit of 30 entries.');</script>";
  } else {
    // Query to insert the form data into the database
    $query = "INSERT INTO ramadhan (fullname, nomatric, telephoneno, roomno) VALUES ('$fullname', '$nomatric', '$telephoneno', '$roomno')";

    if (mysqli_query($conn, $query)) {
      echo "<script>alert('Your data has been inserted.');</script>";
    } else {
      echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
  }
}

// Function to sanitize user inputs and prevent SQL injection
function sanitizeInput($conn, $input)
{
  $input = trim($input);
  $input = mysqli_real_escape_string($conn, $input);
  return $input;
}

// Display the table with all the entries
$sql = "SELECT * FROM ramadhan";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  echo '<table>';
  echo '<tr><th>No</th><th>Nama Penuh</th><th>No Kad Matrik</th><th>No Telefon</th><th>No Bilik</th></tr>';

  $count = 1;
  while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>' . $count . '</td>';
    echo '<td>' . $row['fullname'] . '</td>';
    echo '<td>' . $row['nomatric'] . '</td>';
    echo '<td>' . $row['telephoneno'] . '</td>';
    echo '<td>' . $row['roomno'] . '</td>';
    echo '</tr>';
    $count++;
  }

  echo '</table>';
} else {
  echo 'No data available.';
}

// Close the database connection
mysqli_close($conn);
?>

  </div>

  <script>
    function validateForm() {
      var fname = document.getElementById("fname").value;
      var lname = document.getElementById("lname").value;
      var telephone = document.getElementById("telephone").value;
      var room = document.getElementById("room").value;
      var errorMessage = document.getElementById("error-message");

      if (fname === "" || lname === "" || telephone === "" || room === "") {
        errorMessage.textContent = "Please fill in all the fields.";
        return false;
      }

      errorMessage.textContent = "";
      return true;
    }
  </script>

</body>

</html>
