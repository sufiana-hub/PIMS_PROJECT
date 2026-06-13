<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>PIMS PBU</title>
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
    .disabled-link {
      pointer-events: none;
      cursor: not-allowed;
      opacity: 0.5;
    }

    .psa-heading {
      color: red;
      font-size: 15px;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .psa-text {
      color: red;
      font-size: 10px;
      margin-bottom: 10px;
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
          <li><a class="nav-link scrollto o" href="picture.php">Galleri Gambar PIMS</a></li>
          <li><a class="nav-link scrollto" href="infaq.php">Sumbangan</a></li>
          <li><a class="getstarted scrollto" a href="signup.php" id="signup-btn">Daftar Masuk</a></li>
          <li><a class="getstarted scrollto" a href="login.php" id="signup-btn">Log Masuk</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container" data-aos="zoom-out" data-aos-delay="100">
      <h1>INFAQ PUSAT <span>ISLAM PBU</span></h1>
      <h2>" Dan Allah akan sentiasa membantu hambanya selagi mana hamba tersebut membantu saudaranya "</h2>
      <h3>(Hadis Riwayat Muslim)</h3>
    </div>
  </section><!-- End Hero -->

  <main id="main">
    <section id="featured-services" class="featured-services" style="background-image: url('your-background-image.jpg'); background-size: cover; background-repeat: no-repeat; background-position: center;">
      <div class="container" data-aos="fade-up">
        <div class="row justify-content-center">
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <div class="icon"><i class="bx bxl-dribbble"></i></div>
              <h4 class="title">
                <a href="https://toyyibpay.com/INFAQ-RAMADHAN-PBU" id="cardLink1">INFAQ RAMADHAN</a>
              </h4>
              <p class="psa-heading">*Please enter your name and description before proceed to the link*</p>
              <form>
                <input type="text" class="form-control" placeholder="Enter name" id="name1" required>
                <input type="text" class="form-control" placeholder="Enter description" id="infaq1" required>
                <button type="button" class="btn btn-primary" onclick="submitForm('name1', 'infaq1', 'cardLink1', 'https://toyyibpay.com/INFAQ-RAMADHAN-PBU')">Submit</button>
              </form>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4 class="title">
                <a href="https://toyyibpay.com/PUSAT-ISLAM-PBU" id="cardLink2">INFAQ PBU</a>
              </h4>
              <p class="psa-heading">*Please enter your name and description before proceed to the link*</p>
              <form>
                <input type="text" class="form-control" placeholder="Enter name" id="name2" required>
                <input type="text" class="form-control" placeholder="Enter description" id="infaq2" required>
                <button type="button" class="btn btn-primary" onclick="submitForm('name2', 'infaq2', 'cardLink2', 'https://toyyibpay.com/PUSAT-ISLAM-PBU')">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- ...Rest of the code... -->

  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <script>
    function submitForm(nameField, descriptionField, linkId, linkUrl) {
      const name = document.getElementById(nameField).value;
      const description = document.getElementById(descriptionField).value;

      if (name.trim() === '' || description.trim() === '') {
        alert('Please fill in all the text fields.');
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
</body>

</html>
