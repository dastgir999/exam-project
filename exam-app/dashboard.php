<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$role = $_SESSION['role'];
?>

<h1>Welcome, <?= $_SESSION['username'] ?></h1>
<?php if ($role === 'admin'): ?>
    <a href="add_question.php">Add Question</a><br>
    <a href="view_questions.php">View Questions</a><br>
<?php else: ?>
    <a href="exam.php">Take Exam</a><br>
    <a href="results.php">View Results</a><br>
<?php endif; ?>
<a href="logout.php">Logout</a>