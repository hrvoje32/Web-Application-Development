<?php
// update_question.php
include 'database.php';

if (isset($_POST['questionId']) && isset($_POST['questionText'])) {
    $questionId = $_POST['questionId'];
    $questionText = $_POST['questionText'];

    $query = "UPDATE questions SET question_text = ? WHERE question_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("si", $questionText, $questionId);

    if ($stmt->execute()) {
        echo "Question updated successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
} else {
    echo "Question ID or text not provided.";
}

?>