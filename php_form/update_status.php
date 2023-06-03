<?php
include '../conectCOOKIE.php'; // Подключение к БД и проверка на авторизацию

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_booking = $_POST['id'];
    $status = $_POST['status'];

    $sql = "UPDATE topics SET Statys = $status WHERE id = $id_booking";
    if (mysqli_query($mysql, $sql)) {
        echo "Значение поля Statys успешно обновлено на $status!";
    } else {
        echo "Ошибка при обновлении значения поля Statys: " . mysqli_error($mysql);
    }

    mysqli_close($mysql);
}
?>
