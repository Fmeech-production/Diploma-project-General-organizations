<?php
require_once 'conectCOOKIE.php'; // Подключение к БД и проверка на авторизацию
$driver_id = create_default_driver($mysql);
// Перенаправление на страницу с информацией об водителе
header("Location: edit_driver.php?car_id={$driver_id}");

/**
 * Создание водителя по умолчанию
 * 
 * @param mysqli $mysql подключение к БД
 * @return int возвращает id созданного водителя
 */
function create_default_driver($mysql) {
    // Вставка водителя по умолчанию
    
    $insert_query = $mysql->prepare("INSERT INTO drivers () VALUES ()");
    $insert_query->execute();
    $driver_id = $mysql->insert_id;

    return $driver_id;
}
