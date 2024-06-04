<?php
session_start();
header('Content-Type: application/json');

$response = ['status' => 'error', 'message' => 'An unknown error occurred'];

if (!isset($_SESSION['user_id']) || !isset($_POST['question_id']) || !isset($_POST['answer']) || !isset($_POST['attempt_id'])) {
    $response['message'] = 'Invalid access.';
    echo json_encode($response);
    exit();
}

$config = include('config.php');
$dbConfig = $config['mysql'];

try {
    $pdo = new PDO("mysql:host={$dbConfig['host']};dbname={$dbConfig['name']};charset={$dbConfig['charset']}", 
                   $dbConfig['user'], 
                   $dbConfig['pass']);

    $question_id = htmlspecialchars($_POST['question_id']);
    $answer = htmlspecialchars($_POST['answer']);
    $attempt_id = htmlspecialchars($_POST['attempt_id']);

    // Record the answer
    $stmt = $pdo->prepare("INSERT INTO user_answers (attempt_id, question_id, option_id) VALUES (?, ?, ?)");
    $stmt->execute([$attempt_id, $question_id, $answer]);

    // Check if the answer is correct and fetch the correct answer's ID
    $checkAnswerStmt = $pdo->prepare("SELECT option_id, is_correct FROM options WHERE question_id = ?");
    $checkAnswerStmt->execute([$question_id]);
    $isCorrect = false;
    $correctOptionId = null;
    while ($row = $checkAnswerStmt->fetch(PDO::FETCH_ASSOC)) {
        if ($row['is_correct']) {
            $correctOptionId = $row['option_id'];
            $isCorrect = $row['option_id'] == $answer;
        }
    }

    // Fetch next question ID
    $nextQuestionStmt = $pdo->prepare("SELECT question_id FROM questions WHERE exam_id = (SELECT exam_id FROM user_attempts WHERE attempt_id = ?) AND question_id NOT IN (SELECT question_id FROM user_answers WHERE attempt_id = ?) LIMIT 1");
    $nextQuestionStmt->execute([$attempt_id, $attempt_id]);
    $next_question = $nextQuestionStmt->fetch(PDO::FETCH_ASSOC);

    if ($next_question) {
        $response = [
            'status' => 'more_questions',
            'next_question_id' => $next_question['question_id'],
            'is_correct' => $isCorrect,
            'correct_option_id' => $correctOptionId // Add this line
        ];
    } else {
        $response = [
            'status' => 'exam_completed', 
            'is_correct' => $isCorrect,
            'correct_option_id' => $correctOptionId // Add this line
        ];
    }
} catch (PDOException $e) {
    $response['message'] = 'Database connection failed: ' . $e->getMessage();
}

echo json_encode($response);
?>
