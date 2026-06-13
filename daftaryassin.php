<?php
session_start(); // Start session at the very top
date_default_timezone_set("Asia/Kuala_Lumpur");

// Database connection details
$host = "lesbot-db-server.mysql.database.azure.com";
$username = "sufiana_admin";
$password = "YOUR_DATABASE_PASSWORD"; // Ensure this is your actual password
$db_name = "pims_db"; 

// Initialize variables for HTML to prevent "Undefined variable" errors
$fullname = isset($_SESSION['fullname']) ? $_SESSION['fullname'] : "";
$no_matric = isset($_SESSION['no_matric']) ? $_SESSION['no_matric'] : "";
$no_ic = isset($_SESSION['no_ic']) ? $_SESSION['no_ic'] : "";
$email = isset($_SESSION['email']) ? $_SESSION['email'] : "";
$error = "";

// 1. Create the SECURE connection for Azure
$conn = mysqli_init();
mysqli_ssl_set($conn, NULL, NULL, NULL, NULL, NULL);
$success = mysqli_real_connect($conn, $host, $username, $password, $db_name, 3306, MYSQLI_CLIENT_SSL);

if (!$success) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to sanitize user inputs
function sanitizeInput($conn, $input) {
    return mysqli_real_escape_string($conn, trim($input));
}

// Check if the login form is submitted (if this page handles login logic)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $login_email = sanitizeInput($conn, $_POST['email']);
    $login_password = sanitizeInput($conn, $_POST['password']);

    $query = "SELECT * FROM signup WHERE email = '$login_email' AND password = '$login_password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['fullname'] = $row['fullname'];
        $_SESSION['no_matric'] = $row['nomatric'];
        $_SESSION['no_ic'] = $row['noic'];
        $_SESSION['email'] = $login_email;

        header("Location: activity.php");
        exit();
    } else {
        $error = "E-mel atau kata laluan tidak sah.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>PIMS - Daftar Yassin</title>
  
  <!-- Favicons -->
  <link href="assets/img/pimslogo.png" rel="icon">
  <link href="assets/img/pimslogo.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Poppins:300,400,500,600,700" rel="stylesheet">

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
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top shadow-sm bg-white">
    <div class="container d-flex align-items-center justify-content-between">
      <h1 class="logo"><a href="index.php">PIMS PBU</a></h1>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="index.php">Utama</a></li>
          <li><a class="nav-link scrollto" href="picture.php">Gallery</a></li>
          <li><a class="nav-link scrollto" href="infaq.php">Sumbangan</a></li>
          <li><a class="getstarted scrollto bg-danger" href="logout.php" id="logout-btn">Log Keluar</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
    </div>
  </header>

  <main id="main" style="margin-top: 100px;">
    <section id="services" class="services">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>MAKLUMAT PELAJAR</h2>
          <p>Sila pastikan maklumat anda betul sebelum pengesahan.</p>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-8 card p-4 shadow-sm">
            <div class="form-group row mb-3">
              <label class="col-sm-3 col-form-label"><b>NAMA :</b></label>
              <div class="col-sm-9">
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($fullname); ?>" readonly>
              </div>
            </div>

            <div class="form-group row mb-3">
              <label class="col-sm-3 col-form-label"><b>KAD MATRIK :</b></label>
              <div class="col-sm-9">
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($no_matric); ?>" readonly>
              </div>
            </div>

            <div class="form-group row mb-3">
              <label class="col-sm-3 col-form-label"><b>NO IC :</b></label>
              <div class="col-sm-9">
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($no_ic); ?>" readonly>
              </div>
            </div>

            <div class="form-group row mb-3">
              <label class="col-sm-3 col-form-label"><b>E-MEL :</b></label>
              <div class="col-sm-9">
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($email); ?>" readonly>
              </div>
            </div>
            
            <div class="text-center mt-4">
               <button class="btn btn-primary px-5 rounded-pill" onclick="alert('Pendaftaran Yassin Berjaya Disahkan!')">Sahkan Kehadiran</button>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer id="footer" class="mt-5">
    <div class="container py-4 text-center">
      <div class="credits">
        Designed by <a href="https://pbu.mypolycc.edu.my/">YESTIMES DIGITAL</a>
      </div>
    </div>
  </footer>

  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/main.js"></script>

  <script>
    document.getElementById("logout-btn").addEventListener("click", function(event) {
      if (!confirm('Adakah anda pasti untuk log keluar?')) {
        event.preventDefault();
      }
    });
  </script>

</body>
</html>