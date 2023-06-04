<?php
ob_start(); // Включаем буферизацию вывода
if (!defined('ROOT_DIR'))
    define('ROOT_DIR', realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR));
require_once(ROOT_DIR . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');


use Fmeech2\ConnectSQL;
use Fmeech2\Mail;

include '../conectCOOKIE.php'; // Подключение к БД и проверка на авторизацию

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_booking = $_POST['id'];
    $status = $_POST['status'];

    $sql = "UPDATE topics SET Statys = $status WHERE id = $id_booking";
    if (mysqli_query($mysql, $sql)) {
        echo "Значение поля Statys успешно обновлено на $status!";
        $topic = $mysql->query("SELECT * FROM topics WHERE id = $id_booking");
        if ($topic) {
            $topicData = $topic->fetch_object();
            $userIDtopic = $topicData->sender_id;
            if ($status == 3)
                Mail::PUSHmessById_2($userIDtopic, "Одна из ваших заявок была успешно завершена!");
            else if ($status == 4)
                Mail::PUSHmessById_2($userIDtopic, "Одна из ваших заявок была ОТКЛОНЕНА!");
        }
    } else {
        echo "Ошибка при обновлении значения поля Statys: " . mysqli_error($mysql);
    }

    mysqli_close($mysql);
}
