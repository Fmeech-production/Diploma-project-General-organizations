<?php

if (!defined('ROOT_DIR'))
	define('ROOT_DIR', realpath(__DIR__));
require_once(ROOT_DIR . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

use Fmeech2\Mail;
use Fmeech2\ConnectSQL;
use Fmeech2\ConnectCOOKIE;

ob_start(); // Включаем буферизацию вывода

//Создание нового бронирования
$Start_road = $_POST['Start_road'];
$End_road = $_POST['End_road'];
$Day = $_POST['Day'];
$Start_time = $_POST['Start_time'];
$End_time = isset($_POST['End_time']) ? $_POST['End_time'] : 0;
$Number_people = $_POST['Number_people'];
$Time_of_change = time();
$notes = $_POST['notes'];
$telephone = $_POST['telephone'];
include_once 'php_constructor' . DIRECTORY_SEPARATOR . 'library.php';


if (trim($Start_road) == "") $Start_road = "Наркология";
if (trim($End_road) == "") $End_road = "Наркология";
if (trim($Number_people) == "") $Number_people = "1";
if (trim($End_time) == "") $End_time = "0";


$user = ConnectCOOKIE::start_session();
$mysql = ConnectSQL::getStaticSQL();
$BookingLog = new BookingLog($mysql);
$userId = $user->id;

if (trim($telephone) == "") $telephone = $user->Phone;


$result = $mysql->query("INSERT INTO `booking` (`IdUser`, `Start_road`, `End_road`, `Day`, `Start_time`, `End_time`, `Number_people`, `Time_of_change`, `notes`, `telephone`) VALUES ('$userId', '$Start_road', '$End_road', '$Day', '$Start_time', '$End_time', '$Number_people', '$Time_of_change', '$notes', '$telephone')");

if ($result) {

	// ID новой созданной заявки (insert_id Возвращает значение, созданное для столбца AUTO_INCREMENT последним запросом)
	$id = $mysql->insert_id;

	//Преобразование даты в формат дд.мм.гггг
	$Day = date('d.m.y', strtotime($Day));

	//Добавление записи в логи
	$BookingLog->addLog($id, "Заявку на бронирование была создана ($Day в $Start_time c примечанием $notes)", $user->id);

	//Поиск Работяг ачх
	//$rabotaga_userS = $mysql->query("SELECT * FROM `users` WHERE `Account-type`= 4");
	//while ($admin = $rabotaga_userS->fetch_object()) {
	//	//Отправка письма по почте
	//	Mail::PUSHmess($admin->Email, "Заявку на бронирование была создана ($Day в $Start_time c примечанием '$notes') Телефон: $telephone");
	//}
	//Если всё будет работать или ты уже забудешь, что значат строки комментариев выше, значит удали их. Не засоряй	код.

	//Отправка письма всем работягам
	Mail::PUSHmessByStatus("Заявку на бронирование была создана ($Day в $Start_time c примечанием '$notes') Телефон: $telephone", 2);
}

header('Location: /?error=error7');