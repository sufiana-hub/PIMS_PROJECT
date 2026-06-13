<?php
session_start(); // Session must be at the very top
date_default_timezone_set("Asia/Kuala_Lumpur");

$host = "lesbot-db-server.mysql.database.azure.com";
$username = "sufiana_admin";
$password = "Sufi123?!"; // Replace with your actual password
$db_name = "pims_db"; 

// Initialize variables to prevent "Undefined Variable" notices
$error = "";

// 1. Establish SECURE Azure Connection
$conn = mysqli_init();
mysqli_ssl_set($conn, NULL, NULL, NULL, NULL, NULL);
$success = mysqli_real_connect($conn, $host, $username, $password, $db_name, 3306, MYSQLI_CLIENT_SSL);

if (!$success) {
    die("Connection failed: " . mysqli_connect_error());
}

// 2. Helper Function
function sanitizeInput($conn, $input) {
    return mysqli_real_escape_string($conn, trim($input));
}

// 3. Handle Login Logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = sanitizeInput($conn, $_POST['email']);
    $password = sanitizeInput($conn, $_POST['password']);

    // Query to check if the user exists
    $query = "SELECT * FROM signup WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['fullname'] = $row['fullname'];
        $_SESSION['no_matric'] = $row['nomatric'];
        $_SESSION['no_ic'] = $row['noic'];
        $_SESSION['email'] = $email;
        
        header("Location: activity.php");
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Login | PIMS</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,600,700" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('assets/img/loginbackg/back3.jpg');
            background-size: cover; background-position: center;
            display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0;
        }
        .login-container {
            background-color: #1D2125; padding: 40px; border: 2px solid #007bff;
            border-radius: 12px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            text-align: center; max-width: 400px; width: 90%;
        }
        .login-container input {
            width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #333;
            margin-bottom: 20px; background-color: #fff; color: #000;
        }
        .login-button {
            background-color: #007bff; color: #fff; padding: 12px;
            border: none; border-radius: 8px; width: 100%; font-weight: 700; transition: 0.3s;
        }
        .login-button:hover { background-color: #0056b3; transform: translateY(-2px); }
        .error-message { color: #ff4d4d; font-size: 14px; margin-bottom: 15px; }
        .links { margin-top: 20px; font-size: 13px; color: #ccc; }
        .links a { color: #007bff; text-decoration: none; }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 class="fw-bold mb-4">PIMS LOGIN</h2>
        <form method="POST" action="login.php">
            <input type="email" name="email" required placeholder="Email Address">
            <input type="password" name="password" required placeholder="Password">
            
            <?php if ($error != "") { ?>
                <p class="error-message"><?php echo $error; ?></p>
            <?php } ?>

            <button type="submit" class="login-button">LOGIN</button>
        </form>
        <p class="links">
            <a href="forgotpass.php">Forgot Password?</a> | 
            <a href="signup.php">Create Account</a>
        </p>
    </div>
</body>
</html>