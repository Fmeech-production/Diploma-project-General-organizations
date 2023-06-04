<?php include 'conectCOOKIE.php'; // Подключение к БД и проверка на авторизацию
if ($_COOKIE['language'] == 'eng')  // Проверка на язык
	include 'php_constructor/localization/localization_eng.php';    // Подключение файла с переводом на английский
else
	include 'php_constructor/localization/localization_ru.php';     // Подключение файла с переводом на русский
$Headline = "Информация о пользователе"; // Заголовок страницы
$nav_select = 2;    // Выбор активного пункта меню







?>
<!DOCTYPE html>
<html>

<head>
	<?php include 'php_constructor/head.php';  // Подключение head 
	?>
	<style>
		main {
			height: calc(100vh - 24px - 44px - 48px - 10px - 200px - 12px - 12px);
		}
	</style>
</head>

<body>
	<?php

	include 'php_constructor/nav.php';  // Подключение меню
	?>
	<div class="wrap"> <!-- Обертка для контента -->
		<?php
		include 'php_constructor/header.php';   // Подключение шапки
		$id_search_user = $_GET['id'];
		$userS = $mysql->query("SELECT * FROM `users` WHERE `id` = '$id_search_user'"); // Запрос на получение данных пользователя
		$user = $userS->fetch_assoc();
		include 'php_constructor/avatars_admin_editor.php';   // Подключение редактора аватарок
		?>
		<main class="main_user_details"> <!-- Основной контент -->
			<form action="save_other_user_profile.php" method="post" id="block1"> <!-- Форма для отправки данных, изеняющаяя данные профиля -->
				<lable class="main-lable"><?= $loc['Surname'] ?></lable>
				<input class="main-inpyt" placeholder="<?= $loc['Required_field_to_fill_in'] ?>" value="<?= $user['SName'] ?>" name="SName">
				<lable class="main-lable"><?= $loc['Name'] ?></lable>
				<input class="main-inpyt" placeholder="<?= $loc['Required_field_to_fill_in'] ?>" value="<?= $user['Name'] ?>" name="Name">
				<lable class="main-lable"><?= $loc['Middle_name'] ?></lable>
				<input class="main-inpyt" placeholder="<?= $loc['Required_field_to_fill_in'] ?>" value="<?= $user['PName'] ?>" name="PName">
				<lable class="main-lable">*<?= $loc['mail'] ?></lable>
				<input class="main-inpyt" placeholder="<?= $loc['Optional_field'] ?>" value="<?= $user['Email'] ?>" name="Email">
				<lable class="main-lable">*<?= $loc['Telephone'] ?></lable>
				<input class="main-inpyt" placeholder="<?= $loc['Optional_field'] ?>" value="<?= $user['Phone'] ?>" name="Phone">

				<label class="main-lable"><?= $loc['Login'] ?></label>
				<input class="main-inpyt" placeholder="<?= $loc['Required_field_to_fill_in'] ?>" value="<?= $user['Login'] ?>" name="Login">
				<label class="main-lable"><?= $loc['Password'] ?></label>
				<input class="main-inpyt" placeholder="<?= $loc['Required_field_to_fill_in'] ?>" value="" name="Password">
				<!--далее мы поставим чеккбокс или кнопка включающая или отключающая отправку нового пароля на серврвер для дальнейшего его изменения-->
				<input type="checkbox" class="checkbox_save_password" name="save_password" value="1" id="checkbox_save_password"> <label for="checkbox_save_password" class="checkbox_save_password_text"><?= $loc['Сохранить новый логин и пароль'] ?></label>




				<label class="main-lable"><?= $loc['Account_type'] ?></label>
				<select class="account_type_select" name="account_type">
					<option value="0" <?php if ($user['Account-type'] == 0) echo 'selected' ?>><?= $loc['Сотрудник наркологии'] ?></option>
					<option value="1" <?php if ($user['Account-type'] == 1) echo 'selected' ?>><?= $loc['Начальник административно хозяйственного отдела'] ?></option>
					<option value="2" <?php if ($user['Account-type'] == 2) echo 'selected' ?>><?= $loc['Сотрудник административно хозяйственного отдела'] ?></option>
					<option value="3" <?php if ($user['Account-type'] == 3) echo 'selected' ?>><?= $loc['Водитель'] ?></option>
					<option value="4" <?php if ($user['Account-type'] == 4) echo 'selected' ?>><?= $loc['Администратор'] ?></option>
				</select>
				<style>
					.account_type_select {
						width: calc(100% - 10px);
						height: 40px;
						border: 1px solid #ccc;
						border-radius: 5px;
						padding: 0 10px;
						font-size: 16px;
						color: #000;
						outline: none;
						margin-left: 5px;
					}

					.checkbox_save_password {
						min-width: 20px;
						min-height: 20px;
						border: 1px solid #ccc;
						border-radius: 5px;
						padding: 0 0px;
						font-size: 16px;
						color: #000;
						outline: none;
						margin-right: 5px;
						margin-left: 5px;
						margin-top: -10px;
						margin-bottom: 20px;
					}

					.checkbox_save_password_text {
						min-width: 300px;
						font-size: 16px;
						color: #000;
						outline: none;
						margin-right: calc(100% - 305px - 30px);
						margin-left: 5px;
						margin-top: -10px;
						margin-bottom: 20px;
					}
				</style>


				<button class="form-btn" type="submit"> <?= $loc['Save'] ?> </button> <!-- Кнопка для сохранения изменений -->
				<!-- далее идут скрытые поля для передачи данных -->
				<input type="hidden" name="userId" value="<?= $user['id'] ?>">

			</form>
		</main>
	</div>
	<script>
		showPopup('<?= $loc['Profile_data_has_been_successfully_updated'] ?>', 'error6'); // Вывод сообщения об успешном изменении данных профиля
	</script>
