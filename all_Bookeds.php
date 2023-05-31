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
<?php include 'php_constructor/head.php'; ?>
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

    <script>
        showPopup(<?= "'" . $loc['Новая заявка оставлена успешно!'] . "'" ?>, 'error7');
    </script>
</body>

</html>