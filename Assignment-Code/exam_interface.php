<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_GET['attempt_id'])) {
    header("Location: login.php");
    exit();
}

$_SESSION['attempt_id'] = $_GET['attempt_id'];

$config = include('config.php');
$dbConfig = $config['mysql'];

try {
    $pdo = new PDO("mysql:host={$dbConfig['host']};dbname={$dbConfig['name']};charset={$dbConfig['charset']}", 
                   $dbConfig['user'], 
                   $dbConfig['pass']);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

$attempt_id = $_GET['attempt_id'];
$stmt = $pdo->prepare("SELECT question_id FROM questions WHERE exam_id = (SELECT exam_id FROM user_attempts WHERE attempt_id = ?) AND question_id NOT IN (SELECT question_id FROM user_answers WHERE attempt_id = ?) LIMIT 1");
$stmt->execute([$attempt_id, $attempt_id]);
$current_question_result = $stmt->fetch(PDO::FETCH_ASSOC);
$current_question_id = $current_question_result ? $current_question_result['question_id'] : null;

if (!$current_question_id) {
    header("Location: exam_results.php");
    exit();
}

$stmt = $pdo->prepare("SELECT question_text FROM questions WHERE question_id = ?");
$stmt->execute([$current_question_id]);
$question = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT option_id, option_text FROM options WHERE question_id = ?");
$stmt->execute([$current_question_id]);
$options = $stmt->fetchAll(PDO::FETCH_ASSOC);
include 'navigation.html';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Exam Interface</title>
     <link rel="stylesheet" href="css/mode.css">
    <script src="js/mode.js"></script>
    <style>
        .correct { background-color: green; }
        .incorrect { background-color: red; }
    </style>
</head>
<body>
    <h2>Exam Interface</h2>
    <div>Question: <?php echo htmlspecialchars($question['question_text']); ?></div>
    <form id="questionForm">
        <?php foreach ($options as $option): ?>
            <label>
                <input type="radio" name="answer" value="<?php echo $option['option_id']; ?>">
                <?php echo htmlspecialchars($option['option_text']); ?>
            </label><br>
        <?php endforeach; ?>
        <input type="button" value="Submit Answer" onclick="submitAnswer()">
    <input type="button" id="nextButton" value="Next Question" onclick="loadNextQuestion()" style="display: none;">
    </form>
    <div id='time'></div>
 <button id="modeSwitch" class="switch">Switch to Dark Mode</button>
<script>
// Global variables
let remainingTime = sessionStorage.getItem('remainingTime') ? parseInt(sessionStorage.getItem('remainingTime')) : 60 * 30; // 30 minutes
let timerInterval;

function isNewTest() {
    let currentAttemptId = '<?php echo $_SESSION['attempt_id']; ?>';
    let storedAttemptId = sessionStorage.getItem('lastAttemptId');
    return !storedAttemptId || currentAttemptId !== storedAttemptId;
}

function startTimer() {
    let remainingTime = sessionStorage.getItem('remainingTime') ? parseInt(sessionStorage.getItem('remainingTime')) : 60 * 30; // 30 minutes in seconds
    let timerInterval;

    var display = document.querySelector('#time');
    timerInterval = setInterval(function () {
        let minutes = parseInt(remainingTime / 60, 10);
        let seconds = parseInt(remainingTime % 60, 10);

        minutes = minutes < 10 ? '0' + minutes : minutes;
        seconds = seconds < 10 ? '0' + seconds : seconds;

        display.textContent = minutes + ':' + seconds;

        if (--remainingTime < 0) {
            clearInterval(timerInterval);
            alert("Time's up!");
            window.location.href = 'exam_results.php'; // Redirect to results page
        }

        sessionStorage.setItem('remainingTime', remainingTime);
    }, 1000);
}

window.onload = function () {
    if (isNewTest()) {
        sessionStorage.setItem('remainingTime', 60 * 30); // Reset timer for new test
        sessionStorage.setItem('lastAttemptId', '<?php echo $_SESSION['attempt_id']; ?>');
    }

    startTimer();
    document.getElementById('nextButton').style.display = 'none'; // Hide next button initially
};

function submitAnswer() {
    var formData = new FormData(document.getElementById('questionForm'));
    formData.append('question_id', '<?php echo $current_question_id; ?>');
    formData.append('attempt_id', '<?php echo $_SESSION['attempt_id']; ?>');
    fetch('submit_answer.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        updateFeedback(data.is_correct, data.correct_option_id);
        if (data.status === 'more_questions') {
            document.getElementById('nextButton').style.display = 'block';
            document.getElementById('nextButton').onclick = function() { loadNextQuestion(data.next_question_id); };
        } else if (data.status === 'exam_completed') {
            setTimeout(() => window.location.href = 'exam_results.php', 2000);
        }
    })
    .catch(error => console.error('Error:', error));
}

function loadNextQuestion(nextQuestionId) {
    window.location.href = 'exam_interface.php?attempt_id=' + '<?php echo $_SESSION['attempt_id']; ?>' + '&question_id=' + nextQuestionId;
}

function updateFeedback(isCorrect, correctOptionId) {
    let selectedOption = document.querySelector('input[name="answer"]:checked');
    if (selectedOption) {
        let parentLabel = selectedOption.parentNode;
        parentLabel.style.backgroundColor = isCorrect ? 'green' : 'red';

        if (!isCorrect) {
            // Highlight the correct answer in green
            let correctOption = document.querySelector('input[value="' + correctOptionId + '"]');
            if (correctOption) {
                let correctLabel = correctOption.parentNode;
                correctLabel.style.backgroundColor = 'green';
            }
        }
    }
}



</script>


</body>
</html>
