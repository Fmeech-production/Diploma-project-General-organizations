<?php
// перейти в родительскую директорию, относительно этой директории.
if (!defined('ROOT_DIR'))
	define('ROOT_DIR', realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR));
require_once(ROOT_DIR . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

use Fmeech2\ConnectSQL;

$drivers_id = $_POST['drivers_id'];
$car_id = $_POST['car_id'];

$mysqli = ConnectSQL::getStaticSQL();

if ($drivers_id == "")
	$mysqli->query("UPDATE cars SET drivers_id = CONCAT(drivers_id, '') WHERE id = '$car_id'");
else
	$mysqli->query("UPDATE cars SET drivers_id = CONCAT(drivers_id, '$drivers_id', ',') WHERE id = '$car_id'");

//Возвращаем список водителей, к которым привязана машина после добавления нового водителя




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

$drivers = $mysqli->query("SELECT * FROM users WHERE id IN ($drivers_idS)");
$end_string = "";
while ($driver = $drivers->fetch_object()) {
	$end_string .= "<div " .
		"data-id=" . '"' . $driver->id . '"' .
		">";
	$end_string .= "→ $driver->SName ";
	$end_string .= "$driver->Name ";
	$end_string .= "$driver->PName ";
	$end_string .= "</div>";
}
if ($end_string == "") {
	$end_string = "Для этого автомобиля нет добавленных водителей.";
}
echo $end_string;
