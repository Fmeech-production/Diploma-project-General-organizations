<?php   //Создание новой заявки о неисправности
    include 'conectCOOKIE.php';   //Подключение к БД и проверка на авторизацию<?php

    
    // Получаем данные из формы
    $problem_description = $_POST['problem-description'];
    $topic = $_POST['topic'];
    $department_id = $_POST['department_id'];
    $room_id = $_POST['room_id'];
    
    // Получаем текущую дату и время в формате, который будет храниться в БД
    $current_time = date("Y-m-d H:i:s");
    
    
    // Сохраняем данные в БД
    $sql = "INSERT INTO topics (sender_id, date, description, mini_topic, department_id, room_id) VALUES ('$userId', '$current_time', '$problem_description', '$topic', '$department_id', '$room_id')";
    $result = $mysql->query($sql);
    
    if ($result) {
      // Данные успешно сохранены
      echo "Заявка успешно отправлена!";
    } else {
      // Произошла ошибка
      echo "Ошибка при отправке заявки: " . $mysql->error;
    }
    
    // Закрываем соединение с БД
    $mysql->close();
   

header('Location: /TopicForDiscussion__worker_narcology.php?error=error7');


