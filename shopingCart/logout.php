<?php
session_start();
include 'config.php';

// Check if the user is logged in
if (isset($_SESSION['cus_id'])) {

    // Clear all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Redirect to the login page with a success message
    header("Location: login.php?logout=success");
    echo '<script>alert("successfull");</script>';
    exit();
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}
?>
