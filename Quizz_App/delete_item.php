<?php
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemId = $_POST['itemId']; // ID of the item to delete

    $stmt = $pdo->prepare("DELETE FROM items WHERE id = ?");
    $stmt->execute([$itemId]);

    echo "Item deleted successfully.";
}
?>
