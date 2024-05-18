<?php
// Include the database connection file
include "db_conn.php";

// Start session
session_start();
// Retrieve user information from the "user" table
$username_session = $_SESSION['username'];

$sql_user = "SELECT user_id, username, password, Lastname, Firstname, Middlename, email FROM user WHERE username = '$username_session'";
$result_user = mysqli_query($conn, $sql_user);

if ($result_user && mysqli_num_rows($result_user) > 0) {
    $row_user = mysqli_fetch_assoc($result_user);
    $user_id = $row_user['id'];


    // Retrieve user inputs from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Regular expressions for validation
    function validateUsername($input)
    {
        return preg_match('/^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]+$/', $input);
    }

    // Function to validate if a password contains at least one letter and one digit or one of the specified symbols
    function validatePassword($password)
    {
        return preg_match('/^(?=.*[A-Za-z])(?=.*[\d@#$*])[A-Za-z\d@#$*]+$/', $password);
    }

    $errors = array();

    // Validate inputs
    if (empty($password) || strlen($password) < 6 || !validatePassword($password)) {
        $errors[] = "Password must be at least 6 characters long and contain at least one letter, one digit, and a symbol";
    }

    if (empty($username) || !validateUsername($username)) {
        $errors[] = "Username should contain both letters and numbers, but not all numbers";
    }
    echo $user_id;
    echo $username;
    echo $password;

    // // Handle errors
    if (!empty($errors)) {
        $error_message = implode(", ", $errors);
        $_SESSION['user_pass_error'] = $error_message; // Store error message in session variable
        header("Location: dashboard.php"); // Redirect back to edit_user_pass.php
        exit();
    }
    $sql = "UPDATE user SET 
            
             username = '$username',
             password = '$password'

             WHERE user_id = $user_id";

    // Execute the SQL query
    if (mysqli_query($conn, $sql)) {
        $_SESSION['username']= $username;
        // Redirect to a success page if registration is successful
        header("Location: dashboard.php?success=Your username and password has been updated successfully");
    } else {
        // Redirect to an error page if there's an issue with the SQL query
        $error_message = mysqli_error($conn); // Get the MySQL error message
        $error_message = urlencode("Your username and password could not be updated: $error_message");
        header("Location: dashboard.php?error=$error_message");
        exit();
    }
}
?>