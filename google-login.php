<?php
require_once 'vendor/autoload.php'; // Include Google SDK

session_start(); // Start the session to track the user's login status

$client = new Google_Client(); // Create a new Google client
$client->setClientId('181313285960-ekskeegkooorgpi5i2js67d0tsfk5dcs.apps.googleusercontent.com'); // Set the client ID
$client->setClientSecret('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'); // Set the client secret
$client->setRedirectUri('http://localhost/ipt101/google-callback.php'); // Set the redirect URI
$client->addScope('email'); // Add the 'email' scope for access to the user's email
$client->addScope('profile'); // Add the 'profile' scope for access to the user's profile information

$authUrl = $client->createAuthUrl(); // Generate the authorization URL
header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL)); // Redirect the user to the authorization URL
exit(); // Exit the script
?>
