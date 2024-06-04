<?php
require 'db_connect.php';

$stmt = $pdo->query("SELECT username, score FROM users JOIN scores ON users.id = scores.user_id ORDER BY score DESC LIMIT 5");
$leaderboard = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($leaderboard);
?>
