<?php
require_once 'vendor/autoload.php'; // Include Google SDK

session_start(); // Start the session to track the user's login status
include "db_conn.php"; // Include the file that contains the database connection

$client = new Google_Client(); // Create a new Google client
$client->setClientId('181313285960-ekskeegkooorgpi5i2js67d0tsfk5dcs.apps.googleusercontent.com'); // Set the client ID
$client->setClientSecret('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'); // Set the client secret
$client->setRedirectUri('http://localhost/ipt101/google-callback.php'); // Set the redirect URI

if (isset($_GET['code'])) { // Check if the authorization code is set
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']); // Exchange authorization code for access token

    if (array_key_exists('access_token', $token)) { // Check if access token exists in the token array
        $client->setAccessToken($token['access_token']); // Set the access token in the client

        $oauth2 = new Google_Service_Oauth2($client); // Create a new Google OAuth2 service
        $userInfo = $oauth2->userinfo->get(); // Get the user's information

        $email = $userInfo->email; // Get the user's email
        $name = $userInfo->name; // Get the user's name

        // Check if user already exists in database
        $sql = "SELECT * FROM user WHERE Email='$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) { // If user exists, retrieve user data
            $row = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $row['username']; // Set username in session
            $_SESSION['name'] = $row['First_name']; // Set user's first name in session
            $_SESSION['user_id'] = $row['user_id']; // Set user ID in session

            // Update verified status and Active status to 'Online'
            $update_sql = "UPDATE user SET verified = 1, Active = 'Online' WHERE user_id = ?";
            $update_stmt = mysqli_prepare($conn, $update_sql);
            mysqli_stmt_bind_param($update_stmt, "i", $row['user_id']);
            mysqli_stmt_execute($update_stmt);
        } else { // If user doesn't exist, register the new user
            $username = strtolower(str_replace(' ', '_', $name)); // Generate username
            $insert_sql = "INSERT INTO user (First_name, Lastname, username, Email, password, Status, verified, Active) 
                VALUES ('$name', '', '$username', '$email', '', '', 1, 'Online')";
            if (mysqli_query($conn, $insert_sql)) {
                $user_id = mysqli_insert_id($conn);
                $_SESSION['username'] = $username; // Set username in session
                $_SESSION['name'] = $name; // Set user's name in session
                $_SESSION['user_id'] = $user_id; // Set user ID in session

                // Insert user profile data into the user_profile table
                $profile_sql = "INSERT INTO user_profile (user_id, full_name) VALUES ('$user_id', '$name')";
                if (mysqli_query($conn, $profile_sql)) {
                    // Insert an empty password into user_password_history table
                    $history_sql = "INSERT INTO user_password_history (user_id, password) VALUES ('$user_id', '')";
                    if (mysqli_query($conn, $history_sql)) {
                        echo "User, profile, and password history inserted successfully.";
                    } else {
                        echo "Error inserting into password history: " . mysqli_error($conn);
                    }
                } else {
                    echo "Error inserting profile: " . mysqli_error($conn);
                }
            } else {
                echo "Error: " . mysqli_error($conn);
                exit();
            }
        }

        header('Location: dashboard.php'); // Redirect to the dashboard page
        exit();
    } else {
        header('Location: loginform.php?error=Failed to retrieve access token'); // Redirect to login page with error message
        exit();
    }
} else {
    header('Location: loginform.php?error=Google login failed'); // Redirect to login page with error message
    exit();
}
?>
