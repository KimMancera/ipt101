<?php
require_once 'vendor/autoload.php'; // Include the Facebook PHP SDK
session_start(); // Start the session to track the user's login status
include "db_conn.php"; // Include the file that contains the database connection

// Initialize the Facebook SDK with your app credentials
$fb = new \Facebook\Facebook([
  'app_id' => '482681487608549',
  'app_secret' => 'edcb79b62c717f7f5a31866f64a9f311',
  'default_graph_version' => 'v12.0',
]);

$helper = $fb->getRedirectLoginHelper(); // Get the login helper

try {
  $accessToken = $helper->getAccessToken(); // Get the access token from the helper
  if (isset($accessToken)) { // Check if access token is set
    $response = $fb->get('/me?fields=id,name,email', $accessToken); // Get user's data from Facebook
    $user = $response->getGraphUser(); // Get the user object
    $email = $user['email']; // Get the user's email
    $name = $user['name']; // Get the user's name

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
} catch(\Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage(); // Handle Facebook SDK errors
  exit;
} catch(\Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage(); // Handle Facebook SDK errors
  exit;
}
?>
