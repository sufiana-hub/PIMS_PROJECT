<?php
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

$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to sanitize user inputs and prevent SQL injection
function sanitizeInput($conn, $input) {
    $input = trim($input);
    $input = mysqli_real_escape_string($conn, $input);
    return $input;
}

// ... (previous code)

// ... (previous code)

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
?>

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

    <title>Login</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            font-weight: 300;
            line-height: 1.7;
            color: #fff;
            background-image: url('assets/img/loginbackg/back3.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #1D2125;
            padding: 40px;
            border: 2px solid #007bff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        .login-container h2 {
            margin-bottom: 30px;
            color: #ffffff;
            font-size: 32px;
        }

        .login-container label {
            display: block;
            margin-bottom: 12px;
            text-align: left;
            color: #ffffff;
            font-size: 16px;
        }

        .login-container input[type="email"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 16px;
            background-color: #1D2125;
            color: #ffffff;
            box-sizing: border-box;
        }

        .login-container input[type="email"]::placeholder,
        .login-container input[type="password"]::placeholder {
            color: #888888;
        }

        .login-container input[type="checkbox"] {
            margin-right: 5px;
            display: inline-block;
            vertical-align: middle;
        }

        .login-container label[for="remember"] {
            color: #007bff;
            display: inline-block;
            vertical-align: middle;
            margin-bottom: 0;
        }

        .login-container p.error-message {
            color: red;
            margin-top: 5px;
        }

        .login-container a {
            text-decoration: none;
            color: #007bff;
            transition: color 0.3s;
        }

        .login-container a:hover {
            color: #0056b3;
        }

        .login-container .login-button {
            background-color: #007bff;
            color: #ffffff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
            width: 100%;
        }

        .login-container .login-button:hover {
            background-color: #0056b3;
        }

        .login-container p.links {
            margin-top: 20px;
            font-size: 14px;
            color: #ccc;
        }

        .login-container p.links a {
            margin: 0 5px;
            color: #007bff;
        }

        .login-container p.links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <!-- Your existing form elements here -->
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" required placeholder="Enter your email">
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" name="password" required placeholder="Enter your password">
            </div>
            <div>
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember Me</label>
            </div>
            <div>
                <input type="submit" class="login-button" value="Login">
            </div>
            <?php if (isset($error)) { ?>
                <p class="error-message"><?php echo $error; ?></p>
            <?php } ?>
        </form>
        <p class="links">
            <a href="forgotpass.php">Forgot Password?</a> | 
            <a href="signup.php">Don't have an account? Sign up</a>
        </p>
    </div>
</body>
</html>
