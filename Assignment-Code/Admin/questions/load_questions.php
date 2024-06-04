<?php
// load_questions.php
include 'database.php';

$examId = isset($_GET['examId']) ? $_GET['examId'] : 0;
$query = "SELECT question_id, question_text FROM questions WHERE exam_id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $examId);
$stmt->execute();
$result = $stmt->get_result();

$questions = [];
while($row = $result->fetch_assoc()) {
    $questions[] = ['id' => $row['question_id'], 'text' => $row['question_text']];
}

echo json_encode($questions);
$stmt->close();
$con->close();
?>
