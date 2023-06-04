<?php //отправка сообщения
ob_start(); // Включаем буферизацию вывода
if (!defined('ROOT_DIR'))
	define('ROOT_DIR', realpath(__DIR__));
require_once(ROOT_DIR . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');


use Fmeech2\ConnectSQL;
use Fmeech2\ConnectCOOKIE;
use Fmeech2\Mail;

include 'conectCOOKIE.php';

//получение данных из формы
$userId = $user['id'];
$message = $_POST['message'];
$id_topics = $_POST['id_topics'];
$time = date("Y-m-d H:i:s");

//добавление нового сообщения в бд
$mysql->query("INSERT INTO `topics_messages` (`user_id`, `message`, `id_topics`, `time`) VALUES ('$userId', '$message', '$id_topics', '$time')");

if ($user['Account-type'] == 0)
	//Изменение времени написания последнего сообщения И статус не прочитанного работягами, после того как сотрудник написал своё сообщение
	$mysql->query("UPDATE topics SET `date` = '$time', `Statys` = 1, `new_message` = '$message' WHERE id = $id_topics");
else
	//Изменение времени написания последнего сообщения
	$mysql->query("UPDATE topics SET `date` = '$time', `new_message` = '$message' WHERE id = $id_topics");

if ($user['Account-type'] == 0) {
	//Отправка письма всем работягам от обычных пользователей
	Mail::PUSHmessByStatus_1("Новое сообщение: $message", 2);
} else if ($user['Account-type'] == 2) {
	$topic = $mysql->query("SELECT * FROM topics WHERE id = $id_topics");
	if ($topic) {
		$topicData = $topic->fetch_object();
		$userIDtopic = $topicData->sender_id;
		Mail::PUSHmessById_2($userIDtopic, "Новое сообщение: $message");
	}
}


//переадресация на страницу с темой
header('Location: /BookedTopic_Information_worker_narcology.php?&id=' . $id_topics);
