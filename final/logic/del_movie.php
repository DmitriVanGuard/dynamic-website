<?php
require_once 'db.php';

$del_id = $_POST['del_id'];

$sql = 'DELETE FROM movies WHERE id = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$del_id]);

$cookie_name = "watched[$del_id]";
if(isset($_COOKIE['watched']) && array_key_exists($del_id, $_COOKIE['watched'])){
  setcookie($cookie_name, '', time()-500, '/');
}

echo (bool) $stmt->rowCount();
