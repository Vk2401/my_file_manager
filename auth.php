<?php
session_start();
include('dbcon.php'); // Include the database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['uname'];
    $password = $_POST['pass'];

    // Check user credentials
    $sql = "SELECT * FROM users WHERE uname = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // User authenticated, fetch and set session variables
        $query = "SELECT type FROM users WHERE uname = '$username'";
        $res = $conn->query($query);
        
        if ($res && $res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $userType = $row['type'];
            $_SESSION['type'] = $userType; // Set the user type in the session
        }
        
        $_SESSION['username'] = $username;

        header("Location: index.php"); // Redirect to dashboard or protected page
    } else {
        // Invalid credentials, redirect back to login page
        header("Location: login.php");
    }
} else {
    header("Location: login.php"); // Redirect if accessed directly
}
?>
