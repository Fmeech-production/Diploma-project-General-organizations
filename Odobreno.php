<?php   //Одобрение бронирования
ob_start(); // Включаем буферизацию вывода
include 'conectCOOKIE.php';
$id = $_POST['id'];
$Start_time = isset($_POST['Start_time']) ? $_POST['Start_time'] : 0;
$End_time = isset($_POST['End_time']) ? $_POST['End_time'] : 0;
$Assigned_Start_time = isset($_POST['Assigned_Start_time']) ? $_POST['Assigned_Start_time'] : 0;
$Finish_Start_time = isset($_POST['Finish_Start_time']) ? $_POST['Finish_Start_time'] : 0;
$driver_id = isset($_POST['drivers']) ? $_POST['drivers'] : null;
$car_id = isset($_POST['cars']) ? $_POST['cars'] : 0;
include_once 'php_constructor' . DIRECTORY_SEPARATOR . 'library.php';
$BookingLog = new BookingLog($mysql);

//Если нажата кнопка "Одобрить" заявку на бронирование, нажимается - сотрудником ахч
if (isset($_POST['submit2'])) {

	$результат = $mysql->query("UPDATE `booking` SET
`Statys` = '2',
`driver_id` = '$driver_id',
`car_id` = '$car_id',
`Assigned_Start_time` = '$Start_time'
WHERE `booking`.`id` = '$id'");

	//Добавление записи в логи
	$BookingLog->addLog($id, "Одобрил заявку на бронирование", $user['id']);
}
//Если нажата кнопка Подтвердить "Уже после окончания поездки", нажимается - водителем
elseif (isset($_POST['submit3'])) {

	$результат = $mysql->query("UPDATE `booking` SET
    `Statys` = '3', 
 `Finish_Start_time` = '$Finish_Start_time', 
 `End_time` = '$End_time'
    WHERE `booking`.`id` = '$id'");

	//Добавление записи в логи
	$BookingLog->addLog($id, "Подтверждено прибытие автомобиля с $Finish_Start_time по $End_time", $user['id']);
}
//Если нажата кнопка "Отклонить" заявку на бронирование
elseif (isset($_POST['submit4'])) {

	$результат = $mysql->query("UPDATE `booking` SET
        `Statys` = '4'
        WHERE `booking`.`id` = '$id'");

	//Добавление записи в логи
	$BookingLog->addLog($id, "Отклонил заявку на бронирование", $user['id']);
}






header('Location: /');
exit();
