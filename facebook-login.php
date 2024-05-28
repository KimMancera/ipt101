<?php
require_once 'vendor/autoload.php'; // Include Facebook SDK

session_start(); // Start the session to track the user's login status

$fb = new \Facebook\Facebook([
  'app_id' => '482681487608549',
  'app_secret' => 'edcb79b62c717f7f5a31866f64a9f311',
  'default_graph_version' => 'v12.0',
]);

$helper = $fb->getRedirectLoginHelper(); // Get the login helper
$permissions = ['email']; // Optional permissions

try {
  // Generate the login URL with the callback URL and permissions
  $loginUrl = $helper->getLoginUrl('http://localhost/ipt101/facebook-callback.php', $permissions);
  // Redirect the user to the Facebook login URL
  header('Location: ' . $loginUrl);
  exit();
} catch (\Facebook\Exceptions\FacebookSDKException $e) {
  // Handle Facebook SDK errors
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit();
}
?>
