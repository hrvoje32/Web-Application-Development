<?php
// delete_question.php
// Delete a question

include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question_id = mysqli_real_escape_string($conn, $_POST['question_id']);

    // Delete the question
    $query = "DELETE FROM questions WHERE qid='$question_id'";
    mysqli_query($conn, $query);
}
?>