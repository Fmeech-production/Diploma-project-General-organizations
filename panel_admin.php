<?php include 'conectCOOKIE.php';   //Подключение к БД и проверка на авторизацию
if ($_COOKIE['language'] == 'eng')      //Подключение локализации
    include 'php_constructor/localization/localization_eng.php';
else
    include 'php_constructor/localization/localization_ru.php';
$Headline = $loc['Общие настройки'];   //Заголовок страницы
$nav_select = 1;    //Выбор активного пункта меню
?>

<!DOCTYPE html>
<html>

<head>
    <?php require_once 'php_constructor/head.php'; ?>
</head>



<body>
    <?php
    include 'php_constructor/nav.php';  //Подключение меню
    ?>
    <div class="wrap">
        <?php
        include 'php_constructor/header.php';   //Подключение шапки
        ?>
        <main style=""> <!-- Основной контент -->


            <form action="new-bronirovanie.php" method="post" class="mob_admin_panel">

                <div class="square-container">
                    <div class="square" onclick="open_edit_admin('popup-admin','backgroung-black-active','iframe-admin')">
                        <div class="icon">
                            <img class="icon-admin" src="icons/office1.png">
                            <div class="text">Отделения и кабинеты</div>
                        </div>
                    </div>
                    <div class="square" onclick="open_edit_admin('popup-admin4','backgroung-black-active4','iframe-admin4')">
                        <div class="icon">
                            <img class="icon-admin" src="icons/list_of_topics2.png">
                            <div class="text">Редактор мини-тем</div>
                        </div>
                    </div>
                    <div class="square" onclick="open_edit_admin('popup-admin2','backgroung-black-active2','iframe-admin2')">
                        <div class="icon">
                            <img class="icon-admin icon-admin2" src="icons/lock1.png">
                            <div class="text">Секретный ключ</div>
                        </div>
                    </div>
                </div>
                <div class="square-container">
                    <!--
                        <div class="square">
                        <div class="icon">
                            <img class="icon-admin icon-admin2" src="icons/chat1.png">
                            <div class="text">Уведомления</div>
                        </div>
                    </div>
                    -->
                    <div class="square" onclick="open_edit_admin('popup-admin3','backgroung-black-active3','iframe-admin3')">
                        <div class="icon">
                            <img class="icon-admin icon-admin2" src="icons/privacy_policy1.png">
                            <div class="text">Политика конфиденциальности</div>
                        </div>
                    </div>
                </div>

                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />




 
            </form>


            <?php
            //Подключение открывающихся окон
            setIframe("admin_panel/department.php", "");
            setIframe("admin_panel/TheSecretKey.php", 2);
            setIframe("admin_panel/PrivacyPolicy.php", 3);
            setIframe("admin_panel/TopicsForConfirmation.php", 4);
            /**
             * Функция для вставки iframe
             * @param $url - ссылка на страницу
             * @param $number - Уникальный любой номер iframe
             */
            function setIframe($url, $number)
            { ?>
                <div id="popup-admin<?= $number ?>" class="popup-admin">
                    <div class="popup-admin-content">
                        <div class="backgroung-black-active" id="backgroung-black-active<?= $number ?>" onclick="exzit_edit_admin('popup-admin<?= $number ?>','backgroung-black-active<?= $number ?>','iframe-admin<?= $number ?>')"></div> <!-- Затемнёный фон для редактора аватарки-->
                        <iframe id="iframe-admin<?= $number ?>" src="<?= $url ?>"></iframe>
                        <button id="close-popup-admin" class="close-popup-admin">
                            <img src="icons/close.png" class="close-new-ava" onclick="exzit_edit_admin('popup-admin<?= $number ?>','backgroung-black-active<?= $number ?>','iframe-admin<?= $number ?>')"> <!-- Кнопка закрытия редактора -->
                        </button>
                    </div>
                </div>
            <?php }
            ?>

            <script>
                //Функция открытия попапа
                function open_edit_admin(popupID, backgroungBlackActiveID, iframeAdminID) {
                    var popup_admin = document.getElementById(popupID);
                    var backgroung_black_active = document.getElementById(backgroungBlackActiveID);
                    var popup_content = document.getElementById(iframeAdminID);
                    popup_admin.style.display = "block";
                    popup_content.style.animation = "popupSlideUp 0.3s ease-in-out forwards";
                    backgroung_black_active.style.animation = "appear 0.5s ease-in-out forwards";
                };
                //Функция закрытия попапа
                function exzit_edit_admin(popupID, backgroungBlackActiveID, iframeAdminID) {
                    var popup_admin = document.getElementById(popupID);
                    var backgroung_black_active = document.getElementById(backgroungBlackActiveID);
                    var popup_content = document.getElementById(iframeAdminID);
                    popup_content.style.animation = "popupSlideDown 0.3s ease-in-out forwards";
                    backgroung_black_active.style.animation = "disappear 0.5s ease-in-out forwards";
                    setTimeout(function() {
                        popup_admin.style.display = "none";
                    }, 300);
                }
            </script>


        </main>
    </div>
    <script>
        showPopup(<?= "'" . $loc['Новая заявка оставлена успешно!'] . "'" ?>, 'error7');
    </script>





</body>

</html>