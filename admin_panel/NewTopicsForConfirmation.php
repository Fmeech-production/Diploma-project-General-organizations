<?php include '../conectCOOKIE.php';   //Подключение к БД и проверка на авторизацию
if ($_COOKIE['language'] == 'eng')      //Подключение локализации
    include '../php_constructor/localization/localization_eng.php';
else
    include '../php_constructor/localization/localization_ru.php';

if (isset($_POST['button'])) {
    if ($_POST['button'] == 'button1') {
        // кнопка "Удалить мини-тему" была нажата

        if (isset($_POST['department_id'])) {
            // Получение id отделения
            $department_id = $_POST['department_id'];




            // Удаление отделения из таблицы themes
            $sql = "DELETE FROM themes WHERE id = $department_id";
            if (mysqli_query($mysql, $sql)) {
                echo "Тема успешно удалено!";
            } else {
                echo "Ошибка при удалении отделения: " . mysqli_error($mysql);
            }

            // Закрытие соединения с базой данных
            mysqli_close($mysql);
        }
    } elseif ($_POST['button'] == 'button2') {
        // кнопка "Добавить мини-тему" была нажата

        $new_department_name = $_POST['new_department_name'];
        // Добавление новой мини темы в таблицу themes
        $sql = "INSERT INTO `themes` (`text`) VALUES ('$new_department_name')";
        mysqli_query($mysql, $sql);
        // Получение id новой мини темы
        $new_department_id = mysqli_insert_id($mysql);
        // Закрытие соединения с базой данных
        mysqli_close($mysql);
        // Возврат id новой мини темы
        echo $new_department_id;
    }
}
