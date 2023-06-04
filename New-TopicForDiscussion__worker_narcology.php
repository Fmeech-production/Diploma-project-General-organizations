<?php   //Создание новой заявки о неисправности
ob_start(); // Включаем буферизацию вывода
if (!defined('ROOT_DIR'))
  define('ROOT_DIR', realpath(__DIR__));
require_once(ROOT_DIR . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');


use Fmeech2\ConnectSQL;
use Fmeech2\ConnectCOOKIE;
use Fmeech2\Mail;

include 'conectCOOKIE.php';   //Подключение к БД и проверка на авторизацию<?php


// Получаем данные из формы
$problem_description = $_POST['problem-description'];
$topic = $_POST['topic'];
$department_id = $_POST['department_id'];
$room_id = $_POST['room_id'];

// Получаем текущую дату и время в формате, который будет храниться в БД
$current_time = date("Y-m-d H:i:s");


// Сохраняем данные в БД
$sql = "INSERT INTO topics (sender_id, date, description, mini_topic, department_id, room_id, new_message) VALUES ('$userId', '$current_time', '$problem_description', '$topic', '$department_id', '$room_id', '$problem_description')";
$result = $mysql->query($sql);

	//Отправка письма всем работягам
	Mail::PUSHmessByStatus_2("Новая заявка: $problem_description (Тематика проблемы: $topic, Отделение: $department_id, Кабинет $room_id)", 2);

if ($result) {
  // Данные успешно сохранены
  echo "Заявка успешно отправлена!";
} else {
  // Произошла ошибка
  echo "Ошибка при отправке заявки: " . $mysql->error;
}

// Закрываем соединение с БД
$mysql->close();


header('Location: /TopicForDiscussion__worker_narcology.php?error=error7');
