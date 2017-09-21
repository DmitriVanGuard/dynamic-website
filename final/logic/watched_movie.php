<?php

$movie_id = $_POST['watched_id'];
$cookie_name = "watched[$movie_id]";

if( isset($_COOKIE['watched']) && array_key_exists($movie_id, $_COOKIE['watched']) ){
  setcookie($cookie_name, '', time()-400, '/');
}else{
  setcookie($cookie_name, '1', time()+60*60, '/');
}
