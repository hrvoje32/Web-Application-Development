<?php
// set_timing.php
// Set timing for a question

include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question_id = mysqli_real_escape_string($conn, $_POST['question_id']);
    $timing = mysqli_real_escape_string($conn, $_POST['timing']);

    // Set the timing
    // Assuming there is a 'timing' column in the 'questions' table
    $query = "UPDATE questions SET timing='$timing' WHERE qid='$question_id'";
    mysqli_query($conn, $query);
}
?>