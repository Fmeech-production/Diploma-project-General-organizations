<?php //отправка сообщения
include 'conectCOOKIE.php';

//получение данных из формы
$userId = $user['id'];
$message = $_POST['message'];
$id_topics = $_POST['id_topics'];
$time = date("Y-m-d H:i:s");

//добавление нового сообщения в бд
$mysql->query("INSERT INTO `topics_messages` (`user_id`, `message`, `id_topics`, `time`) VALUES ('$userId', '$message', '$id_topics', '$time')");

//переадресация на страницу с темой
header('Location: /BookedTopic_Information_worker_narcology.php?&id=' . $id_topics);
