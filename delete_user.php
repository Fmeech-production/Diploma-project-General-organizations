<?php
header('Content-Type: application/json');


// Подключитесь к базе данных
include 'conectCOOKIE.php';

$id = $_POST['id'];

// Выполните запрос на удаление пользователя
$sql = "DELETE FROM users WHERE id=$id";
$result = mysqli_query($mysql, $sql);

// Верните результат в виде JSON
echo json_encode(['success' => $result]);
