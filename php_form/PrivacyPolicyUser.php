<textarea readonly>
<?php
//текст политики конфиденциальности для новых пользователей
include '../conectSQL.php';   //Подключение к БД и проверка на авторизацию



//Строка запроса на получение политики конфиденциальности из БД
$sql = "SELECT * FROM `admin-panel` WHERE `id` = 1";
//Выполнение запроса
$result = mysqli_query($mysql, $sql);
//Получение результата запроса
$row = mysqli_fetch_assoc($result);
//Вывод результата запроса
echo $row['PrivacyPolicy'];


// Закрытие соединения с базой данных
mysqli_close($mysql);?>
</textarea>
<style>
    textarea{
        width: 100%;
        height: 100%;
        border: none;
        resize: none;
        margin: 0;
        padding: 0;
    }
</style>