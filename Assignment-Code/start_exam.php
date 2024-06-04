<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

// Include the database configuration file
$config = include('config.php');
$dbConfig = $config['mysql'];

// Create a new PDO connection
try {
    $pdo = new PDO("mysql:host={$dbConfig['host']};dbname={$dbConfig['name']};charset={$dbConfig['charset']}", 
                   $dbConfig['user'], 
                   $dbConfig['pass']);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

// Check if an exam is selected
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['exam_id'])) {
    $exam_id = $_POST['exam_id'];
    $user_id = $_SESSION['user_id'];

    // Record the user's attempt
    $stmt = $pdo->prepare("INSERT INTO user_attempts (user_id, exam_id) VALUES (?, ?)");
    $stmt->execute([$user_id, $exam_id]);
    $attempt_id = $pdo->lastInsertId();

    // Redirect to exam interface with the first question
    header("Location: exam_interface.php?attempt_id={$attempt_id}");
    exit();
} else {
    die("No exam selected.");
}
?>
