<?php include '../conectCOOKIE.php';   //Подключение к БД и проверка на авторизацию
if ($_COOKIE['language'] == 'eng')      //Подключение локализации
    include '../php_constructor/localization/localization_eng.php';
else
    include '../php_constructor/localization/localization_ru.php';

    //Редактирование политики конфиденциальности лежащей в БД в таблице admin-panel, в строке с id = 1, в поле "PrivacyPolicy"
    if (isset($_POST['NewPrivacyPolicy'])) {
        $key_new =  $_POST['NewPrivacyPolicy'];


        $sql = "UPDATE `admin-panel` SET `PrivacyPolicy` = '$key_new' WHERE `admin-panel`.`id` = 1";
        mysqli_query($mysql, $sql);
        // Закрытие соединения с базой данных
        mysqli_close($mysql);
        echo "Политика конфиденциальности успешно изменена!";
    }