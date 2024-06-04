<?php
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Example: retrieve user ID and answers
    $userId = $_POST['userId'];
    $answers = $_POST['answers']; // This should be an array of option IDs

    $score = 0;
    foreach ($answers as $questionId => $optionId) {
        $stmt = $pdo->prepare("SELECT is_correct FROM options WHERE id = ?");
        $stmt->execute([$optionId]);
        $result = $stmt->fetch();

        if ($result['is_correct']) {
            $score++;
        }
    }

    // Insert score into database
    $stmt = $pdo->prepare("INSERT INTO scores (user_id, score) VALUES (?, ?)");
    $stmt->execute([$userId, $score]);

    echo "Score recorded: $score";
}
?>
