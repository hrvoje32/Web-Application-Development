<?php
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newItem = $_POST['newItem']; // The item user added

    $stmt = $pdo->prepare("INSERT INTO items (item) VALUES (?)");
    $stmt->execute([$newItem]);

    echo "Item added successfully.";
}
?>
