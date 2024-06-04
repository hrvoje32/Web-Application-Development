<?php
// load_answers.php
include 'database.php';

$questionId = isset($_GET['questionId']) ? $_GET['questionId'] : 0;
$query = "SELECT option_id, option_text, is_correct FROM options WHERE question_id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $questionId);
$stmt->execute();
$result = $stmt->get_result();

$answers = [];
while($row = $result->fetch_assoc()) {
    $answers[] = ['id' => $row['option_id'], 'text' => $row['option_text'], 'correct' => $row['is_correct']];
}

echo json_encode($answers);
$stmt->close();
$con->close();
?>
