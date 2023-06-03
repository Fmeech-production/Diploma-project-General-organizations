<?php //отправка сообщения
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

//переадресация на страницу с темой
header('Location: /BookedTopic_Information_worker_narcology.php?&id=' . $id_topics);
