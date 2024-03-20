<?php
// Start session to manage user session data
session_start();

// Include database connection file
include "db_conn.php";

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Update Active status to 'offline'
    $update_sql = "UPDATE users SET Active = 'offline' WHERE id = ?";
    $update_stmt = mysqli_prepare($conn, $update_sql);
    mysqli_stmt_bind_param($update_stmt, "i", $_SESSION['user_id']);
    mysqli_stmt_execute($update_stmt);

    // Destroy the session
    session_unset();
    session_destroy();
}

// Redirect the user to the login page
header("Location: loginform.php");
exit();
?>