</body>

</html>










































































<?php
exit();
include 'conectCOOKIE.php';
if ($_COOKIE['language'] == 'eng')
	include 'php_constructor/localization/localization_eng.php';
else
	include 'php_constructor/localization/localization_ru.php';

$id_booking = $_GET['id'];
$результатЗаявок = $mysql->query("SELECT * FROM `booking` WHERE `id` = '$id_booking'");
$Заявка = $результатЗаявок->fetch_assoc();

$Headline = "Информация о пользователе";
$nav_select = 2;


?>
<!DOCTYPE html>
<html>

<head>
	<?php include 'php_constructor/head.php'; ?>
</head>




<body>



	<?php
	include 'php_constructor/nav.php';
	?>

	<div class="wrap">
		<?php
		include 'php_constructor/header.php';
		?>
		<main class="card">
			<?php
			// Получение значения id из параметра GET
			$user_id = $_GET['id'];

			// Выполнение запроса к базе данных для получения информации о пользователе
			$sql = "SELECT * FROM users WHERE id = '$user_id'";
			$result = mysqli_query($mysql, $sql);
			$user = mysqli_fetch_assoc($result);

			?>


			<div>
				<h2>Личные данные</h2>
				<p>ФИО: <?= $user['SName'] . " " . $user['Name'] . " " . $user['PName'] ?></p>
				<p>Email: <?= $user['Email'] ?></p>
				<p>Телефон: <?= $user['Phone'] ?></p>
			</div>

			<div>
				<h2>Данные аккаунта</h2>
				<p>Логин: <?= $user['Login'] ?></p>
				<p>Тип аккаунта: <?php
									switch ($user['Account-type']) {
										case 0:
											echo "Сотрудник наркологии";
											break;
										case 1:
											echo "Начальник административно хозяйственного отдела";
											break;
										case 2:
											echo "Сотрудник административно хозяйственного отдела";
											break;
										case 3:
											echo "Водитель";
											break;
										case 4:
											echo "Системный-администратор";
											break;
										default:
											echo "Неизвестный тип аккаунта";
									}
									?></p>
			</div>
			<div>
				<button class="edit-user">Редактировать</button>
				<button class="delete-user">Удалить</button>
			</div>







			<!-- Форма редактирования пользователя -->
			<form id="edit-user-form" method="post" style="display:none;">
				<button type="button" class="close-popup">X</button>
				<input type="hidden" name="id" value="">
				<label for="login">Логин</label>
				<input type="text" name="login" value="">
				<label for="password">Пароль</label>
				<input type="text" name="password" value="">
				<label for="name">Имя</label>
				<input type="text" name="name" value="">
				<label for="surname">Фамилия</label>
				<input type="text" name="surname" value="">
				<label for="patronymic">Отчество</label>
				<input type="text" name="patronymic" value="">
				<label for="email"> Почта</label>
				<input type="text" name="email" value="">
				<label for="phone">Телефон</label>
				<input type="text" name="phone" value="">
				<label for="account_type">Тип аккаунта</label>
				<select name="account_type" class="account_type">
					<option value="0">Сотрудник наркологии</option>
					<option value="1">Начальник административно хозяйственного отдела</option>
					<option value="2">Сотрудник административно хозяйственного отдела</option>
					<option value="3">Водитель</option>
					<option value="4">Системный-администратор</option>
				</select>


				<input type="submit" name="update_user" value="Обновить">
			</form>

			<script>
				// При нажатии на кнопку "Редактировать"
				$('.edit-user').on('click', function() {
					// Заполните форму данными пользователя
					$('#edit-user-form input[name="id"]').val(<?= $user['id'] ?>);
					$('#edit-user-form input[name="login"]').val("<?= $user['Login'] ?>");
					$('#edit-user-form input[name="password"]').val(""); // Мы не можем получить пароль пользователя
					$('#edit-user-form select[name="account_type"]').val(<?= $user['Account-type'] ?>);
					$('#edit-user-form input[name="name"]').val("<?= $user['Name'] ?>");
					$('#edit-user-form input[name="surname"]').val("<?= $user['SName'] ?>");
					$('#edit-user-form input[name="patronymic"]').val("<?= $user['PName'] ?>");
					$('#edit-user-form input[name="email"]').val("<?= $user['Email'] ?>");
					$('#edit-user-form input[name="phone"]').val("<?= $user['Phone'] ?>");

					// Отобразите форму редактирования
					$('#edit-user-form').show();
				});

				// Обработка отправки формы редактирования
				$('#edit-user-form').on('submit', function(event) {
					event.preventDefault();

					// Получите данные формы
					var formData = $(this).serialize();

					// Отправьте данные на сервер для обновления информации о пользователе
					$.post('update_user.php', formData, function(response) {
						// Обработайте ответ сервера (например, обновите таблицу или выведите сообщение об успехе)
						if (response.success) {
							alert('Информация о пользователе успешно обновлена');
							location.reload(); // перезагрузка страницы для обновления данных в таблице
						} else {
							alert('Произошла ошибка при обновлении информации о пользователе:');

						}
					}, 'json');
				});


				// При нажатии на кнопку "Закрыть попап"
				$('.close-popup').on('click', function() {
					// Скрыть форму редактирования
					$('#edit-user-form').hide();
				});
			</script>

			<style>
				.edit-user {
					width: 150px;
					height: 30px;
					background-color: #4b5cff;
					color: #fff;
					border: none;
					border-radius: 5px;
					box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.2);
					transition: all 0.2s ease-in-out;
					cursor: pointer;
					font-weight: bold;
					font-size: 16px;
				}

				.edit-user:hover {
					background-color: #3e4dff;
					box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
				}

				#edit-user-form {
					padding: 20px;
					background-color: #f5f5f5;
					border-radius: 5px;
					width: calc(100% - 40px);
					margin: 0;
					margin-top: 20px;
				}

				#edit-user-form label {
					display: block;
					margin-bottom: 5px;
				}

				#edit-user-form input {
					display: block;
					margin-bottom: 10px;
					padding: 5px;
					border: 1px solid #ccc;
					border-radius: 5px;
					width: 300px;
				}

				#edit-user-form input[type="submit"] {
					width: auto;
				}

				.delete-user {
					width: 100px;
					height: 30px;
					background-color: #ff4b4b;
					color: #fff;
					border: none;
					border-radius: 5px;
					box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.2);
					transition: all 0.2s ease-in-out;
					cursor: pointer;
					font-weight: bold;
					font-size: 16px;
				}

				.delete-user:hover {
					background-color: #ff3e3e;
					box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
				}

				.account_type {
					width: 300px;
					height: 30px;
					border: 1px solid #ccc;
					border-radius: 5px;
				}

				.close-popup {
					position: absolute;
					top: 10px;
					right: 10px;
					background-color: transparent;
					border: none;
					font-size: 20px;
					cursor: pointer;
				}

				.close-popup:hover {
					color: #ff4b4b;
				}
			</style>



			<!-- Кнопка удаления пользователя -->
			<script>
				// При нажатии на кнопку "Удалить"
				$('.delete-user').on('click', function() {
					if (!confirm('Вы действительно хотите удалить этого пользователя?')) {
						return;
					}

					var row = $(this).closest('tr');
					var id = row.find('td').eq(0).text();

					// Отправьте запрос на сервер для удаления пользователя
					$.post('delete_user.php', {
						id: id
					}, function(response) {
						// Обработайте ответ сервера (например, удалите строку из таблицы или выведите сообщение об успехе)
						if (response.success) {
							alert('Пользователь успешно удален');
							row.remove();
						} else {
							alert('Произошла ошибка при удалении пользователя');
						}
					}, 'json');
				});
			</script>

			<style>
				.delete-user {
					width: 100px;
					height: 30px;
					background-color: #ff4b5c;
					background-color: #9d9d9d;
					color: #fff;
					border: none;
					border-radius: 5px;
					box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.2);
					transition: all 0.2s ease-in-out;
					cursor: pointer;
					font-weight: bold;
					font-size: 16px;
					margin-left: 50px;
					margin-top: 8px;
				}

				.delete-user:hover {
					background-color: #ff3e4d;
					box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
				}

				.delete-user:focus {
					outline: none;
				}
			</style>















		</main>
	</div>

	<script src="js/constructor.js">
	</script>
	<script>
		showPopup(<?= "'" . $loc['Новая заявка оставлена успешно!'] . "'" ?>, 'error7');
	</script>
	<style>
		main {

			padding: 10px;
		}
	</style>


</body>

</html>