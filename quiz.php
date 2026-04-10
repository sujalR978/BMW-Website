
<?php
  session_start();
    if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
        include 'second_hadder.php';
    } else {
        include 'Header.php';
        Header('Location: user_login.php');
    }
?>
<?php
$score = 0;
$showResult = false;
$scoreMessage = "";
$modalClass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_quiz'])) {
    $totalQuestions = 10;
    // Calculate score based on value="1" for correct answers
    for ($i = 1; $i <= $totalQuestions; $i++) {
        if (isset($_POST['q' . $i]) && $_POST['q' . $i] == '1') {
            $score++;
        }
    }
    
    $showResult = true;
    
    if ($score == 10) {
        $scoreMessage = "Outstanding! You are a true connoisseur of the Ultimate Driving Machine. Perfection achieved.";
        $modalClass = "perfect-score";
    } else if ($score >= 7) {
        $scoreMessage = "Great performance! Your BMW knowledge is high-performance, just like the engines.";
    } else if ($score >= 4) {
        $scoreMessage = "Good effort! You're in the driver's seat, but there's room to tune up your knowledge.";
    } else {
        $scoreMessage = "Ignition stalled! Time to visit the museum and refuel your knowledge.";
    }
}
?>


 
    <br><br><br><br>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMW Quiz - The Ultimate Driving Knowledge</title>
    <link rel="stylesheet" href="quiz.css">
    <link rel="stylesheet" href="css/form-validation.css">
