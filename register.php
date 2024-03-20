<?php
session_start(); // Start session management
include "db_conn.php"; // Include database connection

// Import necessary PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPmailer/src/Exception.php';
require 'PHPmailer/src/PHPMailer.php';
require 'PHPmailer/src/SMTP.php';

// Create a new instance of PHPMailer
$mail = new PHPMailer(true);

// Retrieve form data
$firstname = $_POST['Firstname'];
$middlename = isset($_POST['Middlename']) ? $_POST['Middlename'] : '';
$lastname = $_POST['Lastname'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$status = $_POST['status'];
$verification_code = bin2hex(random_bytes(16)); // Generate verification code

// Function to validate password format
function validatePassword($password) {
    if (!preg_match('/^(?=.*[A-Za-z])(?=.*[\d@#$*])[A-Za-z\d@#$*]+$/', $password)) {
        return false;
    }
    return true;
}

// Function to validate names containing only letters
function validateLetters($input) {
    if ($input == 'Firstname' || $input == 'Middlename') {
        return true;
    }
    return preg_match('/^[A-Za-z ]+$/', $input);
}

// Function to validate email format
function validateEmail($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    return true;
}

// Check if required fields are empty
if(empty($username) || empty($email) || empty($password) || empty($status)) {
    header("Location: registrationform.php?error=Please fill in all fields"); // Redirect with error message
    exit();
} else if($password !== $confirm_password) { // Check if passwords match
    header("Location: registrationform.php?error=Passwords do not match"); // Redirect with error message
    exit();
} else {
    // Check if username or email already exists
    $sql = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
       header("Location: registrationform.php?error=Username or Email already exists"); // Redirect with error message
        exit();
    }

    // Validate names
    if (!validateLetters($lastname)) {
        header("Location: registrationform.php?error=Last name should contain only letters"); // Redirect with error message
        exit();
    }

    if (!validateLetters($firstname)) {
        header("Location: registrationform.php?error=First name should contain only letters"); // Redirect with error message
        exit();
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into database
    $sql = "INSERT INTO users (Firstname, Middlename, Lastname, username, email, password, verification_code, status) 
            VALUES ('$firstname', '$middlename', '$lastname', '$username', '$email', '$hashed_password', '$verification_code', '$status')";

    if(mysqli_query($conn, $sql)){
            
        // Configure PHPMailer to send email
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  
        $mail->SMTPAuth = true;
        $mail->Username = 'kimandriemancera@gmail.com';  
        $mail->Password = 'oaydmfuyxcujdbau';  
        $mail->SMTPSecure = 'tls';          
        $mail->Port = 587;                  

        $mail->setFrom('kimandriemancera@gmail.com');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Email Verification';
        $mail->Body ='Please click the "verify" link to verify your email: <a href="http://localhost/ipt101/verified.php?email='.$email.'&code='.$verification_code.'">Verify</a>';
        
        try {
            $mail->send();
            header("Location: sent_notice.php?message=Verification email sent. Please check your email to verify your account."); // Redirect with success message
        } catch (Exception $e) {
            header("Location: registrationform.php?error=Failed to send verification email. Please try again later."); // Redirect with error message
        }
    } else {
        echo "ERROR: Hush! Sorry $sql. " . mysqli_error($conn); // Display error if SQL query fails
    }
}

mysqli_close($conn); // Close database connection
?>
