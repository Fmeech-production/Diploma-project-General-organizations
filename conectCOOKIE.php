<?php
  include 'conectSQL.php';
  $login = $_COOKIE['login'];
  $password = $_COOKIE['password'];
  $результат = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
  $user = $результат->fetch_assoc();
  $userId = $user['id'];
  
  if ($user == null){
    
    include 'login.php';
      exit();
    }
?>