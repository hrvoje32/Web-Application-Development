<?php
session_start();
require 'db_connect.php';  // Only if needed to fetch user data

// Assuming user ID is stored in a session variable after login
if (isset($_SESSION['userId'])) {
    echo json_encode(['userId' => $_SESSION['userId']]);
} else {
    echo json_encode(['userId' => null]);  // Handle the case where no user is logged in
}
?>
