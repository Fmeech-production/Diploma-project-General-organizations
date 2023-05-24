<?php include 'conectCOOKIE.php';
if ($_COOKIE['language'] == 'eng')
    include 'php_constructor/localization/localization_eng.php';
else
    include 'php_constructor/localization/localization_ru.php';


$Headline = $loc['Все заявки'];
$nav_select = 2.5;


?>
<!DOCTYPE html>
<html>

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    <link rel="stylesheet" href="css/CSSep_mobail.css">
</head>




<body>



    <?php
    include 'php_constructor/nav.php';
    ?>

    <div class="wrap">

    <?php
        include 'php_constructor/header.php';   // Подключение шапки
        include 'php_constructor/table.php';   // Подключение таблицы
        table("SELECT * FROM `booking` ORDER BY `booking`.`id` DESC" , $mysql);   // Вывод таблицы со ВСЕМИ заявками
        ?>   
    </div>

    <script src="js/constructor.js">
    </script>
    <script>
        showPopup(<?= "'" . $loc['Новая заявка оставлена успешно!'] . "'" ?>, 'error7');
    </script>
</body>

</html>