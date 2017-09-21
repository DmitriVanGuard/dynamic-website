<?php
require_once 'db.php';

$movie_duration = getNakedInput($_POST['newMovie__duration']);
$movie_title = getNakedInput($_POST['newMovie__title']);

if( empty($movie_duration) || empty($movie_title) || !isset($_POST['newMovie__genres']) ){
  die('Пожалуйста, заполните все поля');
}

try{

  $pdo->beginTransaction();

  $sql_movie = 'INSERT INTO movies(title, duration) VALUES(:title, :duration)';
  $params = [
    ':title' => $movie_title,
    ':duration' => $movie_duration
  ];

  $stmt_movie = $pdo->prepare($sql_movie);
  $stmt_movie->execute($params);

  $last_id = $pdo->lastInsertId();


  $genre_param = [];
  $rows = [];


  foreach($_POST['newMovie__genres'] as $genre){

    array_push($genre_param, $last_id, $genre);

    $str = '(?, ?)';
    array_push($rows, $str);

  }


  $sql_genres = 'INSERT INTO movies_genres(movie_id, genre_id) VALUES' . implode($rows, ',') ;

  $stmt_genres = $pdo->prepare($sql_genres);
  $stmt_genres->execute($genre_param);

  $pdo->commit();

  echo 'Новый фильм успешно добавлен!';

}catch(PDOException $e){

  echo 'Во время добавления фильма произошла ошибка: ' . $e->getMessage();

  $pdo->rollBack();

}





function getNakedInput($input){
  return htmlentities(trim($input));
}
