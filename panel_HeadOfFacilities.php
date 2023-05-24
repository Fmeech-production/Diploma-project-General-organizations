<?php include 'conectCOOKIE.php';       // Подключение к БД и проверка на авторизацию
if ($_COOKIE['language'] == 'eng')  // Подключение локализации
    include 'php_constructor/localization/localization_eng.php';
else
    include 'php_constructor/localization/localization_ru.php';
$Headline = $loc['Новые заявки'];   // Заголовок страницы
$nav_select = 1;               // Выбор активного пункта меню
if ($user['Account-type'] == 2)
    $nav_select = 2.6;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title><?= $Headline ?> </title>
    <link rel="stylesheet" href="css/CSSep.css">
    <link rel="stylesheet" href="css/CSSpa.css">
    <link rel="stylesheet" href="css/css-all.css">
    <link rel="stylesheet" href="css/My_framevorke.css">
    <?php if ($_COOKIE['isDarkMode'] == "true")
        echo '<link rel="stylesheet" href="css/CSSep_Dark.css">';
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="icons/logo1.png">
    <link rel="stylesheet" href="css/CSSep_mobail.css?t=<?php echo (microtime(true) . rand()); ?>"> <!-- Подключение стилей для мобильных устройств -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Подключение jQuery -->
    <script src="js/constructor.js"></script> <!-- Подключение скриптов для работы popup -->

</head>

<body>
    <?php
    include 'php_constructor/nav.php';  // Подключение меню
    ?>
    <div class="wrap">
        <?php
        include 'php_constructor/header.php';   // Подключение шапки
        include 'php_constructor/table.php';   // Подключение таблицы
        table("SELECT * FROM `booking` WHERE `Statys` = '1' ORDER BY `booking`.`id` DESC", $mysql);    // Вывод таблицы с заявками в которых статус "Новая"
        ?>
    </div>
    <script>
        showPopup(<?= "'" . $loc['Новая заявка оставлена успешно!'] . "'" ?>, 'error7');
    </script>
</body>

</html>