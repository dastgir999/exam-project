<?php
session_start();
require 'db.php';

$stmt = $pdo->prepare("SELECT * FROM results WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Score</th>
        <th>Total Questions</th>
        <th>Submitted At</th>
    </tr>
    <?php foreach ($results as $result): ?>
    <tr>
        <td><?= $result['id'] ?></td>
        <td><?= $result['score'] ?></td>
        <td><?= $result['total_questions'] ?></td>
        <td><?= $result['submitted_at'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<a href="dashboard.php">Back to Dashboard</a>