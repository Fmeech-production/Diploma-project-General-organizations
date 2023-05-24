<?php
require_once 'conectCOOKIE.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

$user_id = $_POST['user_id'];
$car_id = $_POST['car_id'];
$driver_id = $_POST['driver_id'];

if ($user_id && $car_id) {
  // Если были выбраны и водитель и машина, то обновляем информацию водителя и привязываем его к выбранной машине
  $update_query = $mysql->query("UPDATE drivers SET user_id = '$user_id', car_id = '$car_id' WHERE id = '$driver_id'");
} elseif ($user_id) {
  // Если был выбран только водитель, то обновляем информацию водителя без изменения машины
  $update_query = $mysql->query("UPDATE drivers SET user_id = '$user_id' WHERE id = '$driver_id'");
} elseif ($car_id) {
  // Если была выбрана только машина, то обновляем информацию машины без изменения водителя
  $update_query = $mysql->query("UPDATE drivers SET car_id = '$car_id' WHERE id = '$driver_id'");
}

// перенаправить на страницу с информацией о водителе:
header("Location: /edit_driver.php?error=error10&driver_id={$driver_id}");
exit();
}
