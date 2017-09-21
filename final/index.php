<?php require_once 'logic/db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php require_once 'parts/head.php'; ?>
</head>
<body>
  <?php include_once 'parts/header.php'; ?>

  <?php if( isset($_SESSION['user_login']) ): ?>

    <h1>Добро пожаловать, <?php echo $_SESSION['user_login']; ?></h1>
    <a href="logic/logout.php">Выйти из аккаунта</a>
    <br>

    <h3>Последний добавленный фильм:</h3>
    <?php include_once 'logic/last_movie.php'; ?>

    <hr>
    <button type="button" id="showMore">Показать еще</button>

  <?php else: ?>
    <?php include_once 'parts/not_auth.php'; ?>
  <?php endif; ?>


</body>
</html>
