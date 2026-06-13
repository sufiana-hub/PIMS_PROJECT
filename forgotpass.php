<?php
require_once('db_connect.php');

$errorMessage = ""; 
$successMessage = "";

if (isset($_POST['reset_password'])) {
    $email = sanitizeInput($conn, $_POST['email']);
    $newPassword = sanitizeInput($conn, $_POST['newPassword']);
    // FIX: Define the missing variable from POST
    $confirmPassword = sanitizeInput($conn, $_POST['confirmPassword']);

    // Check if the new password and confirm password match
    if ($newPassword === $confirmPassword) {
        
        // Security check: Check if email exists before updating
        $checkEmail = "SELECT * FROM signup WHERE email = '$email'";
        $result = $conn->query($checkEmail);

        if ($result->num_rows > 0) {
            // Update the user's password in the database
            $sql = "UPDATE signup SET password = '$newPassword', confirm_password = '$confirmPassword' WHERE email = '$email'";

            if ($conn->query($sql) === TRUE) {
                $successMessage = "Your password has been updated successfully.";
                // In a real project, redirect after a few seconds or show a link
                header("Refresh: 2; URL=login.php");
            } else {
                $errorMessage = "Error updating password: " . $conn->error;
            }
        } else {
            $errorMessage = "Email address not found in our system.";
        }
    } else {
        $errorMessage = "New password and confirm password do not match.";
    }
}
// Note: $conn->close() is fine here, but since we use require_once, 
// usually we let the script end naturally.
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Semula Kata Laluan | PIMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            color: #ffffff;
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('assets/img/loginbackg/back3.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .forgot-password-container {
            background-color: #121212; /* High contrast dark */
            padding: 40px;
            border: 1px solid #3b82f6; /* Modern Blue Border */
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            text-align: center;
            max-width: 400px;
            width: 90%;
        }

        h2 { font-weight: 800; margin-bottom: 20px; letter-spacing: -1px; }

        .forgot-password-container label {
            text-align: left;
            display: block;
            margin-bottom: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            color: #9ca3af;
        }

        .forgot-password-container input {
            width: 100%;
            padding: 14px;
            border: 1px solid #333;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 16px;
            background-color: #ffffff; /* White background for inputs */
            color: #000000; /* Black text for readability */
            box-sizing: border-box;
        }

        .btn-primary {
            background-color: #3b82f6;
            color: #ffffff;
            padding: 14px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 700;
            width: 100%;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background-color: #2563eb;
            transform: translateY(-2px);
        }

        .error-message { color: #ef4444; font-size: 0.85rem; margin-top: 10px; font-weight: 600; }
        .success-message { color: #10b981; font-size: 0.85rem; margin-top: 10px; font-weight: 600; }
        
        .back-link { display: block; margin-top: 20px; color: #9ca3af; text-decoration: none; font-size: 0.8rem; }
        .back-link:hover { color: #3b82f6; }
    </style>
</head>
<body>
    <div class="forgot-password-container">
        <h2>Reset Password</h2>
        <form method="POST">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required placeholder="Enter registered email">

            <label for="newPassword">New Password</label>
            <input type="password" id="newPassword" name="newPassword" required placeholder="••••••••">

            <label for="confirmPassword">Confirm Password</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required placeholder="••••••••">

            <button type="submit" name="reset_password" class="btn-primary">UPDATE PASSWORD</button>
            
            <?php if ($errorMessage != "") { ?>
                <p class="error-message"><?php echo $errorMessage; ?></p>
            <?php } ?>
            <?php if ($successMessage != "") { ?>
                <p class="success-message"><?php echo $successMessage; ?></p>
            <?php } ?>

            <a href="login.php" class="back-link">← Back to Login</a>
        </form>
    </div>
</body>
</html>