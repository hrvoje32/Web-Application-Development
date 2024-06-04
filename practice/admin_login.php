<?php
// admin_login.php
// Handle admin login

// Connect to the database
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query to check if the admin exists
    $query = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        // Admin authenticated
        session_start();
        $_SESSION['admin_login'] = $email;
        header("location: admin_dashboard.php");
    } else {
        // Authentication failed
        header("location: admin_login.php?error=Invalid Credentials");
    }
}
?>