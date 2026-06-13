<?php
// Database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "pims_pbu";

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables for the messages
$errorMessage = "";
$successMessage = "";

// Check if the form is submitted
if (isset($_POST['reset_password'])) {
    $email = $_POST['email'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if the new password and confirm password match
    if ($newPassword === $confirmPassword) {
        // Update the user's password in the database
        $sql = "UPDATE signup SET password = '$newPassword', confirm_password = '$confirmPassword' WHERE email = '$email'";

        if ($conn->query($sql) === TRUE) {
            // Password updated successfully
            $successMessage = "Your password has been updated successfully.";

            // Redirect to login page
            header("Location: login.php");
            exit();
        } else {
            $errorMessage = "Error updating password: " . $conn->error;
        }
    } else {
        // New password and confirm password do not match
        $errorMessage = "New password and confirm password do not match.";
    }
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            font-weight: 300;
            line-height: 1.7;
            color: #ffffff;
            background-image: url('assets/img/loginbackg/back3.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .forgot-password-container {
            background-color: #1D2125;
            padding: 40px;
            border: 2px solid #007bff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        .forgot-password-container input[type="email"],
        .forgot-password-container input[type="password"] {
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

         .forgot-password-container label {
            text-align: left;
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #ffffff;
        }

        .forgot-password-container .btn-primary {
            background-color: #007bff;
            color: #ffffff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
            width: 100%;
            text-transform: uppercase;
        }

        .forgot-password-container .btn-primary:hover {
            background-color: #0056b3;
        }
        }

        .forgot-password-container .error-message {
            color: red;
            margin-top: 5px;
            font-size: 14px;
        }

        .forgot-password-container .success-message {
            color: green;
            margin-top: 5px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="forgot-password-container">
        <h2>Forgot Password</h2>
        <form method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required placeholder="Enter your email" style="color: #000;">
            </div>
            <div class="form-group">
                <label for="newPassword">New Password:</label>
                <input type="password" id="newPassword" name="newPassword" required placeholder="Enter your new password" style="color: #000;">
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required placeholder="Confirm your new password" style="color: #000;">
            </div>
            <div class="form-group">
                <button type="submit" name="reset_password" class="btn btn-primary">SUBMIT</button>
            </div>
            <?php if (isset($errorMessage)) { ?>
                <p class="error-message"><?php echo $errorMessage; ?></p>
            <?php } ?>
            <?php if (isset($successMessage)) { ?>
                <p class="success-message"><?php echo $successMessage; ?></p>
            <?php } ?>
        </form>
    </div>
</body>
</html>