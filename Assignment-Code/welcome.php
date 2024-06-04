<?php
session_start();

// Redirect user to login page if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="css/mode.css">
    <script src="js/mode.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .welcome-message {
            margin-top: 20px;
            text-align: center;
            font-size: 24px;
            padding-top: 15%; 
        }
     .container-boxes {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            margin-top: 15%;
        }

        .box {
    width: 30%;
            margin: 10px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            border: 1px solid;
            border-radius: 8px;
            box-sizing: border-box;
            box-shadow: 2px 2px 2px 1px rgb(0 0 0 / 20%);
            
        }

        @media (max-width: 600px) {
            .box {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="welcome-message">
        Hello, <?php echo htmlspecialchars($username); ?>!<br>Please choose what you want to do today!
    </div>
       <div class="container-boxes">
        <div class="box" onclick="navigateToPage('select_exam.php')">
            <h2>Exams</h2>
        </div>
        <div class="box" onclick="navigateToPage('past_exams.php')">
            <h2>Exam History</h2>
        </div>
        <div class="box" onclick="navigateToPage('leaderboard.php')">
            <h2>Leaderboard</h2>
        </div>
    </div>
    <button id="modeSwitch" class="switch">Switch to Dark Mode</button>
    <script>
    function navigateToPage(pageUrl){
        window.location.href = pageUrl;
    }
</script>
</body>
</html>
