<?php

if (!defined('ROOT_DIR'))
	define('ROOT_DIR', realpath(__DIR__));
require_once(ROOT_DIR . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');


use Fmeech2\Car;
use Fmeech2\ConnectSQL;
use Fmeech2\ConnectCOOKIE;

require_once 'conectCOOKIE.php'; // Подключение к БД и проверка на авторизацию

if (!isset($_GET['car_id'])) {
	header('Location: cars_list.php');
	exit();
}

$car_id = intval($_GET['car_id']);

$car_query = $mysql->prepare("SELECT * FROM cars WHERE id = ?");
$car_query->bind_param('i', $car_id);
$car_query->execute();
$car = $car_query->get_result()->fetch_assoc();

if (!$car) {
	header('Location: cars_list.php');
	exit();
}
?>

<?php error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_COOKIE['language'] == 'eng')  // Проверка на язык
	include 'php_constructor/localization/localization_eng.php';    // Подключение файла с переводом на английский
else
	include 'php_constructor/localization/localization_ru.php';     // Подключение файла с переводом на русский
$Headline = $car['license_plate'];    // Заголовок страницы
$nav_select = 2.2;    // Выбор активного пункта меню
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


			<form action="save_car_info.php" method="post" id="block1"> <!-- Форма для отправки данных, изеняющаяя данные автомобиля -->
				<div class="img_car">
					<img src="cars/<?php echo $car['id']; ?>/<?php echo $car['car_image']; ?>" alt="фото автомобиля" class="cover">
				</div>
				<h1 style="width: 100%;"><?= $loc['Информация об автомобиле'] ?> </h1>
				<lable class="main-lable"><?= $loc['Водители этого автомобиля:'] ?> </lable>
				<div class="main-list">
					<?php
					echo Car::DriversIdName($car['drivers_id']);
					?>
				</div>
				<lable class="main-lable"><?= $loc['Добавить нового водителя для этой машины'] ?> </lable>
				<select class="main-select main-select-2" placeholder="<?php echo $loc['Optional_field'] ?>" name="drivers_id">
					<?php
					echo Car::DriversIdOption($car['drivers_id']);
					?>
				</select>
				<button id="new_draiver_in_car" type="button">
				<?= $loc['Добавить нового водителя'] ?> 
				</button>

				<script>
					$(document).ready(function() {
						$('#new_draiver_in_car').click(function() {
							var drivers_id = $('.main-select-2').val();
							var car_id = <?php echo $car['id'] ?>;
							$.ajax({
								type: 'POST',
								url: 'php_constructor/new_draiver_in_car.php',
								data: {
									drivers_id: drivers_id,
									car_id: car_id
								},
								beforeSend: function() {
									console.log(	<?= $loc['Запрос на обновление водителей отправлен!'] ?> );
									$('.main-list').html('<img src="img/loading.gif" style="margin: auto; display: flex;">');
								},
								success: function(result) {
									$('.main-list').html(result);
									$('select.main-select-2 option[value="' + drivers_id + '"]').remove();
								},
								error: function(result) {
									alert(<?= $loc['Ошибка'] ?>);
								}
							});
						});
					});


					$(document).ready(function() {
						$('.main-list').on('click', 'div', function() {
							var driverId = $(this).data('id');
							var car_id = <?php echo $car['id'] ?>;
							var driverName = $(this).text();

							// Выводим окно подтверждения перед удалением
							if (confirm(<?= $loc['Вы действительно хотите удалить водителя для этой машины'] ?> + driverName + "?")) {
								$.ajax({
									type: 'POST',
									url: 'php_constructor/delete_driver_from_car.php',
									data: {
										driverId: driverId,
										car_id: car_id
									},
									beforeSend: function() {
										// Код, который нужно выполнить перед отправкой запроса
										console.log(<?= $loc['Запрос на УДАЛЕНИЕ водителей отправлен!'] ?>);
										$('.main-list').html('<img src="img/loading.gif" style="margin: auto; display: flex;">');
									},
									success: function(result) {
										$('.main-list').html(result);
										$('select.main-select-2').append($('<option>', {
											value: driverId,
											text: driverName
										}));

										// Код, который нужно выполнить после получения ответа от сервера
									},
									error: function(result) {
										alert(<?= $loc['Ошибка'] ?>);
									}
								});
							}
						});
					});
				</script>
				<lable class="main-lable"> <?= $loc['Марка'] ?></lable>
				<input class="main-inpyt" placeholder="<?php echo $loc['Required_field_to_fill_in'] ?>" value="<?php echo $car['make'] ?>" name="make">
				<lable class="main-lable"> <?= $loc['Модель'] ?></lable>
				<input class="main-inpyt" placeholder="<?php echo $loc['Required_field_to_fill_in'] ?>" value="<?php echo $car['model'] ?>" name="model">
				<lable class="main-lable"> <?= $loc['Год выпуска'] ?></lable>
				<input class="main-inpyt" placeholder="<?php echo $loc['Required_field_to_fill_in'] ?>" value="<?php echo $car['year'] ?>" name="year">
				<lable class="main-lable"><?= $loc['Регистрационный номер'] ?></lable>
				<input class="main-inpyt" placeholder="<?php echo $loc['Required_field_to_fill_in'] ?>" value="<?php echo $car['license_plate'] ?>" name="license_plate">

				<!-- Далее идут скрытые поля, которые необходимы для отправки данных -->
				<input type="hidden" name="car_id" value="<?php echo $car['id'] ?>">

				<button class="form-btn" type="submit"> <?= $loc['Save'] ?> </button> <!-- Кнопка для сохранения изменений -->
			</form>
			<form action="php_constructor/upload_car_cover.php?car_id=<?= $car_id ?>" method="post" enctype="multipart/form-data" id="upload_cover_form" class="form_car_knopka">

				<lable class="main-lable" style="margin-top: 70px;" > <?= $loc['Загрузить обложку автомобиля'] ?></lable>
				<input type="file" class="main-inpyt car_knopka" name="car_cover" accept="image/*">
				<!-- Далее идут скрытые поля, которые необходимы для отправки данных -->
				<input type="hidden" name="car_id" value="<?php echo $car['id'] ?>">
				<button class="form-btn car_knopka" type="submit" style="margin-top: 10px;"><?= $loc['Загрузить обложку'] ?></button>
			</form>

			<!-- далее идёт код удаления автомобиля -->
			<form action="php_constructor/delete_car.php" method="post" id="block2" class="form_car_knopka">
				<input type="hidden" name="car_id" value="<?php echo $car['id'] ?>">
				<button class="form-btn car_knopka" type="submit" style="margin-top: 10px; background-color: #ff0000;"><?= $loc['Удалить автомобиль'] ?></button>
			</form>

		</main>
	</div>
	<script>
		showPopup('<?= $loc['Данные об этом автомобиле были успешно изменены!'] ?>', 'error10'); // Вывод сообщения об успешном изменении данных профиля
	</script>
</body>

</html>