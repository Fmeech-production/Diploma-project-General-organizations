<?php include 'conectCOOKIE.php';   //Подключение к БД и проверка на авторизацию Я ХОЧУ УДАЛИТЬ ЭТОТ ФАИЛ, ВЕДЬ СКОРЕЕ ВСЕГО ЭТО ПОЛНАЯ КОПИЯ panel_worker_narcology.php
if ($_COOKIE['language'] == 'eng')      //Подключение локализации
    include 'php_constructor/localization/localization_eng.php';
else
    include 'php_constructor/localization/localization_ru.php';
$Headline = $loc['Бронирование'];   //Заголовок страницы
$nav_select = 1;    //Выбор активного пункта меню
?>
<!DOCTYPE html>
<html>

<head>
    <?php include 'php_constructor/head.php'; ?>
</head>

<body>
    <?php
    include 'php_constructor/nav.php';  //Подключение меню
    ?>
    <div class="wrap">
        <?php
        include 'php_constructor/header.php';   //Подключение шапки
        ?>
        <main> <!-- Основной контент -->
            <form action="new-bronirovanie.php" method="post">
                <lable class="main-lable">Место отправления</lable>
                <input class="main-inpyt" name="Start_road" placeholder="Можете оставить это поле пустым, если собираетесь ехать из наркологии">
                <lable class="main-lable">Куда едим?</lable>
                <input class="main-inpyt" name="End_road" placeholder="Можете оставить это поле пустым, если собираетесь приехать в наркологию">
                <lable class="main-lable">Дата отправки?</lable>
                <input class="main-inpyt" name="Day" placeholder="Можете оставить это поле пустым, если собираетесь ехать сегодня" type="date" required>
                <div class="razdelitel">
                    <div class="left">
                        <lable class="main-lable">Планируемое время отъезда</lable>
                        <input class="main-inpyt main-inpyt2" name="Start_time" placeholder="" type="time" min="06:00" max="18:00" required>
                    </div>
                    <div class="right">
                        <lable class="main-lable">Когда планируете прибыть?</lable>
                        <input class="main-inpyt main-inpyt2" name="End_time" placeholder="" type="time" min="06:00" max="18:00" required>
                    </div>
                </div>
                <lable class="main-lable">Планируемое количество человек</lable>
                <input class="main-inpyt" name="Number_people" placeholder="Можете оставить это поле пустым, если едите в одиночку">
                <button class="form-btn">Оставить заявку</button>
            </form>
        </main>
    </div>
    <script>
        showPopup(<?= "'" . $loc['Новая заявка оставлена успешно!'] . "'" ?>, 'error7');
    </script>
</body>

</html>