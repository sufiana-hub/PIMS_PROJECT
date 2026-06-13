<!DOCTYPE html>
<html>
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
  <title>Waktu Solat</title>
  <style>
    /* CSS Styling */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-image: url('assets/img/background mosque.jpg'); /* Replace 'path/to/your/image.jpg' with the actual path to your image */
      background-repeat: no-repeat;
      background-size: cover;
    }

    .container {
      max-width: 900px;
      margin: 100px auto;
      padding: 40px;
      background-color: rgba(255, 255, 255, 0.8);
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    h1 {
      color: #2c3e50;
      text-align: center;
      font-size: 32px;
    }

    ul.menu {
      list-style: none;
      padding: 0;
      margin: 0;
      margin-top: 30px;
      text-align: center;
    }

    ul.menu li {
      display: inline-block;
      margin-right: 15px;
    }

    ul.menu li a {
      text-decoration: none;
      padding: 15px 30px;
      background-color: #2980b9;
      color: #fff;
      border-radius: 8px;
      font-size: 18px;
    }

    ul.menu li a:hover {
      background-color: #1b6ca8;
    }

    .home-button {
      display: inline-block;
      padding: 15px 30px;
      background-color: black;
      color: white;
      border-radius: 8px;
      text-decoration: none;
      font-size: 18px;
    }

    .home-button:hover {
      background-color: #333;
    }

    ul.prayer-times {
      list-style: none;
      padding: 0;
      margin: 0;
      margin-top: 30px;
      text-align: center;
      color: #2c3e50;
    }

    ul.prayer-times li {
      margin-bottom: 20px;
    }

    .time-label {
      display: inline-block;
      width: 150px;
      font-weight: bold;
    }
    
    iframe {
      width: 100%;
      height: 600px;
      border: none;
    }
  </style>
</head>
<body>

  <div class="container">
    <div style="text-align: center;">
      <a href="index.php" class="home-button">UTAMA</a>
    </div>

    <ul class="menu">
      <li><a href="waktusolat.php">Waktu Solat</a></li>
      <li><a href="doa.php">Doa</a></li>
      <li><a href="niat.php">Niat Solat</a></li>
      <li><a href="quran.php">Quran</a></li>
    </ul>

    <div>
      <br><br>
      <div><h1>HIMPUNAN DOA-DOA HARIAN</h1></div>
      <iframe src="https://www.waktusolat.digital/doa" allowfullscreen></iframe>
    </div>
  </div>

</body>
</html>
