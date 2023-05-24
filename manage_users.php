<?php include 'conectCOOKIE.php';
if ($_COOKIE['language'] == 'eng')
	include 'php_constructor/localization/localization_eng.php';
else
	include 'php_constructor/localization/localization_ru.php';


$Headline = "Управление пользователями"; //Заголовок страницы
$nav_select = 2;    //Выбор активного пункта меню


$sql = "SELECT * FROM users";
$result = mysqli_query($mysql, $sql);

?>

<!DOCTYPE html>
<html>

<head>
	<?php require_once 'php_constructor/head.php'; ?>
</head>


<body>
	<?php
	include 'php_constructor/nav.php';  //Подключение меню
	?>
	<div class="wrap">
		<?php
		include 'php_constructor/header.php';   //Подключение шапки
		?>


		<?php include 'php_constructor/table_admin2.php'; //Подключение таблицы с пользователями 

		//Вывод таблицы с пользователями по очереди по типу акаунта
		table_admin2("SELECT * FROM `users` ORDER BY `users`.`Account-type` ASC", $mysql);
		?>
		<div class="wrap">





			<style>
				.edit-user div{
					width: 30px;
					height: 30px;
					filter: invert(1);
				}
				.edit-user {
					width: 60px;
					height: 40px;
					background-color: #4b5cff;
					color: #fff;
					border: none;
					border-radius: 5px 0 0 5px;
					box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.2);
					transition: all 0.2s ease-in-out;
					cursor: pointer;
					font-weight: bold;
					font-size: 16px;
					margin: 0;
					margin-top: 8px;
					padding: 0;
					display: flex;
					justify-content: center;
					align-items: center;
				}

				.edit-user:hover {
					background-color: #3e4dff;
					box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
				}





				#edit-user-form input[type="submit"] {
					width: auto;
				}

				.delete-user div{
					width: 30px;
					height: 30px;
					filter: invert(1);
				}
				.delete-user {
					width: 40px;
					height: 40px;
					background-color: #ff4b5c;
					background-color: #9d9d9d;
					color: #fff;
					border: none;
					border-radius: 0 5px 5px 0;
					box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.2);
					transition: all 0.2s ease-in-out;
					cursor: pointer;
					font-weight: bold;
					font-size: 16px;
					margin: 0;
					margin-top: 8px;
					padding: 0;
					display: flex;
					justify-content: center;
					align-items: center;
				}

				.delete-user:hover {
					background-color: #ff3e4d;
					box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
				}

				.delete-user:focus {
					outline: none;
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






			<!-- Форма добавления нового пользователя -->
			<form id="add-user-form" method="post">
				<label for="login">Логин</label>
				<input type="text" name="login" required>

				<label for="password">Пароль</label>
				<input type="password" name="password" required>

				<!-- и так далее для всех полей -->
				<label for="sName">Фамилия</label>
				<input type="text" name="sName">

				<label for="name">Имя</label>
				<input type="text" name="name">

				<label for="pName">Отчество</label>
				<input type="text" name="pName">

				<label for="email">Email</label>
				<input type="email" name="email">

				<label for="phone">Телефон</label>
				<input type="text" name="phone">

				<label for="account_type">Тип аккаунта</label>
				<select name="account_type" class="account_type" required>
					<option value="0">Сотрудник наркологии</option>
					<option value="1">Начальник отдела хозяйственной части</option>
					<option value="2">Сотрудник отдела хозяйственной части</option>
					<option value="3">Водитель</option>
					<option value="4">Администратор</option>
				</select>


				<input type="submit" name="add_user" value="Добавить пользователя">
			</form>

			<script>
				// Обработка отправки формы добавления нового пользователя
				$('#add-user-form').on('submit', function(event) {
					event.preventDefault();

					// Получите данные формы
					var formData = $(this).serialize();

					// Отправьте данные на сервер для добавления нового пользователя
					$.post('add_user.php', formData, function(response) {
						// Обработайте ответ сервера (например, добавьте новую строку в таблицу или выведите сообщение об успехе)
						if (response.success) {
							alert('Пользователь успешно добавлен');
							location.reload(); // перезагрузка страницы для обновления данных в таблице
						} else {
							alert('Произошла ошибка при добавлении нового пользователя');
						}
					}, 'json');
				});
			</script>

			<style>
				#add-user-form {
					position: absolute;
					top: 90px;
					right: 0;
					width: 300px;
					padding: 10px;
					background: #fff;
					border: 1px solid #ccc;
					border-radius: 5px;
				}

				#add-user-form label {
					display: block;
					margin-top: 10px;
				}

				#add-user-form input {
					display: block;
					width: 100%;
					padding: 5px;
					border: 1px solid #ccc;
					border-radius: 3px;
				}

				#add-user-form input[type="submit"] {
					margin-top: 10px;
					padding: 5px 10px;
					border: 1px solid #ccc;
					border-radius: 3px;
					background: #fff;
					cursor: pointer;
				}

				#add-user-form input[type="submit"]:hover {
					background: #eee;
				}

				#add-user-form input[type="submit"]:active {
					background: #ddd;
				}

				#edit-user-form {
					position: absolute;
					top: 0;
					right: 0;
					width: 300px;
					padding: 10px;
					background: #fff;
					border: 1px solid #ccc;
					border-radius: 5px;
				}

				#edit-user-form label {
					display: block;
					margin-top: 10px;
				}

				#edit-user-form input {
					display: block;
					width: 100%;
					padding: 5px;
					border: 1px solid #ccc;
					border-radius: 3px;
				}

				#edit-user-form input[type="submit"] {
					margin-top: 10px;
					padding: 5px 10px;
					border: 1px solid #ccc;
					border-radius: 3px;
					background: #fff;
					cursor: pointer;
				}

				#edit-user-form input[type="submit"]:hover {
					background: #eee;
				}

				#edit-user-form input[type="submit"]:active {
					background: #ddd;
				}

				#edit-user-form input[type="submit"] {
					margin-top: 10px;
					padding: 5px 10px;
					border: 1px solid #ccc;
					border-radius: 3px;
					background: #fff;
					cursor: pointer;
				}
			</style>






		</div>
</body>

</html>