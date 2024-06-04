<?php
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemId = $_POST['itemId']; // ID of the item to update
    $updatedItem = $_POST['updatedItem']; // New value

    $stmt = $pdo->prepare("UPDATE items SET item = ? WHERE id = ?");
    $stmt->execute([$updatedItem, $itemId]);

    echo "Item updated successfully.";
}
?>
