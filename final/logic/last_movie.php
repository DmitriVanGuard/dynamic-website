<?php
require_once 'db.php';

$sql = 'SELECT id, title FROM movies ORDER BY id DESC LIMIT 1';
$result = $pdo->query($sql);
$movie = $result->fetch(PDO::FETCH_OBJ);
?>

<h4>
  <a href=<?php echo 'movies.php#movie_' . $movie->id; ?> ><?php echo $movie->title; ?></a>
</h4>
