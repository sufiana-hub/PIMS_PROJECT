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
                    <div class="col-lg-6 col-md-6">
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

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">

      <div class="section-title">
      <h2>MENU</h2>
      <p></p>
     </div>

        <div class="section-title">
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box iconbox-blue">
              <div class="icon">
                <img src="assets\img\background\illustrationact.jpg" alt="Aktiviti Image" width="100" height="100">
              </div>
              <h4><a href="daftaraktiviti.php">AKTIVITI</a></h4>
              <p>" NASHAT || SENARAI AKTIVITI - AKTIVITI TERKINI "</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box iconbox-orange">
              <div class="icon">
                <img src="assets\img\background\illustrationpraytimes.png" alt="Waktu Solat Image" width="100" height="100">
              </div>
              <h4><a href="waktusolat.php">WAKTU SOLAT</a></h4>
              <p>" WAQT ALSALA || WAKTU SOLAT BERIKUTNYA "</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box iconbox-pink">
              <div class="icon">
                <img src="assets\img\background\illustrationramdhan.jpg" alt="Ramadhan Image" width="100" height="100">
              </div>
              <h4><a href="ramadhan.php">RAMADHAN</a></h4>
              <p>" RAMADAN KAREEM || BOOK YOUR SLOT NOW!! "</p>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Sevices Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>HUBUNGI KAMI</h2>
          <p>Politeknik Balik Pulau, Pinang Nirai, Mukim 6, 11000 Balik Pulau, Penang.</p>
        </div>

        <div>
          <iframe style="border:0; width: 100%; height: 270px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.477722746372!2d100.21336431476502!3d5.343803996123675!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x304aeafdf3434a0d%3A0x6b7411546a715459!2sPoliteknik%20Balik%20Pulau!5e0!3m2!1sen!2smy!4v1687284727638!5m2!1sen!2smy" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <div class="row mt-5">

          <div class="col-lg-4">
            <div class="info">
              <div class="address">
                <a href="https://www.google.com/maps/place/Politeknik+Balik+Pulau" target="_blank"><i class="bi bi-geo-alt"></i></a>
                <h4>Location:</h4>
                <p>Politeknik Balik Pulau, Pinang Nirai, Mukim 6, 11000 Balik Pulau, Penang.</p>
              </div>

              <div class="email">
                <a href="mailto:polibalikpulau@pbu.edu.my"><i class="bi bi-envelope"></i></a>
                <h4>Email:</h4>
                <p><a href="mailto:polibalikpulau@pbu.edu.my">polibalikpulau@pbu.edu.my</a></p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Fax Number:</h4>
                <p>04-869 2061</p>
                <h4>Telephone Number:</h4>
                <p>04-868 9000</p>
              </div>
            </div>
          </div>

          <div class="col-lg-8 mt-5 mt-lg-0">
            <form action="contact.php" method="post" role="form" class="php-email-form" id="contactForm">
              <div class="row gy-2 gx-md-3">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                </div>
                <div class="col-md-6 form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                </div>
                <div class="form-group col-12">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                </div>
                <div class="form-group col-12">
                  <textarea class="form-control" name="message" rows="5" placeholder="Feedback" required></textarea>
                </div>
                <div class="my-3 col-12">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>
                </div>
                <div class="text-center col-12"><button type="submit">Send Message</button></div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- End Contact Section -->

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
