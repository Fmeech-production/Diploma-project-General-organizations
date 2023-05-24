<?php 
header('Content-Type: application/json');


  // Подключитесь к базе данных
  include 'conectCOOKIE.php';
  
  // Получите данные из формы
  $id = $_POST['id'];
  $login = $_POST['login'];
  $password = $_POST['password'];
  $name = $_POST['name'];
  $surname = $_POST['surname'];
  $patronymic = $_POST['patronymic'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $account_type = $_POST['account_type'];
  
  


  // Выполните запрос на обновление информации о пользователе
  $sql = "UPDATE users SET `Login`='$login', `Password`='$password', `Name`='$name', `SName`='$surname', `PName`='$patronymic', `Email`='$email', `Phone`='$phone', `Account-type`='$account_type' WHERE `id`='$id'";

  $result = mysqli_query($mysql, $sql);

  // Верните результат в виде JSON
  echo json_encode(['success' => $result]);

