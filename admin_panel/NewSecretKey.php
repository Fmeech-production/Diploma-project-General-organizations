<?php include '../conectCOOKIE.php';   //Подключение к БД и проверка на авторизацию
if ($_COOKIE['language'] == 'eng')      //Подключение локализации
    include '../php_constructor/localization/localization_eng.php';
else
    include '../php_constructor/localization/localization_ru.php';

    //Редактирование секретного ключа лежащего в БД в таблице admin-panel, в строке с id = 1, в поле "TheSecretKey"
    if (isset($_POST['NewKey'])) {
        $key_new =  $_POST['NewKey'];


        $sql = "UPDATE `admin-panel` SET `TheSecretKey` = '$key_new' WHERE `admin-panel`.`id` = 1";
        mysqli_query($mysql, $sql);
        // Закрытие соединения с базой данных
        mysqli_close($mysql);
        echo $loc['Секретный ключ был успешно изменён!'];
    }