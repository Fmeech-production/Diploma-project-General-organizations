<?php
require_once 'conectCOOKIE.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $car_id = $_POST['car_id'];
    $make = $_POST['make'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $license_plate = $_POST['license_plate'];

    $update_query = $mysql->query("UPDATE cars SET make = '$make', model = '$model', year = '$year', license_plate = '$license_plate' WHERE id = '$car_id'");

    // перенаправить на страницу с информацией об автомобиле:
    header("Location: /edit_car.php?error=error10&car_id={$car_id}");
    exit();
}
