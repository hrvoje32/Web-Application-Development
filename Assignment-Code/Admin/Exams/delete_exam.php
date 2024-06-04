<?php
// delete_exam.php
include 'database.php';

$examId = $_POST['examId'];

$query = "DELETE FROM exams WHERE exam_id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $examId);

if ($stmt->execute()) {
    echo "Exam deleted successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$con->close();

?>