<?php
session_start();
require 'db.php';

$stmt = $pdo->query("SELECT * FROM questions");
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($questions);