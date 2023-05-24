<?php include 'conectCOOKIE.php';
if ($_COOKIE['language'] == 'eng')
    include 'php_constructor/localization/localization_eng.php';
else
    include 'php_constructor/localization/localization_ru.php';

$id_booking = $_GET['id'];
$результатЗаявок = $mysql->query("SELECT * FROM `booking` WHERE `id` = '$id_booking'");
$Заявка = $результатЗаявок->fetch_assoc();

$Headline = "Заявка ".substr($Заявка['Day'],8,2).".".substr($Заявка['Day'],5,2) . " в " . $Заявка['Start_time'] ;
if ($user['Account-type'] == 0) {
    $nav_select = 2;
} else if ($user['Account-type'] == 1) {
    $nav_select = 2.5;
} else if ($user['Account-type'] == 2) {
    $nav_select = 2;
} else if ($user['Account-type'] == 3) {
    $nav_select = 2.5;
}
//Функция substr имеет параметры: строка, начало, конец





?>
<!DOCTYPE html>
<html>

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta charset="utf-8">
    <title><?= $Headline ?> </title>
    <link rel="stylesheet" href="css/CSSep.css">
    <link rel="stylesheet" href="css/CSSbti.css">
    <link rel="stylesheet" href="css/css-all.css">
    <link rel="stylesheet" href="css/My_framevorke.css">
    <?php if ($_COOKIE['isDarkMode'] == "true")
        echo '<link rel="stylesheet" href="css/CSSep_Dark.css">';
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="icons/logo1.png">
    <link rel="stylesheet" href="css/CSSep_mobail.css?t=<?php echo(microtime(true).rand()); ?>">
</head>




<body>



    <?php
    include 'php_constructor/nav.php';
    ?>

    <div class="wrap">

        <?php
        include 'php_constructor/header.php';
        ?>

        <main class="card mob_scroll">

            <?

            if ($Заявка['Statys'] == 1) {
                $statys_text = "На рассмотрении";
                $img_patch = "icons/consideration1.png";
                $color_circle = "color-icons-grey";
            } else if ($Заявка['Statys'] == 2) {
                $statys_text = "Одобрена";
                $img_patch = "icons/confirmed1.png";
                $color_circle = "color-icons-green";
            } else if ($Заявка['Statys'] == 3) {
                $statys_text = "Завершена";
                $img_patch = "icons/completed1.png";
                $color_circle = "color-icons-blue";
            } else if ($Заявка['Statys'] == 4) {
                $statys_text = "Отклонена";
                $img_patch = "icons/rejected2.png";
                $color_circle = "color-icons-red";
            }
            ?>
            <div class="zaivka-stroka">
                <div class="zaivka-lable-card">Место отправки:</div>
                <div class="zaivka-info-card"> <?= $Заявка['Start_road'] ?></div>
            </div>
            <div class="zaivka-stroka">
                <div class="zaivka-lable-card">Место прибытия:</div>
                <div class="zaivka-info-card"> <?= $Заявка['End_road'] ?></div>
            </div>
            <div class="zaivka-stroka">
                <div class="zaivka-lable-card">Дата отправки:</div>
                <div class="zaivka-info-card"> <?= substr($Заявка['Day'],8,2).".".substr($Заявка['Day'],5,2).".".substr($Заявка['Day'],0,4) ?></div>
            </div>
            <div class="zaivka-stroka">
                <div class="zaivka-lable-card">Время отправки:</div>
                <div class="zaivka-info-card"> <?= $Заявка['Start_time'] ?></div>
            </div>
            <div class="zaivka-stroka">
                <div class="zaivka-lable-card">Время возвращения:</div>
                <div class="zaivka-info-card"> <?= $Заявка['End_time'] ?></div>
            </div>
            <div class="zaivka-stroka">
                <div class="zaivka-lable-card">Количество пассажиров:</div>
                <div class="zaivka-info-card"> <?= $Заявка['Number_people'] ?></div>
            </div>
            <div class="zaivka-stroka">
                <div class="zaivka-lable-card">Статус заявки:</div>
                <div class="zaivka-info-card"> <?= $statys_text ?></div>
            </div>

            <?php if ($user['Account-type'] == 0) { ?>
                <button class="form-btn" onclick="window.location.href = 'BookedTrips_worker_narcology.php';">Назад</button>
            <?php } else if ($user['Account-type'] == 1) { ?>
                <button class="form-btn" onclick="window.location.href = 'active_routes__HeadOfFacilities.php';">Назад</button>
            <?php } else if ($user['Account-type'] == 2) { ?>
                <button class="form-btn" onclick="window.location.href = 'BookedTrips_worker_narcology.php';">Назад</button>
            <?php } else if ($user['Account-type'] == 3) { ?>
                <button class="form-btn" onclick="window.location.href = 'active_routes__HeadOfFacilities.php';">Назад</button>
            <?php } ?>



        </main>
    </div>

    <script src="js/constructor.js"></script>
</body>

</html>