<?php
require_once '../conectCOOKIE.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['car_id'])) {
    $car_id = intval($_POST['car_id']);

    // Удаление автомобиля из базы данных
    $delete_query = $mysql->prepare("DELETE FROM cars WHERE id = ?");
    $delete_query->bind_param('i', $car_id);
    $delete_query->execute();

    header("Location: ../cars_list.php");
    exit();
} else {
    header("Location: ../cars_list.php");
    exit();
}
?>
 