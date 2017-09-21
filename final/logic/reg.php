<?php
require_once 'db.php';

$login = trim( $_POST['login'] );
$pwd = trim( $_POST['pwd'] );
if( !empty($login) && !empty($pwd) ){

  // Проверка существования пользователя
  $sql_check = 'SELECT EXISTS( SELECT login FROM users WHERE login = :login )';
  $stmt_check = $pdo->prepare($sql_check);
  $stmt_check->execute( [':login' => $login] );

  if( $stmt_check->fetchColumn() ){
    die('Пользователь с таким логином уже существует');
  }

  $pwd = password_hash($pwd, PASSWORD_DEFAULT);

  $sql = 'INSERT INTO users(login, password) VALUES(:login, :pwd)';
  $params = [ 'login' => $login, ':pwd' => $pwd ];

  $stmt = $pdo->prepare($sql);
  $stmt->execute($params);

  echo 'Вы успешно зарегистрировались!';

}else{
  echo 'Пожалуйста, заполните все поля';
}

?>
<br>
<a href="../signin.php">Страница авторизации</a>
