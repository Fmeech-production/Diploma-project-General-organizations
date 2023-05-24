<?php include 'conectCOOKIE.php';
if ($_COOKIE['language'] == 'eng')
	include 'php_constructor/localization/localization_eng.php';
else
	include 'php_constructor/localization/localization_ru.php';


$Headline = $loc['Все заявки'];
$nav_select = 2.7;


?>
<!DOCTYPE html>
<html>

<head>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<meta charset="utf-8">
	<title><?= $Headline ?> </title>
	<link rel="stylesheet" href="css/CSSep.css">
	<link rel="stylesheet" href="css/CSSpa.css">
	<link rel="stylesheet" href="css/css-all.css">
	<link rel="stylesheet" href="css/My_framevorke.css">
	<?php if ($_COOKIE['isDarkMode'] == "true")
		echo '<link rel="stylesheet" href="css/CSSep_Dark.css">';
	?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="icons/logo1.png">
	<link rel="stylesheet" href="css/CSSep_mobail.css?t=<?php echo(microtime(true).rand()); ?>">
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
			if ($user['Account-type'] == 2) {
				// выборка всех заявок из БД
				$result = $mysql->query("SELECT * FROM `topics` ORDER BY `id` DESC");
			} else {
				// выборка всех заявок пользователя из БД
				$result = $mysql->query("SELECT * FROM `topics` WHERE `sender_id` = '$userId' ORDER BY `id` DESC");
			}
			while ($row = $result->fetch_assoc()) {
				// определение текста статуса в зависимости от значения в БД
				if ($row['Statys'] == 1) {
					$status_text = "На рассмотрении";
					$img_patch = "icons/consideration1.png";
					$color_circle = "color-icons-grey";
				} else if ($row['Statys'] == 2) {
					$status_text = "Одобрена";
					$img_patch = "icons/confirmed1.png";
					$color_circle = "color-icons-green";
				} else if ($row['Statys'] == 3) {
					$status_text = "Завершена";
					$img_patch = "icons/completed1.png";
					$color_circle = "color-icons-blue";
				} else if ($row['Statys'] == 4) {
					$status_text = "Отклонена";
					$img_patch = "icons/rejected2.png";
					$color_circle = "color-icons-red";
				}

				// вычисление времени, прошедшего с момента отправки заявки
				$time_has_passed = time() - strtotime($row['date']);

				if ($time_has_passed > 60 * 60 * 24)
					$time_has_passed = floor($time_has_passed / 60 / 60 / 24) . " дней назад";
				else if ($time_has_passed > 60 * 60)
					$time_has_passed = floor($time_has_passed / 60 / 60) . " часов назад";
				else if ($time_has_passed > 60)
					$time_has_passed = floor($time_has_passed / 60) . " минут назад";
				else if ($time_has_passed > 0)
					$time_has_passed = $time_has_passed . " секунд назад";
			?>
				<div class="zaivka <?php if ($result->num_rows == 1) echo "zaivka-edit"; ?>" onclick="window.location.href = 'BookedTopic_Information_worker_narcology.php?id=<?= $row['id'] ?>';">
					<div class="zaivka-top">
						<span class="black-circle <?= $color_circle ?>"></span>
						<div class="zaivka-time">Заявка <?= date('d.m', strtotime($row['date'])) ?> в <?= date('H:i', strtotime($row['date'])) ?></div>
						<div class="zaivka-status-div-img <?= $color_circle ?>">
							<img class="zaivka-status-img" src="<?= $img_patch ?>">
						</div>
					</div>
					<div class="zaivka-status"><?= $status_text ?> <span class="mini-circle"></span><?= $time_has_passed ?></div>
					<div class="zaivka-description"><?= $row['description'] ?></div>
				</div>
			<?php
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