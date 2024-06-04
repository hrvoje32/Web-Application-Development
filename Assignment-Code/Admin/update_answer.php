<?php
// update_answer.php
include 'database.php';

if (isset($_POST['answerId']) && isset($_POST['answerText']) && isset($_POST['isCorrect'])) {
    $answerId = $_POST['answerId'];
    $answerText = $_POST['answerText'];
    $isCorrect = $_POST['isCorrect'] == 'true' ? 1 : 0;

    $query = "UPDATE options SET option_text = ?, is_correct = ? WHERE option_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("sii", $answerText, $isCorrect, $answerId);

    if ($stmt->execute()) {
        echo "Answer updated successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
} else {
    echo "Answer ID, text, or correctness not provided.";
}

?>