<?php include 'conectCOOKIE.php';   //Подключение к БД и проверка на авторизацию
if ($_COOKIE['language'] == 'eng')      //Подключение локализации
	include 'php_constructor/localization/localization_eng.php';
else
	include 'php_constructor/localization/localization_ru.php';
$Headline = $loc['Новая заявка'];   //Заголовок страницы
$nav_select = 2.5;    //Выбор активного пункта меню
?>
<!DOCTYPE html>
<html>

<head>
	<?php include 'php_constructor/head.php'; ?>
</head>

<body>
	<?php
	include 'php_constructor/nav.php';  //Подключение меню
	?>
	<div class="wrap">
		<?php
		include 'php_constructor/header.php';   //Подключение шапки
		?>
		<main> <!-- Основной контент -->
			<form action="New-TopicForDiscussion__worker_narcology.php" method="post" class="form_main_1">
				<lable class="main-lable"><?= $loc['Описание проблемы'] ?></lable>
				<input class="main-inpyt" name="problem-description" placeholder="<?= $loc['Опишите проблему, о которой вы хотите сообщить'] ?>" required maxlength="255">

				<lable class="main-lable"><?= $loc['Время отправки заявки:'] ?></lable>
				<p class="main-inpyt" id="current-time"><?= date("H:i:s") ?></p>

				<lable class="main-lable"><?= $loc['Тематика проблемы:'] ?></lable>
				<select class="main-inpyt main-select" name="topic">
					<?php $themes = $mysql->query("SELECT * FROM themes"); // выборка всех тем из БД
					while ($theme = $themes->fetch_assoc()) { // перебор каждой темы
						echo '<option value="' . $theme['text'] . '">' . $theme['text'] . '</option>'; // создание элемента списка
					}
					?>
				</select>


				<label class="main-lable"><?= $loc['Отделение'] ?></label>
				<select class="main-inpyt main-select" name="department_id" required>
					<option value=""><?= $loc['Выберите отделение'] ?></option>
					<?php
					$departments = $mysql->query("SELECT * FROM departments"); // выборка всех отделений из БД
					while ($department = $departments->fetch_assoc()) { // перебор каждого отделения
						echo '<option value="' . $department['id'] . '">' . $department['name'] . '</option>'; // создание элемента списка
					}
					?>
				</select>


				<label class="main-lable"><?= $loc['Кабинет'] ?></label>
				<select class="main-inpyt main-select" name="room_id" id="room-select" required>
					<option value=""><?= $loc['Выберите кабинет'] ?></option>
				</select>

				<script>
					$(document).ready(function() {
						// при выборе отделения изменяем список кабинетов
						$('select[name="department_id"]').on('change', function() {
							var department_id = $(this).val(); // получаем ID выбранного отделения
							$.ajax({
								url: 'get_rooms.php', // файл для получения списка кабинетов
								type: 'post',
								data: {
									department_id: department_id
								}, // передаем ID выбранного отделения
								success: function(response) {
									$('#room-select').html(response); // заменяем содержимое списка кабинетов
								}
							});
						});
					});
				</script>



				<button class="form-btn"><?= $loc['Отправить заявку'] ?></button>

				<script>
					function updateDateTime() {
						const now = new Date();
						const datetime = now.toLocaleString();
						document.getElementById('current-time').textContent = datetime;
					}

					updateDateTime(); // вызываем функцию один раз, чтобы отобразить дату и время сразу же

					setInterval(updateDateTime, 1000); // вызываем функцию каждую секунду для обновления даты и времени
				</script>

			</form>
		</main>
	</div>
	<script>
		showPopup(<?= "'" . $loc['Новая заявка оставлена успешно!'] . "'" ?>, 'error7');
	</script>
</body>

</html>