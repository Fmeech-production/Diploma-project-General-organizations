<?php include 'conectCOOKIE.php';
if ($_COOKIE['language'] == 'eng')
	include 'php_constructor/localization/localization_eng.php';
else
	include 'php_constructor/localization/localization_ru.php';


$Headline = $loc['Забронированные поездки'];
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

		<main style="padding-top: 10px;" class="table_organizer">
			<?php

			$результатЗаявок = $mysql->query("SELECT * FROM `booking` WHERE `IdUser` = '$userId' ORDER BY `booking`.`id` DESC");
			$количествоЗаявок = mysqli_num_rows($результатЗаявок);
			$schetchick = 1;
			$Заявка = $результатЗаявок->fetch_assoc();
			while ($Заявка != null) {
				if ($Заявка['Statys'] == 1) {
					$statys_text = $loc['На рассмотрении'];
					$img_patch = "icons/consideration1.png";
					$color_circle = "color-icons-grey";
				} else if ($Заявка['Statys'] == 2) {
					$statys_text = $loc['Прочитана'];
					$img_patch = "icons/confirmed1.png";
					$color_circle = "color-icons-green";
				} else if ($Заявка['Statys'] == 3) {
					$statys_text = $loc['Завершена'] ;
					$img_patch = "icons/completed1.png";
					$color_circle = "color-icons-blue";
				} else if ($Заявка['Statys'] == 4) {
					$statys_text = $loc['Отклонена'];
					$img_patch = "icons/rejected2.png";
					$color_circle = "color-icons-red";
				}

				$time_has_passed = time() - $Заявка['Time_of_change'];

				if ($time_has_passed > 60 * 60 * 24)
					$time_has_passed = floor($time_has_passed / 60 / 60 / 24) . $loc['дней назад']  ;
				else if ($time_has_passed > 60 * 60)
					$time_has_passed = floor($time_has_passed / 60 / 60) .  $loc['часов назад'] ;
				else if ($time_has_passed > 60)
					$time_has_passed = floor($time_has_passed / 60) .  $loc['минут назад'] ;
				else if ($time_has_passed > 0)
					$time_has_passed = $time_has_passed .   $loc['секунд назад'];


			?>
				<div class="zaivka  <?php if ($количествоЗаявок == $schetchick) echo "zaivka-edit"; ?>" onclick="window.location.href = 'BookedTrips_Information_worker_narcology.php?id=<?= $Заявка['id'] ?>';">
					<div class="zaivka-top">
						<span class="black-circle <?= $color_circle ?>"></span>
						<div class="zaivka-time">Заявка <?= substr($Заявка['Day'], 8, 2) . "." . substr($Заявка['Day'], 5, 2) ?> в <?= $Заявка['Start_time'] ?></div>
						<div class="zaivka-status-div-img <?= $color_circle ?>">
							<img class="zaivka-status-img" src="<?= $img_patch ?>">
						</div>
					</div>
					<div class="zaivka-status"><?= $statys_text ?> <span class="mini-circle"></span><?= $time_has_passed ?></div>

				</div>




			<?php
				$schetchick++;
				$Заявка = $результатЗаявок->fetch_assoc();
			}
			?>







		</main>
	</div>

	<script src="js/constructor.js"></script>

	<script src="js/constructor.js">
	</script>
	<script>
		if (getZapros == 'error7')
			showPopup(<?= "'" . $loc['Новая заявка оставлена успешно!'] . "'" ?>, 'error7');
	</script>
</body>

</html>