<?php
// Ajax-запрос на получение кабинетов по ID отделения дял страницы TopicForDiscussion__worker_narcology.php
include 'conectCOOKIE.php';   //Подключение к БД и проверка на авторизацию
  $department_id = $_POST['department_id']; // получаем ID выбранного отделения
  $rooms = $mysql->query("SELECT * FROM rooms WHERE department_id = $department_id"); // выборка кабинетов из БД
  while ($room = $rooms->fetch_assoc()) { // перебор каждого кабинета
    echo '<option value="'.$room['id'].'">'.$room['name'].'</option>'; // создание элемента списка
  }
?>
