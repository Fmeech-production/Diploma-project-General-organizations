<?php error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'conectCOOKIE.php'; // Подключение к БД и проверка на авторизацию
if ($_COOKIE['language'] == 'eng')  // Проверка на язык
    include 'php_constructor/localization/localization_eng.php';    // Подключение файла с переводом на английский
else
    include 'php_constructor/localization/localization_ru.php';     // Подключение файла с переводом на русский
$Headline = $loc['Водители'];    // Заголовок страницы
$nav_select = 2.3;    // Выбор активного пункта меню
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

            <form action="add_driver.php" method="post" style="width: 100%;">
                <button type="submit" class="add_car_btn">
                    <?php echo $loc['Добавить водителя']; ?>
                </button>
            </form>

            <?php
            $sql = "SELECT  drivers.*, users.*, cars.*, drivers.id as id
                        FROM drivers
                        LEFT JOIN users ON drivers.user_id = users.id
                        LEFT JOIN cars ON drivers.car_id = cars.id";
            $drivers = $mysql->query($sql);
            while ($driver = $drivers->fetch_assoc()) {
            ?>
                <div class="car_block" onclick="window.location.href = 'edit_driver.php?driver_id=<?= $driver['id'] ?>';">
                    <div class="car_image__wrapper">
                        <img src="<?php echo get_avatar_id($driver['user_id']) ?>" alt="фото автомобиля" class="cover" style="background-color: rgb(89,174,225);">
                        <img src="cars/<?php echo $driver['car_id']; ?>/<?php echo $driver['car_image']; ?>" alt="фото автомобиля" class="cover"
                        <?php if ($driver['car_id'] == null) echo 'style="display: none;"';
                        ?>
                        >
                    </div>
                    <div class="right_text_car">
                        <h2 class="car_make"><?= $driver['SName'] . ' ' . $driver['Name'] . ' ' . $driver['PName'] ?></h2>
                        <p class="car_year"><?php echo $driver['make']; ?></p>
                        <div class="car_license_plate"><div>Регистрационный номер: </div><div><?= $driver['license_plate'] ?></div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>


            <style>
.car_image__wrapper {
    position: relative;
    width: 40%;
    height: 150px;
    border-radius: 10px 0 0 10px;
    overflow: hidden;
}

.car_image__wrapper img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    transition: all 0.3s ease;
}

.car_image__wrapper img:first-child {
    /*clip-path: polygon(0 0, 100% 0, 0 100%);*/
    z-index: 1;
}
.car_block:hover img:first-child {
    opacity: 0;
}

            </style>
        </main>
    </div>
    <script>
        showPopup('<?= $loc['Profile_data_has_been_successfully_updated'] ?>', 'error6'); // Вывод сообщения об успешном изменении данных профиля
    </script>
</body>

</html>