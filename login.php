<?php
// login.php
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $stmt = $pdo->prepare("SELECT password FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            header("Location: quiz.html");
            exit;
        } else {
            echo "Invalid username or password";
        }
    } catch (\PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
}

?>
