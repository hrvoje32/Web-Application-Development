<?php
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password']; // This should be hashed

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $result = $stmt->execute([$username, $password]);

    if ($result) {
        // Redirect to the welcome page after successful registration
        header("Location: /welcome.html");
        exit;
    } else {
        // Handle registration failure
        header("Location: /public/html/register.html?error=registration_failed");
        exit;
    }
}
?>
