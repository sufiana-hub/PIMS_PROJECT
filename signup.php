<?php
// 1. Connection Details
$host = "lesbot-db-server.mysql.database.azure.com";
$db   = "pims_db";
$user = "sufiana_admin";
$pass = "NO"; // IMPORTANT: Change this to your actual password!

// 2. Path to the SSL certificate
$ssl_cert = __DIR__ . "/DigiCertGlobalRootG2.crt.pem";

$options = [
    PDO::MYSQL_ATTR_SSL_CA => $ssl_cert,
    PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];

try {
    // This creates the $pdo connection
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass, $options);
} catch (PDOException $e) {
    die("Database Connection failed: " . $e->getMessage());
}

// --- REMOVED THE DUPLICATE BROKEN PDO LINE FROM HERE ---

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['signup'])) {
        $fullname = $_POST['fullname'];
        $no_matric = $_POST['no_matric'];
        $no_ic = $_POST['no_ic'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if ($password !== $confirm_password) {
            echo "<script>alert('Password and Confirm Password do not match. Please try again.');</script>";
        } else {
            try {
                $stmt = $pdo->prepare("INSERT INTO signup (fullname, nomatric, noic, email, password, confirm_password) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->execute([$fullname, $no_matric, $no_ic, $email, $password, $confirm_password]);
                header("Location: login.php");
                exit();
            } catch (PDOException $e) {
                echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
            }
        }
    }
}
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

    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800,900');

    body {
        font-family: 'Poppins', sans-serif;
        font-weight: 300;
        line-height: 1.7;
        color: #fff;
        background-image: url('assets/img/loginbackg/back3.jpg');
        background-size: cover; /* Add this line */
        background-repeat: no-repeat; /* Add this line */
        background-position: center; /* Add this line */
    }

        a:hover {
            text-decoration: none;
        }

        .link {
            color: #3c91ca;
        }

        .link:hover {
            color: #c4c3ca;
        }

        p {
            font-weight: 500;
            font-size: 14px;
        }

        h4 {
            font-weight: 600;
        }

        h6 span {
            padding: 0 20px;
            font-weight: 700;
        }

        .section {
            position: relative;
            width: 100%;
            display: block;
        }

        .full-height {
            min-height: 100vh;
        }

        [type="checkbox"]:checked,
        [type="checkbox"]:not(:checked) {
            display: none;
        }

        .checkbox:checked+label,
        .checkbox:not(:checked)+label {
            position: relative;
            display: block;
            text-align: center;
            width: 60px;
            height: 16px;
            border-radius: 8px;
            padding: 0;
            margin: 10px auto;
            cursor: pointer;
            background-color: #2853a0;
        }

        .checkbox:checked+label:before,
        .checkbox:not(:checked)+label:before {
            position: absolute;
            display: block;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            color: #2853a0;
            background-color: #fff;
            font-family: 'unicons';
            content: '\eb4f';
            z-index: 20;
            top: -10px;
            left: -10px;
            line-height: 36px;
            text-align: center;
            font-size: 24px;
            transition: all 0.5s ease;
        }

        .checkbox:checked+label:before {
            transform: translateX(44px) rotate(-270deg);
        }

        .card-3d-wrap {
            position: relative;
            width: 500px;
            max-width: 100%;
            height: 600px;
            transform-style: preserve-3d;
            perspective: 800px;
            margin-top: 60px;
        }

        .card-3d-wrapper {
            width: 100%;
            height: 100%;
            position: absolute;
            transform-style: preserve-3d;
            transition: all 600ms ease-out;
        }

        .card-front,
        .card-back {
            width: 100%;
            height: 100%;
            background-color: #fff;
            position: absolute;
            border-radius: 6px;
            transform-style: preserve-3d;
        }

        .card-back {
            transform: rotateY(180deg);
        }

        .checkbox:checked~.card-3d-wrap .card-3d-wrapper {
            transform: rotateY(180deg);
        }

        .center-wrap {
            position: absolute;
            width: 100%;
            padding: 0 35px;
            top: 50%;
            left: 0;
            transform: translate3d(0, -50%, 35px) perspective(100px);
        }

        /* Custom Sign Up Button Style */
        .btn-signup {
            background-color: #2853a0;
            border-color: #2853a0;
            color: #fff;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            transition: all 0.2s ease-in-out;
        }

        .btn-signup:hover {
            background-color: #1e416d;
            border-color: #1e416d;
        }

        .btn-signup:focus,
        .btn-signup.focus {
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(40, 83, 160, 0.5);
        }

        /* Custom Sign Up Button Style */
        .btn-home {
            background-color: #2853a0;
            border-color: #2853a0;
            color: #fff;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            transition: all 0.2s ease-in-out;
        }

        .btn-home:hover {
            background-color: #1e416d;
            border-color: #1e416d;
        }

        .btn-home:focus,
        .btn-home.focus {
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(40, 83, 160, 0.5);
        }

    </style>
</head>

<body>

      <!-- Favicons -->
  <link href="assets\img\pimslogo.png" rel="icon">
  <link href="assets\img\pimslogo.png" rel="apple-touch-icon">

    <div class="section">
        <div class="container">
            <div class="row full-height justify-content-center">
                <div class="col-12 text-center align-self-center py-5">
                    <div class="section pb-5 pt-5 pt-sm-2 text-center">
                        <h6 class="mb-0 pb-3"><span></span><span>Sign Up</span></h6>
                        <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
                        <label for="reg-log"></label>
                        <div class="card-3d-wrap mx-auto">
                            <div class="card-3d-wrapper">
                                <div class="card-front">
                                    <div class="center-wrap">
                                        <div class="section text-center">
                                            <form method="post" a href="login.php">
                                                <div class="form-group">
                                                    <input type="text" name="fullname" class="form-style"
                                                        placeholder="Your Full Name" required>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="text" name="no_matric" class="form-style"
                                                        placeholder="No Matric" required>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="text" name="no_ic" class="form-style"
                                                        placeholder="No IC" required>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="email" name="email" class="form-style"
                                                        placeholder="Your Email" required>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="password" name="password" class="form-style"
                                                        placeholder="Your Password" required>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="password" name="confirm_password" class="form-style"
                                                        placeholder="Confirm Password" required>
                                                </div>
                                                <button type="submit" name="signup" class="btn btn-signup mt-2" a href="login.php">Sign Up</button>
                                                <a href="index.php" class="btn btn-home mt-2">Utama</a>
                                                <p class="link mt-3"><a href="index.php">Privacy Policy</a> | <a href="index.php">Terms of Use</a></p>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>
