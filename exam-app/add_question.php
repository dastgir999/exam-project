<?php
session_start();
require 'db.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $question_text = $_POST['question_text'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $correct_option = $_POST['correct_option'];

    $stmt = $pdo->prepare("INSERT INTO questions (question_text, option1, option2, option3, option4, correct_option) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt->execute([$question_text, $option1, $option2, $option3, $option4, $correct_option])) {
        $_SESSION['message'] = "Question added successfully!";
    } else {
        $_SESSION['error'] = "Failed to add question!";
    }
}
?>

<form method="POST" action="">
    <textarea name="question_text" placeholder="Question" required></textarea><br>
    <input type="text" name="option1" placeholder="Option 1" required><br>
    <input type="text" name="option2" placeholder="Option 2" required><br>
    <input type="text" name="option3" placeholder="Option 3" required><br>
    <input type="text" name="option4" placeholder="Option 4" required><br>
    <select name="correct_option" required>
        <option value="1">Option 1</option>
        <option value="2">Option 2</option>
        <option value="3">Option 3</option>
        <option value="4">Option 4</option>
    </select><br>
    <button type="submit">Add Question</button>
</form>
<a href="dashboard.php">Back to Dashboard</a>