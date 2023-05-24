<?php include 'conectCOOKIE.php';   // Подключение к БД и проверка на авторизацию
if ($_COOKIE['language'] == 'eng')  // Проверка на язык
	include 'php_constructor/localization/localization_eng.php';    // Подключение файла с переводом на английский
else
	include 'php_constructor/localization/localization_ru.php';    // Подключение файла с переводом на русский
$Headline = $loc['Бронирование'];   // Заголовок страницы
$nav_select = 1;    // Выбор активного пункта меню
?>
<!DOCTYPE html>
<html>

<head>
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
	<link rel="stylesheet" href="css/CSSep_mobail.css?t=<?php echo (microtime(true) . rand()); ?>"> <!-- Подключение стилей для мобильных устройств -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Подключение jQuery -->
	<script src="js/constructor.js"></script> <!-- Подключение скриптов для работы popup -->
</head>

<body>
	<?php
	include 'php_constructor/nav.php';  // Подключение меню
	?>
	<div class="wrap"> <!-- Обертка для контента -->
		<?php
		include 'php_constructor/header.php';   // Подключение шапки
		?>
		<main> <!-- Основной контент страницы -->
			<form action="new-bronirovanie.php" method="post" class="form_main_1">
				<lable class="main-lable">Место отправления</lable>
				<input class="main-inpyt" name="Start_road" placeholder="Можете оставить это поле пустым, если собираетесь ехать из наркологии">
				<lable class="main-lable">Куда едим?</lable>
				<input class="main-inpyt" name="End_road" placeholder="Можете оставить это поле пустым, если собираетесь приехать в наркологию">
				<lable class="main-lable">Дата отправки</lable>
				<input class="main-inpyt" name="Day" placeholder="Можете оставить это поле пустым, если собираетесь ехать сегодня" type="date" required>
				<div class="razdelitel">
					<div class="left">
						<lable class="main-lable main-inpyt-left">Планируемое время отъезда</lable>
						<input class="main-inpyt  main-inpyt-left" name="Start_time" placeholder="" type="time" required>
					</div>
					<!--
					<div class="right">
						<lable class="main-lable main-inpyt-right">Когда планируете прибыть?</lable>
						<input class="main-inpyt main-inpyt2 main-inpyt-right" name="End_time" placeholder="" type="time" >
					</div>
					-->
				</div>
				<lable class="main-lable">Планируемое количество человек</lable>
				<input class="main-inpyt" name="Number_people" placeholder="Можете оставить это поле пустым, если едите в одиночку">
				<lable class="main-lable">Примечание</lable>
				<input class="main-inpyt" name="notes" placeholder="<?= $loc['Optional_field'] ?>" maxlength="4000">
				<lable class="main-lable">Телефон</lable>
				<input class="main-inpyt" name="telephone" placeholder="<?= $loc['Optional_field'] ?>" maxlength="32">
				<button class="form-btn">Оставить заявку</button>
			</form>
		</main>
	</div>
	<script>
		showPopup(<?= "'" . $loc['Новая заявка оставлена успешно!'] . "'" ?>, 'error7'); // Вывод сообщения об успешном создании заявки
	</script>
</body>

</html>