<?php 
if (!defined('ROOT_DIR'))
define('ROOT_DIR', realpath(__DIR__));
require_once(ROOT_DIR . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');


use Fmeech2\ConnectSQL;
use Fmeech2\ConnectCOOKIE;

include 'conectCOOKIE.php';
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
			if ($user['Account-type'] == 2) {
				// выборка всех заявок из БД
				$result = $mysql->query("SELECT * FROM `topics` ORDER BY `id` DESC");
			} else {
				// выборка всех заявок пользователя из БД
				$result = $mysql->query("SELECT * FROM `topics` WHERE `sender_id` = '$userId' ORDER BY `id` DESC");
			}
			if ($result->num_rows === 0) {
				echo "<div style='    display: flex;
				justify-content: center;
				margin-top: 10px;
				font-size: 24px;
				color: gray;'>Пока нет заявок</div>";
			}
			while ($row = $result->fetch_assoc()) {
				// определение текста статуса в зависимости от значения в БД
				if ($row['Statys'] == 1) {
					$status_text = "На рассмотрении";
					$img_patch = "icons/consideration1.png";
					$color_circle = "color-icons-grey";
					$color_read = " color-grey-not-read";					
				} else if ($row['Statys'] == 2) {
					$status_text = "Прочитана";
					$img_patch = "icons/see2.png";
					$color_circle = "color-icons-grey";
					$color_read = " ";	
				} else if ($row['Statys'] == 3) {
					$status_text = "Завершена";
					$img_patch = "icons/check_mark1.png";
					$color_circle = "color-icons-green";
					$color_read = " ";	
				} else if ($row['Statys'] == 4) {
					$status_text = "Отклонена";
					$img_patch = "icons/close.png";
					$color_circle = "color-icons-red";
					$color_read = " ";	
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
				<div class="zaivka <?php echo $color_read; if ($result->num_rows == 1) echo "zaivka-edit"; ?>" onclick="window.location.href = 'BookedTopic_Information_worker_narcology.php?id=<?= $row['id'] ?>';">
					<div title="<?php echo $status_text ?>" class="zaivka-top">
						<span class="black-circle <?= $color_circle ?>"></span>
						<div class="zaivka-time">Заявка <?= date('d.m', strtotime($row['date'])) ?> в <?= date('H:i', strtotime($row['date'])) ?></div>
						<div class="zaivka-status-div-img <?= $color_circle ?>">
							<img class="zaivka-status-img" src="<?= $img_patch ?>">
						</div>
					</div>
					<div title="<?php echo $row['description'] ?>" class="zaivka-status"><?= $status_text ?> <span class="mini-circle"></span><?= $time_has_passed ?></div>
					<div  title="<?php echo $row['description'] ?>" class="zaivka-description"><?= $row['new_message'] ?></div>
				</div>
			<?php
			}
			?>



		</main>
	</div>


	<script>
		if (getZapros == 'error7')
			showPopup(<?= "'" . $loc['Новая заявка оставлена успешно!'] . "'" ?>, 'error7');
	</script>
</body>

</html>