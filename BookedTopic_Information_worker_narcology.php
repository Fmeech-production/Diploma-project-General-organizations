<?php
if (!defined('ROOT_DIR'))
	define('ROOT_DIR', realpath(__DIR__));
require_once(ROOT_DIR . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');


use Fmeech2\ConnectSQL;
use Fmeech2\ConnectCOOKIE;

error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'conectCOOKIE.php';
if ($_COOKIE['language'] == 'eng')
	include 'php_constructor/localization/localization_eng.php';
else
	include 'php_constructor/localization/localization_ru.php';

$id_booking = $_GET['id'];
$результатЗаявок = $mysql->query("SELECT * FROM `topics` WHERE `id` = '$id_booking'");
$Заявка = $результатЗаявок->fetch_assoc();

$Headline = "Заявка " . date('d.m', strtotime($Заявка['date'])) . " в " . date('H:i', strtotime($Заявка['date']));
if ($user['Account-type'] == 0) {
	$nav_select = 2.7;
} else if ($user['Account-type'] == 1) {
	$nav_select = 0;
} else if ($user['Account-type'] == 2) {
	$nav_select = 0;
} else if ($user['Account-type'] == 3) {
	$nav_select = 0;
}
//Функция substr имеет параметры: строка, начало, конец

$idUserSerch = $Заявка['sender_id'];

$результатЮзеров = $mysql->query("SELECT * FROM `users` WHERE `id` = '$idUserSerch'");
$Найденый_юзер = $результатЮзеров->fetch_assoc();



?>
<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="css/CSSbti.css">
	<?php include 'php_constructor/head.php'; ?>

	<style>
		.zaivka-lable-card {
			align-self: flex-start;
			margin-top: 0;
		}

		.card {

			overflow-y: auto;
			max-height: calc(100% - 92px - 10px - 12px - 10px - 24px - 70px);
			border-radius: 15px 15px 0 0;
			margin-bottom: 0;
		}
	</style>
	<link rel="stylesheet" href="css/CSSep_mobail.css?t=<?php echo (microtime(true) . rand()); ?>">
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

			if ($user['Account-type'] == 2) {
				// пометить что эту заявку читали работники, при первом открытии заявки
				$result = $mysql->query("UPDATE topics SET Statys = 2 WHERE id = '$id_booking' AND Statys = 1");
			}
			// определение текста статуса в зависимости от значения в БД
			if ($Заявка['Statys'] == 1) {
				$statys_text = $loc['На рассмотрении'];
				$img_patch = "icons/consideration1.png";
				$color_circle = "color-icons-grey";
				$color_read = " color-grey-not-read";
			} else if ($Заявка['Statys'] == 2) {
				$statys_text = $loc['Прочитана'];
				$img_patch = "icons/see2.png";
				$color_circle = "color-icons-grey";
				$color_read = " ";
			} else if ($Заявка['Statys'] == 3) {
				$statys_text = $loc['Завершена'] ;
				$img_patch = "icons/check_mark1.png";
				$color_circle = "color-icons-green";
				$color_read = " ";
			} else if ($Заявка['Statys'] == 4) {
				$statys_text = $loc['Отклонена'];
				$img_patch = "icons/close.png";
				$color_circle = "color-icons-red";
				$color_read = " ";
			}
			?>

			<div class="zaivka-stroka">
				<div class="zaivka-lable-card"><?= $loc['ФИО отправителя:'] ?></div>
				<div class="zaivka-info-card"><?= $Найденый_юзер['SName'] . " " . $Найденый_юзер['Name'] . " " . $Найденый_юзер['PName'] ?></div>
			</div>
			<div class="zaivka-stroka">
				<div class="zaivka-lable-card"> <?= $loc['Статус заявки:'] ?> </div>
				<div class="zaivka-info-card"> <?= $statys_text ?></div>
			</div>
			<div class="zaivka-stroka">
				<div class="zaivka-lable-card"><?= $loc['Отделение:'] ?> </div>
				<div class="zaivka-info-card"><?= $Заявка['department_id'] ?></div>
			</div>
			<div class="zaivka-stroka">
				<div class="zaivka-lable-card"> <?= $loc['Кабинет:'] ?> </div>
				<div class="zaivka-info-card"><?= $Заявка['room_id'] ?></div>
			</div>
			<div class="zaivka-stroka">
				<div class="zaivka-lable-card"> <?= $loc['Дата написания заявки:'] ?> </div>
				<div class="zaivka-info-card"><?= date('d.m.Y в H:i', strtotime($Заявка['date'])) ?></div>
			</div>
			<div class="zaivka-stroka">
				<div class="zaivka-lable-card"> <?= $loc['Мини-тема:'] ?> </div>
				<div class="zaivka-info-card"><?= $Заявка['mini_topic'] ?></div>
			</div>
			<div class="zaivka-stroka">
				<div class="zaivka-lable-card"> <?= $loc['Описание проблемы:'] ?> </div>
				<div class="zaivka-info-card"><?= $Заявка['description'] ?></div>
			</div>


			<div class="chat__messages">
				<?php
				$Сообщения = mysqli_query($mysql, "SELECT * FROM `topics_messages` WHERE `id_topics` = '$id_booking' ORDER BY `id` ASC");
				if (mysqli_num_rows($Сообщения) > 0) {
					while ($Сообщение = $Сообщения->fetch_assoc()) {
						//следующая строчка кода явно очень плохо написана, но у меня сейчас нет времени на докручивание этого момента, кто будет пользоваться, извините :((
						$Найденый_юзер = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT * FROM `users` WHERE `id` = '" . $Сообщение['user_id'] . "'"));
						if ($Найденый_юзер['Login'] == $_COOKIE['login']) {
							$position = "left";
							$color = "color-icons-grey";
						} else {
							$position = "right";
							$color = "color-icons-blue";
						}
				?>
						<div class="chat__message chat__message--<?= $position ?>">
							<div class="chat__message__avatar">
								<img src="/users/<?= $Найденый_юзер['Login'] ?>/img/<?= $Найденый_юзер['ava'] ?>" alt="">
							</div>
							<div class="chat__message__text">
								<div class="chat__message__name">
									<div class="chat__message__name_name"><?= $Найденый_юзер['SName'] . " " . $Найденый_юзер['Name'] . " " . $Найденый_юзер['PName'] ?></div>
									<div class="chat__message__date"> <?= date('d.m.Y в H:i', strtotime($Сообщение['time'])) ?></div>
								</div>
								<div class="chat__message__text--<?= $position ?>">
									<?= $Сообщение['message'] ?>
								</div>
							</div>
						</div>
				<?php
					}
				}
				?>

			</div>



		</main>
		<script>
			var container = document.querySelector('.card');
			container.scrollTop = container.scrollHeight;
		</script>
		<form action="message_send.php" method="post" class="Sending_message__container" id="messageForm">
			<div class="Sending_message" onclick="submitForm()" role="button">
				<img src="icons/Sending_message4.png" class="Sending_message-img">
			</div>
			<input class="chat" placeholder="<?= $loc['Введите сообщение'] ?>" type="text" name="message" id="message" autocomplete="off" maxlength="2000" required>
			<input name="id_topics" style="display: none;" value="<?php echo $id_booking; ?>">
		</form>
		
		<script>
			function submitForm() {
				document.getElementById("messageForm").submit();
			}

			// отправка формы по нажатию Enter
			document.getElementById("message").addEventListener("keydown", function(event) {
				if (event.keyCode === 13) { // 13 - код клавиши Enter
					event.preventDefault(); // отменяем стандартное поведение (перенос строки)
					document.getElementById("messageForm").submit(); // отправляем форму
				}
			});
		</script>




	</div>

	<script src="js/constructor.js"></script>
</body>

</html>