<?php
require 'db_connect.php';

$stmt = $pdo->query("SELECT * FROM questions");
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($questions as $key => $question) {
    $stmt = $pdo->prepare("SELECT * FROM options WHERE question_id = ?");
    $stmt->execute([$question['id']]);
    $questions[$key]['options'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

echo json_encode($questions);
?>
