<?php include '../conectCOOKIE.php';   //Подключение к БД и проверка на авторизацию
if ($_COOKIE['language'] == 'eng')      //Подключение локализации
    include '../php_constructor/localization/localization_eng.php';
else
    include '../php_constructor/localization/localization_ru.php';
$Headline = $loc['Общие настройки'];   //Заголовок страницы
$nav_select = 1;    //Выбор активного пункта меню
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title><?= $Headline ?> </title>
    <link rel="stylesheet" href="/css/admin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/icons/logo1.png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Подключение JQuery -->
    <script src="/js/constructor.js"></script> <!-- Подключение скриптов для работы popup  -->
</head>


<body>
    <div class="Редактор-отделений">
        <div class="lable">Редактор отделений</div>
        <div class="выбор-отделений">

            <select id="department" class="select-выбор-отделений">
                <option value="none">Выберите отделение</option>
                <?php
                $sql = "SELECT * FROM departments";
                $result = mysqli_query($mysql, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                }
                mysqli_close($mysql);
                ?>
            </select>
            <button class="Удалить" name="submit_button" value="button1" id="button1" onclick="delete_department()">Удалить</button>
        </div>
        <div class="Добавить-отделение">
            <input placeholder="Добавить отделение" id="new_department_name">
            <button class="Кнопка-Добавить-отделение" name="submit_button" value="button2" id="button2" onclick="add_department()">Добавить</button>
        </div>
    </div>

    <div class="Редактор-кабинетов">
        <div class="lable">Редактор кабинетов отделения</div>
        <div class="выбор-кабинетов">
            <select class="select-выбор-кабинетов" id="room">

            </select>
            <button class="Удалить" name="submit_button" value="button3" id="button3" onclick="delete_room()">Удалить</button>
        </div>
        <div class="Добавить-кабинет">
            <input placeholder="Добавить кабинет к этому отделению" id="new_room_name">
            <button class="Кнопка-Добавить-кабинет" name="submit_button" value="button4" id="button4" onclick="add_room()">Добавить</button>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Обработка изменения выбранного отделения
            $('#department').on('change', function() {
                var department_id = $(this).val();
                // AJAX запрос на получение списка кабинетов, соответствующих выбранному отделению
                $.ajax({
                    url: 'get_rooms.php',
                    type: 'POST',
                    data: {
                        department_id: department_id
                    },
                    success: function(data) {
                        $('#room').empty(); // Очистка списка кабинетов
                        var rooms = JSON.parse(data); // Преобразование полученного JSON объекта в массив
                        $.each(rooms, function(index, room) { // Цикл по элементам массива
                            $('#room').append('<option value="' + room.id + '">' + room.name + '</option>'); // Создание и добавление option элемента
                        });
                    }
                });
            });
        });


        function delete_department() {
            var department_id = $('#department').val();
            var button = $('#button1').val();
            // AJAX запрос на удаление отделения
            $.ajax({
                url: 'delete_department.php',
                type: 'POST',
                data: {
                    department_id: department_id,
                    button: button
                },
                success: function(data) {
                    $('#department option[value="' + department_id + '"]').remove(); // Удаление выбранного отделения из выпадающего списка
                    $('#department').val('none'); // Сброс выбранного отделения
                    $('#room').empty(); // Очистка списка кабинетов
                    showPopup(data); // Отображение сообщения об успешном удалении
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Вывод ошибки в консоль
                }
            });
        }
        

        function add_department() {
            var new_department_name = $('#new_department_name').val();
            var button = $('#button2').val();

            // AJAX запрос на добавление нового отделения
            $.ajax({
                url: 'delete_department.php',
                type: 'POST',
                data: {
                    new_department_name: new_department_name,
                    button: button
                },
                success: function(data) {
                    // Обновление списка отделений
                    $('#department').append('<option value="' + data + '">' + new_department_name + '</option>');
                    $('#department').val(data);
                    // Очистка поля ввода
                    $('#new_department_name').val('');
                    // Очистка списка кабинетов
                    $('#room').empty();
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Вывод ошибки в консоль
                }
            });
        }


        function delete_room() {
            var room_id = $('#room').val();
            var button = $('#button3').val();
            // AJAX запрос на удаление кабинета
            $.ajax({
                url: 'delete_department.php',
                type: 'POST',
                data: {
                    room_id: room_id,
                    button: button
                },
                success: function(data) {
                    $('#room option[value="' + room_id + '"]').remove(); // Удаление выбранного кабинета из выпадающего списка
                    showPopup(data); // Отображение сообщения об успешном удалении
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Вывод ошибки в консоль
                }
            });
        }


        function add_room() {
            var department_id = $('#department').val();
            var new_room_name = $('#new_room_name').val();
            var button = $('#button4').val();
            // AJAX запрос на добавление нового кабинета
            $.ajax({
                url: 'delete_department.php',
                type: 'POST',
                data: {
                    department_id: department_id,
                    new_room_name: new_room_name,
                    button: button
                },
                success: function(data) {
                    // Обновление списка кабинетов
                    $('#room').append('<option value="' + data + '">' + new_room_name + '</option>');
                    $('#room').val(data);
                    // Очистка поля ввода
                    $('#new_room_name').val('');
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Вывод ошибки в консоль
                }
            });
        }
    </script>
</body>
<style>
  body {
    font-family: Arial, sans-serif;
    font-size: 16px;
    background-color: #f2f2f2;
}

.lable {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 10px;
}

select {
    display: inline-block;
    padding: 10px;
    font-size: 16px;
    border-radius: 5px;
    border: 2px solid #ccc;
    background-color: #fff;
    outline: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0 20px 10px 0;
}

select option {
    font-size: 16px;
}

button {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    font-weight: bold;
    color: #fff;
    background-color: #007bff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    outline: none;
    transition: background-color 0.3s ease-in-out;
    margin-bottom: 20px;
}

button:hover {
    background-color: #0069d9;
}

input {
    display: inline-block;
    padding: 10px;
    font-size: 16px;
    border-radius: 5px;
    border: 2px solid #ccc;
    outline: none;
    transition: border-color 0.3s ease-in-out;
    margin: 0 20px 20px 0;
}

input:focus {
    border-color: #007bff;
}

.Редактор-отделений,
.Редактор-кабинетов {
    background-color: #fff;
    padding: 20px;
    margin: 28px 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

.Редактор-отделений{
    margin-top: 28px;
}

</style>

</html>