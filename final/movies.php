<?php require_once 'logic/db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php require_once 'parts/head.php'; ?>
</head>
<body>
  <?php include_once 'parts/header.php'; ?>

  <?php if( isset($_SESSION['user_login']) ): ?>

    <h3>Всего просмотрено фильмов: <span id="watched-count">
      <?php
        if( isset($_COOKIE['watched']) ):
          echo count($_COOKIE['watched']);
        else:
          echo 0;
        endif;
      ?>
    </span></h3>

    <section id='movies-sec'>
      <?php include_once 'logic/print_movies.php'; ?>
    </section>

  <?php else: ?>
    <?php include_once 'parts/not_auth.php'; ?>
  <?php endif; ?>


</body>
</html>
