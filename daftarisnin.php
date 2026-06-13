<?php
// Database connection
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

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize user inputs and prevent SQL injection
function sanitizeInput($conn, $input) {
    $input = trim($input);
    $input = mysqli_real_escape_string($conn, $input);
    return $input;
}

// Check if the login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the email and password entered by the user
    $email = sanitizeInput($conn, $_POST['email']);
    $password = sanitizeInput($conn, $_POST['password']);

    // Query to check if the email and password exist in the database
    $query = "SELECT * FROM signup WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Successful login
        $row = mysqli_fetch_assoc($result);
        $fullname = $row['fullname'];
        $no_matric = $row['nomatric'];
        $no_ic = $row['noic'];

        // Start PHP session and store user data
        session_start();
        $_SESSION['fullname'] = $fullname;
        $_SESSION['no_matric'] = $no_matric;
        $_SESSION['no_ic'] = $no_ic;
        $_SESSION['email'] = $email;

        // Redirect to activity.php page
        header("Location: activity.php");
        exit();
    } else {
        // Invalid email or password
        $error = "Invalid email or password.";
    }
}

// Check if the user is logged in and retrieve stored data from session
session_start();
$fullname = isset($_SESSION['fullname']) ? $_SESSION['fullname'] : "";
$no_matric = isset($_SESSION['no_matric']) ? $_SESSION['no_matric'] : "";
$no_ic = isset($_SESSION['no_ic']) ? $_SESSION['no_ic'] : "";
$email = isset($_SESSION['email']) ? $_SESSION['email'] : "";
?>


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
</head>

<body>
      <main id="main">
        <!-- ======= Services Section ======= -->
        <section id="services" class="services">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>MAKLUMAT PELAJAR</h2>
                </div>

                <div class="row">
                    <div class="col-lg-9 col-md-9">
<div class="form-group row">
    <label for="name" class="col-sm-3 col-form-label"><b>NAMA :</b></label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $fullname; ?>" readonly>
    </div>
</div>

<div class="form-group row">
    <label for="matric" class="col-sm-3 col-form-label"><b>KAD MATRIK :</b></label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="matric" name="matric" value="<?php echo $no_matric; ?>" readonly>
    </div>
</div>

<div class="form-group row">
    <label for="no_ic" class="col-sm-3 col-form-label"><b>NO IC :</b></label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="no_ic" name="no_ic" value="<?php echo $no_ic; ?>" readonly>
    </div>
</div>

<div class="form-group row">
    <label for="email" class="col-sm-3 col-form-label"><b>E-MEL :</b></label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>" readonly>
    </div>
</div>
                    </div>
                </div>

            </div>
        </section><!-- End Services Section -->

    </main>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="index.php"> PIMS PBU <img src="assets\img\pimslogo.png" alt="" class="img-fluid"></a></h1>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="index.php">Utama</a></li>
          <li><a class="nav-link scrollto o" href="picture.php">Gallery Gambar PIMS</a></li>
          <li><a class="nav-link scrollto" href="infaq.php">Sumbangan</a></li>
          <li><a class="nav-link scrollto" href="#contact">Hubungi Kami</a></li>
          <li><a class="getstarted scrollto" a href="logout.php" id="logout-btn">Log Keluar</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->


  <main id="main">
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="credits">
          Designed by <a href="https://pbu.mypolycc.edu.my/">YESTIMES DIGITAL</a>
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="https://www.facebook.com/groups/pbu21/?ref=share&mibextid=NSMW" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="https://instagram.com/politeknikbalikpulau?igshid=MTI1ZDU5ODQ3Yw==" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="https://www.linkedin.com/school/pbu21/" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <script>
    // Add event listeners to the "Log Keluar" button
    document.getElementById("logout-btn").addEventListener("click", function(event) {
      event.preventDefault();

      if (confirm('Adakah anda pasti?')) {
        // Perform any necessary logout operations here
        window.location.href = 'index.php';
      }
    });

    // Add event listener to the contact form submission
    const form = document.getElementById('contactForm');
    form.addEventListener('submit', function(event) {
      event.preventDefault();

      const name = document.getElementById('name').value;
      const email = document.getElementById('email').value;
      const subject = document.getElementById('subject').value;
      const message = document.getElementById('message').value;

      // You can perform additional form validation here before sending the data

      // Create a FormData object and append the form data
      const formData = new FormData();
      formData.append('name', name);
      formData.append('email', email);
      formData.append('subject', subject);
      formData.append('message', message);

      // Send the form data to the server using fetch
      fetch('contact.php', {
          method: 'POST',
          body: formData
        })
        .then(response => {
          if (response.ok) {
            form.reset();
            alert('Your message has been sent successfully. Thank you!');
          } else {
            throw new Error('An error occurred while sending your message. Please try again.');
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert(error.message);
        });
    });
  </script>

</body>

</html>
