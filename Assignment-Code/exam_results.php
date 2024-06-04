<?php
session_start();

// Check if attempt_id is set in the session
if (!isset($_SESSION['attempt_id'])) {
    die("No exam attempt ID found in session.");
}

$attempt_id = $_SESSION['attempt_id'];

// Include the database configuration file
$config = include('config.php');
$dbConfig = $config['mysql'];

try {
    // Create a new PDO connection
    $pdo = new PDO("mysql:host={$dbConfig['host']};dbname={$dbConfig['name']};charset={$dbConfig['charset']}", 
                   $dbConfig['user'], 
                   $dbConfig['pass']);

    // Prepare and execute the query
    $stmt = $pdo->prepare("SELECT ua.question_id, ua.option_id, o.is_correct 
                           FROM user_answers ua 
                           JOIN options o ON ua.option_id = o.option_id 
                           WHERE ua.attempt_id = ? AND ua.question_id = o.question_id");
    $stmt->execute([$attempt_id]);
    $answers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Count correct and incorrect answers
    $correct = 0;
    $incorrect = 0;
    foreach ($answers as $answer) {
        if ($answer['is_correct']) {
            $correct++;
        } else {
            $incorrect++;
        }
    }
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
include 'navigation.html';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Exam Results</title>
    <link rel="stylesheet" href="css/mode.css">
    <script src="js/mode.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .results {
            margin-top: 20px;
        }
        .correct {
            color: green;
        }
        .incorrect {
            color: red;
        }
    </style>
</head>
<body>
    <h1>Exam Results</h1>
    <div class="results">
        <p class="correct">Correct Answers: <?php echo $correct; ?></p>
        <p class="incorrect">Incorrect Answers: <?php echo $incorrect; ?></p>
    </div>
     <button id="modeSwitch" class="switch">Switch to Dark Mode</button>
</body>
</html>
