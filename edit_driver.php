<?php
require_once 'conectCOOKIE.php'; // Подключение к БД и проверка на авторизацию

if (!isset($_GET['driver_id'])) {
	header('Location: drivers_list.php');
	exit();
}

$driver_id = intval($_GET['driver_id']);

$driver_query = $mysql->prepare("SELECT  drivers.*, users.*, cars.*, drivers.id as id
FROM drivers
LEFT JOIN users ON drivers.user_id = users.id
LEFT JOIN cars ON drivers.car_id = cars.id
WHERE drivers.id = ?");
$driver_query->bind_param("i", $driver_id); // привязка параметра к переменной
$driver_query->execute(); // выполнение запроса
$driver_result = $driver_query->get_result(); // получение результата
$driver = $driver_result->fetch_assoc(); // получение ассоциативного массива с данными водителя



if (!$driver) {
	header('Location: drivers_list.php');
	exit();
}
?>

<?php error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_COOKIE['language'] == 'eng')  // Проверка на язык
	include 'php_constructor/localization/localization_eng.php';    // Подключение файла с переводом на английский
else
	include 'php_constructor/localization/localization_ru.php';     // Подключение файла с переводом на русский
$Headline = $driver['SName'];    // Заголовок страницы
$nav_select = 2.3;    // Выбор активного пункта меню
?>
<!DOCTYPE html>
<html>

<head>
	<?php require_once 'php_constructor/head.php'; ?>
</head>

<body>
	<?php
	include 'php_constructor/nav.php';  // Подключение меню
	?>
	<div class="wrap"> <!-- Обертка для контента -->
		<?php
		include 'php_constructor/header.php';   // Подключение шапки
		?>
		<main> <!-- Основной контент -->


			<form action="save_driver_info.php" method="post" id="block1"> <!-- Форма для отправки данных, изеняющаяя данные автомобиля -->
				<div>
					<div class="img_car">
						<img src="cars/<?php echo $driver['car_id']; ?>/<?php echo $driver['car_image']; ?>" alt="АВТОМОБИЛЬ ещё не выбран" class="cover">
					</div>
					<div class="img_car">
						<img src="<?php echo get_avatar_id($driver['user_id']);?>" alt="ПОЛЬЗОВАТЕЛЬ ещё не выбран" class="cover">
					</div>
				</div>
				<h1 style="width: 100%;"><?= $loc['Информация о водителе'] ?></h1>
				<lable class="main-lable"><?= $loc['Пользователь на должность этого водителя'] ?></lable>
				<select class="main-inpyt account_type_select" name="user_id">
					<option value="0"><?= $loc['Не выбран'] ?></option>
					<?php
					$users_query = $mysql->query("SELECT * FROM users WHERE `Account-type` = 3");
					while ($user = $users_query->fetch_assoc()) {
						$selected = $user['id'] == $driver['user_id'] ? 'selected' : ''; // Проверка на совпадение id пользователя водителя и id пользователя в базе данных
						echo '<option value="' . $user['id'] . '" ' . $selected . '>' . $user['SName'] . ' ' . $user['Name'] . ' ' . $user['PName'] . '</option>';
					}
					?>
				</select>
				<lable class="main-lable"><?= $loc['Автомобиль для этого водителя'] ?></lable>
				<select class="main-inpyt account_type_select" name="car_id">
					<option value="0"><?= $loc['Не выбран'] ?></option>
					<?php
					$cars_query = $mysql->query("SELECT * FROM cars");
					while ($car = $cars_query->fetch_assoc()) {
						$selected = $car['id'] == $driver['car_id'] ? 'selected' : ''; // Проверка на совпадение id автомобиля водителя и id автомобиля в базе данных
						echo '<option value="' . $car['id'] . '" ' . $selected . '>' . $car['license_plate'] . ' - ' . $car['make'] . ' ' . $car['model'] . '</option>';
					}
					?>
				</select>



				<lable class="main-lable"><?= $loc['Регистрационный номер'] ?></lable>
				<input class="main-inpyt" value="<?php echo $driver['license_plate'] ?>" name="license_plate" readonly>
				<!-- Далее идут скрытые поля, которые необходимы для отправки данных -->
				<input type="hidden" name="driver_id" value="<?php echo $driver['id'] ?>">

				<button class="form-btn" type="submit"> <?= $loc['Save'] ?> </button> <!-- Кнопка для сохранения изменений -->
			</form>


			<!-- далее идёт код удаления водителя -->
			<form action="php_constructor/delete_driver.php" method="post" id="block2" class="form_driver_knopka">
				<input type="hidden" name="driver_id" value="<?php echo $driver['id'] ?>">
				<button class="form-btn driver_knopka" type="submit" style="margin-top: 10px; background-color: #ff0000;"><?= $loc['Удалить водителя'] ?></button>
			</form>

		</main>
	</div>
	<script>
		showPopup('<?= $loc['Данные об этом водителе были успешно изменены!'] ?>', 'error10'); // Вывод сообщения об успешном изменении данных профиля
	</script>
	<style>
		#block1 div:first-child {
			display: flex;
			width: calc(100% - 5px);
		}

		#block1 div:throw-child {
			width: 50%;
		}

		#block1 div:throw-child img {
			width: 50%;
		}
	</style>
</body>

</html>