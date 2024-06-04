<?php

// add_answer.php
include 'database.php';

if (isset($_POST['questionId']) && isset($_POST['answerText']) && isset($_POST['isCorrect'])) {
    $questionId = $_POST['questionId'];
    $answerText = $_POST['answerText'];
    $isCorrect = filter_var($_POST['isCorrect'], FILTER_VALIDATE_BOOLEAN) ? 1 : 0;

    $query = "INSERT INTO options (question_id, option_text, is_correct) VALUES (?, ?, ?)";
    $stmt = $con->prepare($query);
    if (!$stmt) {
        error_log("Prepare failed: " . $con->error);
        echo "Error preparing statement: " . $con->error;
        exit;
    }

    $stmt->bind_param("isi", $questionId, $answerText, $isCorrect);

    if ($stmt->execute()) {
        echo "Answer added successfully.";
    } else {
        error_log("Execute failed: " . $stmt->error);
        echo "Error executing statement: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
} else {
    echo "Required data not provided.";
}

?>