<?php error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'conectCOOKIE.php'; // Подключение к БД и проверка на авторизацию
if ($_COOKIE['language'] == 'eng')  // Проверка на язык
    include 'php_constructor/localization/localization_eng.php';    // Подключение файла с переводом на английский
else
    include 'php_constructor/localization/localization_ru.php';     // Подключение файла с переводом на русский
$Headline = $loc['Автомобили'];    // Заголовок страницы
$nav_select = 2.2;    // Выбор активного пункта меню
?>
<!DOCTYPE html>
<html>

<head>
    <?php require_once 'php_constructor/head.php'; ?>
</head>

<body>
    <?php
    include 'php_constructor/nav.php';  // Подключение меню
    ?>
    <div class="wrap"> <!-- Обертка для контента -->
        <?php
        include 'php_constructor/header.php';   // Подключение шапки
        ?>
        <main> <!-- Основной контент -->


            <form action="add_car.php" method="post" style="width: 100%;">
                <button type="submit" class="add_car_btn">
                    <?php echo $loc['Добавить автомобиль']; ?>
                </button>
            </form>

            <?php
            $cars_query = $mysql->query("SELECT * FROM cars");
            while ($car = $cars_query->fetch_assoc()) {
            ?>
                <div class="car_block" onclick="window.location.href = 'edit_car.php?car_id=<?= $car['id'] ?>';">
                    <div class="car_image__wrapper">
                        <img src="cars/<?php echo $car['id']; ?>/<?php echo $car['car_image']; ?>" alt="фото автомобиля" class="cover">
                    </div>
                    <div class="right_text_car">
                        <h2 class="car_make"><?= $car['make'] . ' ' . $car['model'] ?></h2>
                        <p class="car_year">Год выпуска: <?= $car['year'] ?></p>
                        <div class="car_license_plate"><div>Регистрационный номер: </div><div><?= $car['license_plate'] ?></div>
                        </div>
                    </div>
                </div>

            <?php
            }
            ?>


        </main>
    </div>
    <script>
        showPopup('<?= $loc['Profile_data_has_been_successfully_updated'] ?>', 'error6'); // Вывод сообщения об успешном изменении данных профиля
    </script>
</body>

</html>