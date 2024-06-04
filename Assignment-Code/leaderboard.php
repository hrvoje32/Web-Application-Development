<!DOCTYPE html>
<html>
<head>
    <title>Leaderboard</title>
     <link rel="stylesheet" href="css/mode.css">
    <script src="js/mode.js"></script>
    <style>
        /* Existing CSS */
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 5px;
            text-align: left;
        }
    </style>
</head>
<body>
    <?php include 'navigation.html'; ?>

    <h2>Leaderboard</h2>
    
    <?php
    $config = include('config.php');
    $dbConfig = $config['mysql'];

    $pdo = new PDO("mysql:host={$dbConfig['host']};dbname={$dbConfig['name']};charset={$dbConfig['charset']}", $dbConfig['user'], $dbConfig['pass']);

    $selected_exam_id = isset($_GET['exam_id']) ? $_GET['exam_id'] : 1;

    $examStmt = $pdo->query("SELECT exam_id, exam_name FROM exams");
    $exams = $examStmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <!-- Dropdown for selecting exams -->
    <form action="" method="get">
        <select name="exam_id">
            <?php foreach ($exams as $exam): ?>
                <option value="<?php echo $exam['exam_id']; ?>"<?php echo $exam['exam_id'] == $selected_exam_id ? " selected" : ""; ?>><?php echo htmlspecialchars($exam['exam_name']); ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Show Leaderboard">
    </form>

    <?php
    $stmt = $pdo->prepare("SELECT 
        u.username AS name,
        COUNT(DISTINCT ua.attempt_id) AS exams_taken,
        SUM(CASE WHEN o.is_correct = 1 THEN 1 ELSE 0 END) AS correct_answers,
        SUM(CASE WHEN o.is_correct = 0 THEN 1 ELSE 0 END) AS incorrect_answers
    FROM users u
    JOIN user_attempts ua ON u.user_id = ua.user_id
    JOIN user_answers a ON ua.attempt_id = a.attempt_id
    JOIN options o ON a.option_id = o.option_id
    WHERE ua.exam_id = :exam_id
    GROUP BY u.username
    ORDER BY exams_taken DESC, correct_answers DESC, incorrect_answers ASC");
    $stmt->execute(['exam_id' => $selected_exam_id]);
    $leaderboard = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <!-- Display leaderboard in a table -->
    <table>
        <tr>
            <th>Name</th>
            <th>Exams Taken</th>
            <th>Correct Answers</th>
            <th>Incorrect Answers</th>
        </tr>
        <?php foreach ($leaderboard as $entry): ?>
            <tr>
                <td><?php echo htmlspecialchars($entry['name']); ?></td>
                <td><?php echo htmlspecialchars($entry['exams_taken']); ?></td>
                <td><?php echo htmlspecialchars($entry['correct_answers']); ?></td>
                <td><?php echo htmlspecialchars($entry['incorrect_answers']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
     <button id="modeSwitch" class="switch">Switch to Dark Mode</button>
</body>
</html>
