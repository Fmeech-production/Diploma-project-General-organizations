<?php
// перейти в родительскую директорию, относительно этой директории.
if (!defined('ROOT_DIR'))
	define('ROOT_DIR', realpath(__DIR__ . './../'));
// подключаем файл класса PHPMailer
require_once(ROOT_DIR . '\vendor\autoload.php');

use Fmeech2\ConnectSQL;

$driverId = $_POST['driverId'];
$car_id = $_POST['car_id'];

if (!is_numeric($driverId)) 
	// $driverId не является числом
	exit();


$mysqli = ConnectSQL::getStaticSQL();
// Обновляем список водителей в базе данных
$mysqli->query("UPDATE cars SET drivers_id = REPLACE(drivers_id, ',$driverId,', ',') WHERE id = '$car_id'");



$result = $mysqli->query("SELECT * FROM cars WHERE id = '$car_id'");
$drivers_idS = $result->fetch_object()->drivers_id;
//Удаляем запятую в начале
if (substr($drivers_idS, 0, 1) == ",") {
	$drivers_idS = substr_replace($drivers_idS, "", 0, 1);
}
//Удаляем запятую в в конце
if (substr($drivers_idS, -1) == ",") {
	$drivers_idS = substr_replace($drivers_idS, "", -1);
}



// Возвращаем список водителей, к которым привязана машина после удаления водителя
$drivers = $mysqli->query("SELECT * FROM users WHERE id IN ($drivers_idS)");
$end_string = "";
if (!$drivers) {
	echo "Для этого автомобиля нет добавленных водителей.";
	exit();
}
while ($driver = $drivers->fetch_object()) {
	$end_string .= "<div title='Удалить водителя для этой машины: $driver->SName $driver->Name $driver->PName' data-id='$driver->id'>";
	$end_string .= "→ $driver->SName ";
	$end_string .= "$driver->Name ";
	$end_string .= "$driver->PName ";
	$end_string .= "</div>";
}
if ($end_string == "") {
	$end_string = "Для этого автомобиля нет добавленных водителей.";
}
echo $end_string;
