<?php
// delete_answer.php
include 'database.php';

if (isset($_POST['answerId'])) {
    $answerId = $_POST['answerId'];

    $query = "DELETE FROM options WHERE option_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $answerId);

    if ($stmt->execute()) {
        echo "Answer deleted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
} else {
    echo "Answer ID not provided.";
}

?>