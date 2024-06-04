<?php
// load_exams.php
include 'database.php';

$query = "SELECT exam_id, exam_name FROM exams";
$result = $con->query($query);

$exams = [];
while($row = $result->fetch_assoc()) {
    $exams[] = ['id' => $row['exam_id'], 'name' => $row['exam_name']];
}

echo json_encode($exams);
$con->close();
?>
