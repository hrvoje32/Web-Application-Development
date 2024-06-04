<?php
// add_question.php
// Add a new question

include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get question and options from the form
    $question = mysqli_real_escape_string($conn, $_POST['question']);
    // Assume options are sent as an array
    $options = $_POST['options'];

    // Insert the question into the questions table
    $query = "INSERT INTO questions (qns) VALUES ('$question')";
    mysqli_query($conn, $query);
    $question_id = mysqli_insert_id($conn);

    // Insert options for this question
    foreach ($options as $option) {
        $opt = mysqli_real_escape_string($conn, $option);
        $query = "INSERT INTO options (qid, option) VALUES ('$question_id', '$opt')";
        mysqli_query($conn, $query);
    }
}
?>
