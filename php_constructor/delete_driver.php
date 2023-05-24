<?php
require_once '../conectCOOKIE.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['driver_id'])) {
    $driver_id = intval($_POST['driver_id']);

    // Удаление автомобиля из базы данных
    $delete_query = $mysql->prepare("DELETE FROM drivers WHERE id = ?");
    $delete_query->bind_param('i', $driver_id);
    $delete_query->execute();

    header("Location: ../drivers_list.php");
    exit();
} else {
    header("Location: ../drivers_list.php");
    exit();
}
?>
