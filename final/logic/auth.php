<?php
require_once 'db.php';

$login = trim($_POST['login']);
$pwd = trim($_POST['pwd']);

if( !empty($login) && !empty($pwd) ){

  $sql = 'SELECT login, password FROM users WHERE login = :login';
  $params = [':login' => $login];

  $stmt = $pdo->prepare($sql);
  $stmt->execute($params);

  $user = $stmt->fetch(PDO::FETCH_OBJ);

  if($user){

    if( password_verify($pwd, $user->password) ){
      $_SESSION['user_login'] = $user->login;
      header('Location: ../index.php');
    }else{
      echo 'Неверный логин или пароль';
    }

  }else{
    echo 'Неверный логин или пароль';
  }

}else{
  echo 'Пожалуйста, заполните все поля';
}
