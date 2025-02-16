<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $answers = json_decode($_POST['answers'], true);

    $score = 0;
    $totalQuestions = 0;

    foreach ($answers as $answer) {
        $stmt = $pdo->prepare("SELECT correct_option FROM questions WHERE id = ?");
        $stmt->execute([$answer['questionId']]);
        $correctOption = $stmt->fetchColumn();

        if ($correctOption == $answer['answer']) {
            $score++;
        }
        $totalQuestions++;
    }

    // Save result
    $stmt = $pdo->prepare("INSERT INTO results (user_id, score, total_questions) VALUES (?, ?, ?)");
    $stmt->execute([$_SESSION['user_id'], $score, $totalQuestions]);

    echo $score;
}