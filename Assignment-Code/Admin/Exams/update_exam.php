<?php
// update_exam.php
include 'database.php';

if (isset($_POST['examId']) && isset($_POST['examName'])) {
    $examId = $_POST['examId'];
    $examName = $_POST['examName'];

    $query = "UPDATE exams SET exam_name = ? WHERE exam_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("si", $examName, $examId);

    if ($stmt->execute()) {
        echo "Exam updated successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
} else {
    echo "Exam ID or name not provided.";
}
?>