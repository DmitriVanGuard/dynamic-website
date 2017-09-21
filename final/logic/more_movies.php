<?php
require_once 'db.php';

$offset = (int) $_POST['last_shown_movie'];

$sql = 'SELECT id, title FROM movies ORDER BY id DESC LIMIT :lastShown, 1';
$stmt = $pdo->prepare($sql);

$stmt->bindValue(':lastShown', $offset, PDO::PARAM_INT);

$stmt->execute();

$movie = $stmt->fetch(PDO::FETCH_ASSOC);

header('Content-Type: application/json');

echo json_encode($movie);
