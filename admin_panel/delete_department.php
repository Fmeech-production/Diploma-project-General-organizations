<?php include '../conectCOOKIE.php';   //Подключение к БД и проверка на авторизацию
if ($_COOKIE['language'] == 'eng')      //Подключение локализации
    include '../php_constructor/localization/localization_eng.php';
else
    include '../php_constructor/localization/localization_ru.php';



if (isset($_POST['button'])) {
    if ($_POST['button'] == 'button1') {
        // кнопка "Удалить отделение" была нажата

        if (isset($_POST['department_id'])) {
            // Получение id отделения
            $department_id = $_POST['department_id'];


            // Удаление связанных записей в таблице rooms
            $sql = "DELETE FROM rooms WHERE department_id = $department_id";
            mysqli_query($mysql, $sql);

            // Удаление отделения из таблицы departments
            $sql = "DELETE FROM departments WHERE id = $department_id";
            if (mysqli_query($mysql, $sql)) {
                echo "Отделение успешно удалено!";
            } else {
                echo "Ошибка при удалении отделения: " . mysqli_error($mysql);
            }

            // Закрытие соединения с базой данных
            mysqli_close($mysql);
        }
    } elseif ($_POST['button'] == 'button2') {
        // кнопка "Добавить отделение" была нажата

        $new_department_name = $_POST['new_department_name'];
        // Добавление нового отделения в таблицу departments
        $sql = "INSERT INTO departments (name) VALUES ('$new_department_name')";
        mysqli_query($mysql, $sql);
        // Получение id нового отделения
        $new_department_id = mysqli_insert_id($mysql);
        // Закрытие соединения с базой данных
        mysqli_close($mysql);
        // Возврат id нового отделения
        echo $new_department_id;
    } elseif ($_POST['button'] == 'button3') {
        // кнопка "Удалить кабинет у отделения" была нажата

        // Получение id кабинета
        $room_id = $_POST['room_id'];

        // Удаление кабинета из таблицы rooms
        $sql = "DELETE FROM rooms WHERE id = $room_id";
        if (mysqli_query($mysql, $sql)) {
            echo "Кабинет успешно удален!";
        } else {
            echo "Ошибка при удалении кабинета: " . mysqli_error($mysql);
        }

        // Закрытие соединения с базой данных
        mysqli_close($mysql);
    } elseif ($_POST['button'] == 'button4') {
        // кнопка "Добавить кабинет у отделения" была нажата

        $department_id = $_POST['department_id'];
        $new_room_name = $_POST['new_room_name'];

        $sql = "INSERT INTO rooms (department_id, name) VALUES ($department_id, '$new_room_name')";
        mysqli_query($mysql, $sql);
        $new_room_id = mysqli_insert_id($mysql);

        mysqli_close($mysql);
        echo $new_room_id;
    }
}
