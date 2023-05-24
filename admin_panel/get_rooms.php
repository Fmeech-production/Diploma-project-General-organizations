<?php
// Получаем ID выбранного отделения из запроса AJAX
$department_id = $_POST['department_id'];

include '../conectCOOKIE.php';   //Подключение к БД и проверка на авторизацию

// Получаем список кабинетов, соответствующих выбранному отделению
$sql = "SELECT * FROM rooms WHERE department_id = $department_id";
$result = $mysql->query($sql);

// Создаем массив для хранения данных о кабинетах
$rooms = array();

// Заполняем массив данными о кабинетах
while ($row = $result->fetch_assoc()) {
    $rooms[] = array(
        'id' => $row['id'],
        'name' => $row['name']
    );
}

// Возвращаем данные в формате JSON
echo json_encode($rooms);

// Закрываем соединение с базой данных
$mysql->close();
?>
