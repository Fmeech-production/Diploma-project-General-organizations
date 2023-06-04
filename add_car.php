<?php
require_once 'conectCOOKIE.php'; // Подключение к БД и проверка на авторизацию
$car_id = create_default_car($mysql);
// Перенаправление на страницу с информацией об автомобиле
header("Location: edit_car.php?car_id={$car_id}");


function create_default_car($mysql) {
    if ($_COOKIE['language'] == 'eng')
    include 'php_constructor/localization/localization_eng.php';
else
    include 'php_constructor/localization/localization_ru.php';

    // Вставка автомобиля со стандартными настройками в базу данных
    $default_license_plate = "A 000 AA 30";
    $default_make = $loc['Все заявки'];
    $default_model = $loc['Не указано']; 
    $default_year = "0000";
    $default_car_image = "1.jpg";

    $insert_query = $mysql->prepare("INSERT INTO cars (license_plate, make, model, year, car_image) VALUES (?, ?, ?, ?, ?)");
    $insert_query->bind_param('sssss', $default_license_plate, $default_make, $default_model, $default_year, $default_car_image);
    $insert_query->execute();
    $car_id = $insert_query->insert_id;

    // Создание папки с названием ID автомобиля
    $car_folder = "cars/{$car_id}";
    if (!file_exists($car_folder)) {
        mkdir($car_folder, 0777, true);
    }

    // Копирование стандартного изображения автомобиля в созданную папку
    $default_image_path = "cars/default_car.jpg";
    $new_image_path = "{$car_folder}/1.jpg";
    copy($default_image_path, $new_image_path);

    return $car_id;
}
