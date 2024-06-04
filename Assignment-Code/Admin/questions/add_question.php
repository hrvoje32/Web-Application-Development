<?php
// add_question.php
include 'database.php';

if (isset($_POST['examId']) && isset($_POST['questionText'])) {
    $examId = $_POST['examId'];
    $questionText = $_POST['questionText'];

    $query = "INSERT INTO questions (exam_id, question_text) VALUES (?, ?)";
    $stmt = $con->prepare($query);
    $stmt->bind_param("is", $examId, $questionText);

    if ($stmt->execute()) {
        echo "Question added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
} else {
    echo "Exam ID or question text not provided.";
}

?>