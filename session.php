<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    session_start();

    // Clear session data and destroy the session
    session_unset();
    session_destroy();

    // Redirect to login page
    header("Location: login.php");
    exit();

}
?>