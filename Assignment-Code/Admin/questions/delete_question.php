<?php
// delete_question.php
include 'database.php';

if (isset($_POST['questionId'])) {
    $questionId = $_POST['questionId'];

    $query = "DELETE FROM questions WHERE question_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $questionId);

    if ($stmt->execute()) {
        echo "Question deleted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
} else {
    echo "Question ID not provided.";
}

?>