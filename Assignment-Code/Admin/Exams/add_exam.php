<?php
// add_exam.php
include 'database.php';

if (isset($_POST['examName'])) {
    $examName = $_POST['examName'];

    $query = "INSERT INTO exams (exam_name) VALUES (?)";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $examName);

    if ($stmt->execute()) {
        echo "Exam added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
} else {
    echo "No exam name provided.";
}
?>
