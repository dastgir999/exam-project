<?php
session_start();
require 'db.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit;
}

$stmt = $pdo->query("SELECT * FROM questions");
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Question</th>
        <th>Options</th>
        <th>Correct Option</th>
    </tr>
    <?php foreach ($questions as $question): ?>
    <tr>
        <td><?= $question['id'] ?></td>
        <td><?= $question['question_text'] ?></td>
        <td>
            <?= $question['option1'] ?><br>
            <?= $question['option2'] ?><br>
            <?= $question['option3'] ?><br>
            <?= $question['option4'] ?>
        </td>
        <td><?= $question['correct_option'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<a href="dashboard.php">Back to Dashboard</a>