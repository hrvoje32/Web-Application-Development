<?php
// update_question.php
// Update a question

include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question_id = mysqli_real_escape_string($conn, $_POST['question_id']);
    $new_question = mysqli_real_escape_string($conn, $_POST['new_question']);

    // Update the question
    $query = "UPDATE questions SET qns='$new_question' WHERE qid='$question_id'";
    mysqli_query($conn, $query);
}
?>