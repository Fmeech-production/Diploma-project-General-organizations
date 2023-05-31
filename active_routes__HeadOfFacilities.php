<?php include 'conectCOOKIE.php';
if ($_COOKIE['language'] == 'eng')
	include 'php_constructor/localization/localization_eng.php';
else
	include 'php_constructor/localization/localization_ru.php';

if ($user['Account-type'] == 1) {
	$Headline = $loc['Активные маршруты'];
	$nav_select = 2;
} else if ($user['Account-type'] == 2) {
	$Headline = $loc['Активные маршруты'];
	$nav_select = 2.5;
} else if ($user['Account-type'] == 3) {
	$Headline = $loc['Активные маршруты'];
	$nav_select = 2.5;
}

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
		include 'php_constructor/header.php';   // Подключение шапки
		include 'php_constructor/table.php';   // Подключение таблицы
		table("SELECT * FROM `booking` WHERE `Statys` = '2' ORDER BY `booking`.`id` DESC", $mysql);    // Вывод таблицы с заявками в статусе "Активный"
		?>
	</div>


	<script>
		showPopup(<?= "'" . $loc['Новая заявка оставлена успешно!'] . "'" ?>, 'error7');
	</script>
</body>

</html>