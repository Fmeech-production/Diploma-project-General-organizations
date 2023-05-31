<?php

if (!defined('ROOT_DIR'))
	define('ROOT_DIR', realpath(__DIR__));
require_once(ROOT_DIR . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');


use Fmeech2\Car;
use Fmeech2\ConnectSQL;
use Fmeech2\ConnectCOOKIE;

require_once 'conectCOOKIE.php'; // Подключение к БД и проверка на авторизацию




if ($_COOKIE['language'] == 'eng')
	include 'php_constructor/localization/localization_eng.php';
else
	include 'php_constructor/localization/localization_ru.php';

$id_booking = $_GET['id'];
$результатЗаявок = $mysql->query("SELECT * FROM `booking` WHERE `id` = '$id_booking'");
$Заявка = $результатЗаявок->fetch_assoc();

$Headline = "Заявка " . substr($Заявка['Day'], 8, 2) . "." . substr($Заявка['Day'], 5, 2) . " в " . $Заявка['Start_time'];
$nav_select = 2.5;


?>
<!DOCTYPE html>
<html>

<head>
	<?php include 'php_constructor/head.php'; ?>
	<link rel="stylesheet" href="css/My_framevorke.css">
</head>




<body>



	<?php
	include 'php_constructor/nav.php';
	?>

	<div class="wrap">

		<?php
		include 'php_constructor/header.php';
		?>
		<?php
		$id_user_booking =  $Заявка['IdUser'];

		$PeopleS = $mysql->query("SELECT * FROM `users` WHERE `id` = '$id_user_booking'");
		$People = $PeopleS->fetch_assoc();




		// Проверка на статус заявки
		// 1 - На рассмотрении
		if ($Заявка['Statys'] == 1) {
			$statys_text = "На рассмотрении";
			$img_patch = "icons/consideration1.png";
			$color_circle = "color-icons-grey"; ?>

			<main class="card mob_scroll">

				<div class="zaivka-stroka">
					<div class="zaivka-lable-card">Сотрудник:</div>
					<div class="zaivka-info-card"><?= $People['SName'] . " " . $People['Name'] . " " . $People['PName'] ?> </div>
				</div>
				<div class="zaivka-stroka">
					<div class="zaivka-lable-card">Место отправки:</div>
					<div class="zaivka-info-card"> <?= $Заявка['Start_road'] ?></div>
				</div>
				<div class="zaivka-stroka">
					<div class="zaivka-lable-card">Место прибытия:</div>
					<div class="zaivka-info-card"> <?= $Заявка['End_road'] ?></div>
				</div>
				<div class="zaivka-stroka">
					<div class="zaivka-lable-card">Дата отправки:</div>
					<div class="zaivka-info-card"> <?= substr($Заявка['Day'], 8, 2) . "." . substr($Заявка['Day'], 5, 2) . "." . substr($Заявка['Day'], 0, 4) ?></div>
				</div>
				<div class="zaivka-stroka">
					<div class="zaivka-lable-card">Желаемое время отправки:</div>
					<div class="zaivka-info-card"> <?= $Заявка['Start_time'] ?></div>
				</div>
				<!--<div class="zaivka-stroka">
					<div class="zaivka-lable-card">Время возвращения:</div>
					<div class="zaivka-info-card"> <?= $Заявка['End_time'] ?></div>
				</div>-->
				<div class="zaivka-stroka">
					<div class="zaivka-lable-card">Количество пассажиров:</div>
					<div class="zaivka-info-card"> <?= $Заявка['Number_people'] ?></div>
				</div>
				<div class="zaivka-stroka">
					<div class="zaivka-lable-card" style="margin-bottom:auto; margin-top:0;">Примечание:</div>
					<div class="zaivka-info-card"> <?= $Заявка['notes'] ?></div>
				</div>
				<div class="zaivka-stroka">
					<div class="zaivka-lable-card" style="margin-bottom:auto; margin-top:0;">Телефон:</div>
					<div class="zaivka-info-card"> +<?= $Заявка['telephone'] ?></div>
				</div>
				<div class="zaivka-stroka">
					<div class="zaivka-lable-card">Статус заявки:</div>
					<div class="zaivka-info-card"> <?= $statys_text ?></div>
				</div>
				<?php history($mysql, $Заявка); ?>
				<form class="" style="width: 100%; display:block;" action="Odobreno.php" method="post">
					<div style="">
						<lable class="main-lable">Выбрать автомобиль</lable>
						<select class="drivers_select" name="cars" id="cars" required>
							<option value="" disabled selected>Выберите автомобиль</option>
							<?php
							$cars = $mysql->query("SELECT * FROM cars");
							while ($car = $cars->fetch_assoc()) {
								echo '<option data-drivers="' . $car['drivers_id'] . '" value="' . $car['id'] . '">' . $car['license_plate'] . " - " . $car['make'] . " | " . $car['model'] . '</option>';
							}
							?>
						</select>

						<lable class="main-lable" style="margin-top: 10px;">Выбрать водителя (не обязательно)</lable>
						<select class="drivers_select" name="drivers" id="drivers">
							<option selected>Сначала выберите машину </option>
						</select>
						<script>
							$(document).ready(function() {
								$('#cars').change(function() {
									var carId = $(this).val();
									var drivers_idS = $(this).find(':selected').data('drivers');
									$.ajax({
										type: "POST",
										url: "php_constructor/get_drivers.php",
										data: {
											carId: carId,
											drivers_idS: drivers_idS
										},
										beforeSend: function() {
											console.log('Запрос на обновление водителей, после выбора машины отправлен!');
										},
										success: function(data) {
											$('#drivers').html(data);
											console.log('Пришёл ответ на отправленный запрос.');
										}
									});
								});
							});
						</script>

					</div>




					<div class="razdelitel" style="margin: 10px 0 0 5px;">
						<div class="left">
							<lable class="main-lable main-inpyt-left">Назначить время отправки:</lable>
							<input style="margin: 0px 0 0 5px;" class="main-inpyt  main-inpyt-left" name="Start_time" placeholder="" type="time" required value="<?= $Заявка['Start_time'] ?>">
						</div>
					</div>


					<div class="flex Odobreno-btn--Otcloneno">
						<input style="display: none;" value="<?= $Заявка['id'] ?>" name="id">
						<button class="form-btn-green btn__margin-right" name="submit2">Одобрить</button>
						<button class="form-btn-red btn__margin-left" name="submit4">Отклонить</button>
					</div>
				</form>
				<script>
					const approveBtn = document.querySelector('[name="submit2"]');
					const carsSelect = document.querySelector('#cars');
					approveBtn.addEventListener('click', () => {
						carsSelect.setAttribute('required', '');
					});

					const rejectBtn = document.querySelector('[name="submit4"]');
					rejectBtn.addEventListener('click', () => {
						carsSelect.removeAttribute('required');
					});
				</script>
			</main>




		<?php
		}
		// 2 - Одобрена
		else if ($Заявка['Statys'] == 2) {
			$statys_text = "Одобрена";
			$img_patch = "icons/confirmed1.png";
			$color_circle = "color-icons-green";
		?>

			<main class="card mob_scroll">
				<form class="flex" style="    
            margin: 0;
    width: auto;
    color: rgb(25, 27, 29);
    padding-top: 0;
    display:block;" action="Odobreno.php" method="post">
					<div class="zaivka-stroka">
						<div class="zaivka-lable-card">Место отправки:</div>
						<div class="zaivka-info-card"> <?= $Заявка['Start_road'] ?></div>
					</div>
					<div class="zaivka-stroka">
						<div class="zaivka-lable-card">Место прибытия:</div>
						<div class="zaivka-info-card"> <?= $Заявка['End_road'] ?></div>
					</div>
					<div class="zaivka-stroka">
						<div class="zaivka-lable-card">Дата отправки:</div>
						<div class="zaivka-info-card"> <?= substr($Заявка['Day'], 8, 2) . "." . substr($Заявка['Day'], 5, 2) . "." . substr($Заявка['Day'], 0, 4) ?></div>
					</div>

					<div class="razdelitel" style="margin: 10px 0 0 15px;">
						<div class="left">
							<lable class="main-lable main-inpyt-left">Назначенное время отправки:</lable>
							<input style="margin: 0px 0 0 5px;" class="main-inpyt  main-inpyt-left" name="Assigned_Start_time" placeholder="" type="time" required disabled value="<?= $Заявка['Assigned_Start_time'] ?>">
						</div>
					</div>
					<?php
					if ($user['Account-type'] == 3) { ?>
						<div style="margin: 10px 10px;">
							<div class="razdelitel">
								<div class="left">
									<lable class="main-lable main-lable2">Фактическое время отправки:</lable>
									<input class="main-inpyt main-inpyt3" placeholder="" type="time" required value="<?= $Заявка['Assigned_Start_time'] ?>" name="Finish_Start_time" style="margin-left: 5px;">
								</div>

								<div class="right">
									<lable class="main-lable main-lable2">Фактическое время возвращения:</lable>
									<input class="main-inpyt main-inpyt3" placeholder="" type="time" required value="<?= $Заявка['End_time'] ?>" name="End_time" style="margin-left: 5px;">
								</div>
							</div>
						</div>
					<?php } else { ?>
					<?php }
					?>
					<!--<div style="margin: 10px 10px;">
						<div class="razdelitel">
							<div class="left">
								<lable class="main-lable main-lable2">Назначенное время отправки:</lable>
								<input class="main-inpyt main-inpyt3" placeholder="" type="time" required value="<?= $Заявка['Assigned_Start_time'] ?>" name="Start_time">
							</div>

							<div class="right">
								<lable class="main-lable main-lable2">Время возвращения:</lable>
								<input class="main-inpyt main-inpyt3" placeholder="" type="time" required value="<?= $Заявка['End_time'] ?>" name="End_time">
							</div>
						</div>
					</div>-->

					<div class="zaivka-stroka">
						<div class="zaivka-lable-card">Количество пассажиров:</div>
						<div class="zaivka-info-card"> <?= $Заявка['Number_people'] ?></div>
					</div>
					<div class="zaivka-stroka">
						<div class="zaivka-lable-card" style="margin-bottom:auto; margin-top:0;">Примечание:</div>
						<div class="zaivka-info-card"> <?= $Заявка['notes'] ?></div>
					</div>
					<div class="zaivka-stroka">
						<div class="zaivka-lable-card" style="margin-bottom:auto; margin-top:0;">Телефон:</div>
						<div class="zaivka-info-card"> +<?= $Заявка['telephone'] ?></div>
					</div>
					<div class="zaivka-stroka">
						<div class="zaivka-lable-card">Статус заявки:</div>
						<div class="zaivka-info-card color-green"> Одобрена</div>
					</div>
					<div class="zaivka-stroka">
						<div class="zaivka-lable-card">Автомобиль:</div>
						<div class="zaivka-info-card color-green">
							<?php
							$carName = Car::getNameCar($Заявка['car_id']);
							if ($carName != "")
								echo $carName;
							else
								echo "Автомобиль не выбран";
							?>
						</div>
					</div>
					<?php
					$driverID = $Заявка['driver_id'];

					$driver = $mysql->query("SELECT * FROM users WHERE id = $driverID");

					$driver = $driver->fetch_assoc();
					?>
					<div class="zaivka-stroka">
						<div class="zaivka-lable-card">Водитель:</div>
						<div class="zaivka-info-card">
							<?php
							if ($driverID == 0 || $driverID == null) {
								echo "Водитель не выбран";
							} else {
								echo $driver['SName'] . " " . $driver['Name'] . " " . $driver['PName'];
							}
							?>

						</div>
					</div>
					<?php history($mysql, $Заявка); ?>



					<input style="display: none;" value="<?= $Заявка['id'] ?>" name="id">
					<?php
					if ($user['Account-type'] == 3) { ?>
						<button class="form-btn" name="submit3">Подтвердить</button>
					<?php } else { ?>
					<?php }
					?>

				</form>





			</main>



		<?php
		}
		// 3 - Завершена
		else if ($Заявка['Statys'] == 3) {
			$statys_text = "Завершена";
			$img_patch = "icons/completed1.png";
			$color_circle = "color-icons-blue";
		?>
			<main class="card mob_scroll">

				<div class="zaivka-stroka">
					<div class="zaivka-lable-card">Сотрудник:</div>
					<div class="zaivka-info-card"> <?= $People['SName'] . " " . $People['Name'] . " " . $People['PName'] ?></div>
				</div>
				<div class="zaivka-stroka">
					<div class="zaivka-lable-card">Место отправки:</div>
					<div class="zaivka-info-card"> <?= $Заявка['Start_road'] ?></div>
				</div>
				<div class="zaivka-stroka">
					<div class="zaivka-lable-card">Место прибытия:</div>
					<div class="zaivka-info-card"><?= $Заявка['End_road'] ?></div>
				</div>
				<div class="zaivka-stroka">
					<div class="zaivka-lable-card">Дата отправки:</div>
					<div class="zaivka-info-card"> <?= substr($Заявка['Day'], 8, 2) . "." . substr($Заявка['Day'], 5, 2) . "." . substr($Заявка['Day'], 0, 4) ?></div>
				</div>

				<div class="zaivka-stroka">
					<div class="zaivka-lable-card">Время отправки:</div>
					<div class="zaivka-info-card"> <?= $Заявка['Finish_Start_time'] ?></div>
				</div>
				<div class="zaivka-stroka">
					<div class="zaivka-lable-card">Время возвращения:</div>
					<div class="zaivka-info-card"> <?= $Заявка['End_time'] ?></div>
				</div>

				<div class="zaivka-stroka">
					<div class="zaivka-lable-card">Количество пассажиров:</div>
					<div class="zaivka-info-card"> <?= $Заявка['Number_people'] ?></div>
				</div>
				<div class="zaivka-stroka">
					<div class="zaivka-lable-card" style="margin-bottom:auto; margin-top:0;">Примечание:</div>
					<div class="zaivka-info-card"> <?= $Заявка['notes'] ?></div>
				</div>
				<div class="zaivka-stroka">
					<div class="zaivka-lable-card" style="margin-bottom:auto; margin-top:0;">Телефон:</div>
					<div class="zaivka-info-card"> +<?= $Заявка['telephone'] ?></div>
				</div>
				<div class="zaivka-stroka">
					<div class="zaivka-lable-card">Статус заявки:</div>
					<div class="zaivka-info-card color-green"> Завершена</div>
				</div>
				<?php
				$driver = $mysql->query("SELECT  drivers.*, users.*, cars.*, drivers.id as id
					FROM drivers
					LEFT JOIN users ON drivers.user_id = users.id
					LEFT JOIN cars ON drivers.car_id = cars.id
					WHERE drivers.id = " . $Заявка['driver_id']);

				$driver = $driver->fetch_assoc();
				?>
				<div class="zaivka-stroka">
					<div class="zaivka-lable-card">Водитель:</div>
					<div class="zaivka-info-card"> <?= $driver['SName'] . " " . $driver['Name'] . " " . $driver['PName'] ?></div>
				</div>
				<?php history($mysql, $Заявка); ?>

				<button class="form-btn" onclick="window.location.href = 'all_Bookeds.php';">Назад</button>


			</main>

		<?php
		}
		// 4 - Отклонена
		else if ($Заявка['Statys'] == 4) {
			$statys_text = "Отклонена";
			$img_patch = "icons/rejected2.png";
			$color_circle = "color-icons-red";  ?>
			<main class="card mob_scroll">

				<div class="zaivka-stroka">
					<div class="zaivka-lable-card">Сотрудник:</div>
					<div class="zaivka-info-card"> <?= $People['SName'] . " " . $People['Name'] . " " . $People['PName'] ?></div>
				</div>
				<div class="zaivka-stroka">
					<div class="zaivka-lable-card">Место отправки:</div>
					<div class="zaivka-info-card"> <?= $Заявка['Start_road'] ?></div>
				</div>
				<div class="zaivka-stroka">
					<div class="zaivka-lable-card">Место прибытия:</div>
					<div class="zaivka-info-card"><?= $Заявка['End_road'] ?></div>
				</div>
				<div class="zaivka-stroka">
					<div class="zaivka-lable-card">Дата отправки:</div>
					<div class="zaivka-info-card"> <?= $Заявка['Day'] ?></div>
				</div>

				<div class="zaivka-stroka">
					<div class="zaivka-lable-card">Время отправки:</div>
					<div class="zaivka-info-card"> <?= $Заявка['Start_time'] ?></div>
				</div>
				<div class="zaivka-stroka">
					<div class="zaivka-lable-card">Время возвращения:</div>
					<div class="zaivka-info-card"> <?= substr($Заявка['Day'], 8, 2) . "." . substr($Заявка['Day'], 5, 2) . "." . substr($Заявка['Day'], 0, 4) ?></div>
				</div>

				<div class="zaivka-stroka">
					<div class="zaivka-lable-card">Количество пассажиров:</div>
					<div class="zaivka-info-card"> <?= $Заявка['Number_people'] ?></div>
				</div>
				<div class="zaivka-stroka">
					<div class="zaivka-lable-card">Статус заявки:</div>
					<div class="zaivka-info-card color-red"> Отклонена</div>
				</div>
				<?php history($mysql, $Заявка); ?>

				<button class="form-btn" onclick="window.location.href = 'all_Bookeds.php';">Назад</button>


			</main>

		<?php
		}
		?>






	</div>

	<script src="js/constructor.js">
	</script>
	<script>
		showPopup(<?= "'" . $loc['Новая заявка оставлена успешно!'] . "'" ?>, 'error7');
	</script>
</body>

</html>

<?php
function history($mysql, $Заявка)
{ ?>
	<div class="zaivka-stroka">
		<div class="zaivka-lable-card" style="margin-left: auto; margin-right: 10px; text-align: right; cursor:help;" title="
<?php

	$history = $mysql->query("SELECT  booking_log.*, users.*, booking_log.id as id
FROM `booking_log`
LEFT JOIN users ON booking_log.user_id = users.id
WHERE booking_log.booking_id = " . $Заявка['id']);



	//$history = $mysql->query("SELECT * FROM `booking_log` WHERE `booking_id` =  ".$Заявка['id']." ORDER BY `id` DESC");
	echo "История изменений этой заявки.\n\n";
	while ($log = $history->fetch_assoc()) {
		echo $Day = date('d.m.y в H:i', strtotime($log['time'])) . " - " . $log['action'] . "  |  " . $log['SName'] . " " . $log['Name'] . " " . $log['PName']  . "\n";
	}
?>">История изменений этой заявки</div>
	</div>
<?php
}
