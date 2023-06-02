<?php
ob_start(); // Включаем буферизацию вывода
if (isset($_FILES['car_cover'])) {
  // файл был отправлен    
  $range_img = (100+$_POST['range_img'])/100;

  require_once '../conectCOOKIE.php';

  $id = $_POST['car_id']; //id автомобиля


  $name_fale = rand();
  $name_fale = $name_fale . '.jpg';
  $path = '../cars/' . $id . '/' . $name_fale;

  if (move_uploaded_file($_FILES['car_cover']['tmp_name'], $path)) {

    echo $_FILES["car_cover"]["name"] . ' успешно загружен';
    $mysql->query("UPDATE `cars` SET 
`car_image` = '$name_fale'
WHERE `cars`.`id` = '$id'");
  } else {
    echo 'Ошибка загрузки файла';
  }

  header('Location: /edit_car.php?error=error10&car_id='. $car_id);
}













