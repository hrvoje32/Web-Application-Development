<?php
session_start();

// Include the database configuration file
$config = include('config.php');
$dbConfig = $config['mysql'];

$pdo = new PDO("mysql:host={$dbConfig['host']};dbname={$dbConfig['name']};charset={$dbConfig['charset']}", 
               $dbConfig['user'], 
               $dbConfig['pass']);

$user_id = $_SESSION['user_id'];

// Modified SQL query to fetch exam name, start time, and count of correct/incorrect answers
$stmt = $pdo->prepare("SELECT e.exam_name, ua.start_time, 
                       SUM(o.is_correct = 1) AS correct_answers, 
                       SUM(o.is_correct = 0) AS incorrect_answers
                       FROM user_attempts ua
                       JOIN exams e ON ua.exam_id = e.exam_id
                       LEFT JOIN user_answers a ON ua.attempt_id = a.attempt_id
                       LEFT JOIN options o ON a.option_id = o.option_id
                       WHERE ua.user_id = ?
                       GROUP BY ua.attempt_id, e.exam_name, ua.start_time");
$stmt->execute([$user_id]);
$attempts = $stmt->fetchAll(PDO::FETCH_ASSOC);

include 'navigation.html';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Past Exams</title>
    <link rel="stylesheet" href="css/mode.css">
    <script src="js/mode.js"></script>
</head>
<body>
    <h2>Past Exams</h2>
    <div>
        <?php foreach ($attempts as $attempt): ?>
            <p>
                Exam: <?php echo htmlspecialchars($attempt['exam_name']); ?> <br>
                Started on: <?php echo htmlspecialchars($attempt['start_time']); ?> <br>
                Correct Answers: <?php echo $attempt['correct_answers']; ?> <br>
                Incorrect Answers: <?php echo $attempt['incorrect_answers']; ?>
            </p>
        <?php endforeach; ?>
    </div>
     <button id="modeSwitch" class="switch">Switch to Dark Mode</button>
</body>
</html>
