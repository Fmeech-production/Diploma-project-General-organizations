<?php include 'conectCOOKIE.php';       // Подключение к БД и проверка на авторизацию
if ($_COOKIE['language'] == 'eng')  // Подключение локализации
	include 'php_constructor/localization/localization_eng.php';
else
	include 'php_constructor/localization/localization_ru.php';
$Headline = $loc['Новые заявки'];   // Заголовок страницы
$nav_select = 1;               // Выбор активного пункта меню
if ($user['Account-type'] == 2)
	$nav_select = 2.6;
?>
<!DOCTYPE html>
<html>

<head>
	<?php include 'php_constructor/head.php'; ?>
	<link rel="stylesheet" href="css/My_framevorke.css">
</head>

<body>
	<?php
	include 'php_constructor/nav.php';  // Подключение меню
	?>
	<div class="wrap">
		<?php
		include 'php_constructor/header.php';   // Подключение шапки
		include 'php_constructor/table.php';   // Подключение таблицы
		table("SELECT * FROM `booking` WHERE `Statys` = '1' ORDER BY `booking`.`id` DESC", $mysql);    // Вывод таблицы с заявками в которых статус "Новая"
		?>
	</div>
	<script>
		showPopup(<?= "'" . $loc['Новая заявка оставлена успешно!'] . "'" ?>, 'error7');
	</script>
</body>

</html>