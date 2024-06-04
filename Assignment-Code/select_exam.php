<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Enable error reporting for debugging (remove/comment out in production)
ini_set('display_errors', 1);
error_reporting(E_ALL);

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

// Retrieve available exams
$stmt = $pdo->query("SELECT exam_id, exam_name FROM exams");
$exams = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Select Exam</title>
    <link rel="stylesheet" href="css/mode.css">
    <script src="js/mode.js"></script>
    <style>
        /* Style for the dropdown */
select {
    width: 200px; /* Width of the dropdown */
    padding: 5px; /* Padding inside the dropdown */
    margin-bottom: 10px; /* Margin at the bottom of the dropdown */
    border-radius: 5px; /* Rounded corners */
    border: 1px solid #ccc; /* Border color */
}

/* Style for the button */
input[type="submit"] {
    padding: 10px 15px; /* Padding inside the button */
    background-color: #4CAF50; /* Background color */
    color: white; /* Text color */
    border: none; /* No border */
    border-radius: 5px; /* Rounded corners */
    cursor: pointer; /* Cursor changes to pointer on hover */
}

/* Change button color on hover */
input[type="submit"]:hover {
    background-color: #45a049;
}
    </style>
</head>
<body>
    <?php include 'navigation.html'; ?>
    <h2>Select an Exam</h2>
    <form method='post' action='start_exam.php'>
        <select name='exam_id'>
            <?php foreach ($exams as $exam) {
                echo "<option value='{$exam['exam_id']}'>{$exam['exam_name']}</option>";
            } ?>
        </select>
        <input type='submit' value='Start Exam'>
        
    </form>
        <button id="modeSwitch" class="switch">Switch to Dark Mode</button>
</body>
</html>