</head>
<body>
   


    <div class="quiz-container">
        <header class="quiz-header">
            <h1>The Ultimate BMW Quiz</h1>
            <p>Test your knowledge about the Ultimate Driving Machine.</p>
        </header>

        <form class="quiz-form" id="bmwQuizForm" method="POST" action="">
            
            <!-- Question 1 -->
            <div class="question-card">
                <h3>1. What does BMW stand for?</h3>
                <div class="options">
                    <input type="radio" name="q1" id="q1a" value="0">
                    <label for="q1a" class="option">British Motor Works</label>

                    <input type="radio" name="q1" id="q1b" value="1">
                    <label for="q1b" class="option">Bayerische Motoren Werke</label>

                    <input type="radio" name="q1" id="q1c" value="0">
                    <label for="q1c" class="option">Berlin Motor Works</label>
                </div>
            </div>

            <!-- Question 2 -->
            <div class="question-card">
                <h3>2. What is the name of BMW's iconic front grille?</h3>
                <div class="options">
                    <input type="radio" name="q2" id="q2a" value="0">
                    <label for="q2a" class="option">The Split Grille</label>

                    <input type="radio" name="q2" id="q2b" value="1">
                    <label for="q2b" class="option">The Kidney Grille</label>

                    <input type="radio" name="q2" id="q2c" value="0">
                    <label for="q2c" class="option">The Double Oval</label>
                </div>
            </div>

            <!-- Question 3 -->
            <div class="question-card">
                <h3>3. Which was the first official BMW "M" car?</h3>
                <div class="options">
                    <input type="radio" name="q3" id="q3a" value="1">
                    <label for="q3a" class="option">BMW M1</label>

                    <input type="radio" name="q3" id="q3b" value="0">
                    <label for="q3b" class="option">BMW M3</label>

                    <input type="radio" name="q3" id="q3c" value="0">
                    <label for="q3c" class="option">BMW M5</label>
                </div>
            </div>

            <!-- Question 4 -->
            <div class="question-card">
                <h3>4. What do the colors in the BMW logo represent?</h3>
                <div class="options">
                    <input type="radio" name="q4" id="q4a" value="0">
                    <label for="q4a" class="option">A spinning propeller</label>

                    <input type="radio" name="q4" id="q4b" value="1">
                    <label for="q4b" class="option">The colors of the Bavarian flag</label>
                </div>
            </div>

            <!-- Question 5 -->
            <div class="question-card">
                <h3>5. Where is the global headquarters of BMW located?</h3>
                <div class="options">
                    <input type="radio" name="q5" id="q5a" value="0">
                    <label for="q5a" class="option">Berlin, Germany</label>

                    <input type="radio" name="q5" id="q5b" value="1">
                    <label for="q5b" class="option">Munich, Germany</label>

                    <input type="radio" name="q5" id="q5c" value="0">
                    <label for="q5c" class="option">Stuttgart, Germany</label>
                </div>
            </div>

            <!-- Question 6 -->
            <div class="question-card">
                <h3>6. Which BMW series is known as the flagship luxury sedan?</h3>
                <div class="options">
                    <input type="radio" name="q6" id="q6a" value="0">
                    <label for="q6a" class="option">BMW 3 Series</label>

                    <input type="radio" name="q6" id="q6b" value="0">
                    <label for="q6b" class="option">BMW 5 Series</label>

                    <input type="radio" name="q6" id="q6c" value="1">
                    <label for="q6c" class="option">BMW 7 Series</label>
                </div>
            </div>

            <!-- Question 7 -->
            <div class="question-card">
                <h3>7. What is the BMW slogan?</h3>
                <div class="options">
                    <input type="radio" name="q7" id="q7a" value="1">
                    <label for="q7a" class="option">Sheer Driving Pleasure</label>

                    <input type="radio" name="q7" id="q7b" value="0">
                    <label for="q7b" class="option">The Best or Nothing</label>

                    <input type="radio" name="q7" id="q7c" value="0">
                    <label for="q7c" class="option">Vorsprung durch Technik</label>
                </div>
            </div>

            <!-- Question 8 -->
            <div class="question-card">
                <h3>8. Which British luxury car brand is owned by BMW?</h3>
                <div class="options">
                    <input type="radio" name="q8" id="q8a" value="0">
                    <label for="q8a" class="option">Bentley</label>

                    <input type="radio" name="q8" id="q8b" value="1">
                    <label for="q8b" class="option">Rolls-Royce</label>

                    <input type="radio" name="q8" id="q8c" value="0">
                    <label for="q8c" class="option">Jaguar</label>
                </div>
            </div>

            <!-- Question 9 -->
            <div class="question-card">
                <h3>9. Which engine configuration is BMW most famous for?</h3>
                <div class="options">
                    <input type="radio" name="q9" id="q9a" value="0">
                    <label for="q9a" class="option">V6 Engine</label>

                    <input type="radio" name="q9" id="q9b" value="1">
                    <label for="q9b" class="option">Inline-6 Engine</label>

                    <input type="radio" name="q9" id="q9c" value="0">
                    <label for="q9c" class="option">Flat-4 Engine</label>
                </div>
            </div>

            <!-- Question 10 -->
            <div class="question-card">
                <h3>10. What was BMW's first electric production car?</h3>
                <div class="options">
                    <input type="radio" name="q10" id="q10a" value="1">
                    <label for="q10a" class="option">BMW i3</label>

                    <input type="radio" name="q10" id="q10b" value="0">
                    <label for="q10b" class="option">BMW i8</label>

                    <input type="radio" name="q10" id="q10c" value="0">
                    <label for="q10c" class="option">BMW iX</label>
                </div>
            </div>

            <div class="quiz-footer">
                <button type="submit" name="submit_quiz" class="submit-btn">Submit Quiz</button>
            </div>

        </form>
    </div>

    <!-- Score Modal -->
    <div id="scoreModal" class="score-modal" style="<?php echo $showResult ? 'display: flex;' : 'display: none;'; ?>">
        <div class="score-content <?php echo $modalClass; ?>">
            <span class="close-btn" onclick="window.location.href='quiz.php'">&times;</span>
            <div class="score-icon">🏆</div>
            <h2>Quiz Completed!</h2>
            <p>Your BMW Knowledge Score:</p>
            <div class="score-circle">
                <span id="finalScore"><?php echo $score; ?></span>/10
            </div>
            <p id="scoreMessage"><?php echo $scoreMessage; ?></p>
            <button class="retry-btn" onclick="window.location.href='quiz.php'">Try Again</button>
        </div>
    </div>

</body>
</html>

    <?php include 'Footer.php'; ?>
    <script src="js/form-validation.js"></script>