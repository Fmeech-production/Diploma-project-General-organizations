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
		<main> <!-- Основной контент страницы -->
			<form action="new-bronirovanie.php" method="post" class="form_main_1">
				<lable class="main-lable"><?= $loc['Место отправления'] ?></lable>
				<input class="main-inpyt" name="Start_road" placeholder="<?= $loc['Можете оставить это поле пустым, если собираетесь ехать из наркологии'] ?>">
				<lable class="main-lable"><?= $loc['Куда едим?'] ?></lable>
				<input class="main-inpyt" name="End_road" placeholder="<?= $loc['Можете оставить это поле пустым, если собираетесь приехать в наркологию'] ?>">
				<lable class="main-lable"><?= $loc['Дата отправки'] ?></lable>
				<input class="main-inpyt" name="Day" placeholder="<?= $loc['Можете оставить это поле пустым, если собираетесь ехать сегодня'] ?>" type="date" required>
				<div class="razdelitel">
					<div class="left">
						<lable class="main-lable main-inpyt-left"><?= $loc['Планируемое время отъезда'] ?></lable>
						<input class="main-inpyt  main-inpyt-left" name="Start_time" placeholder="" type="time" required>
					</div>
					<!--
					<div class="right">
						<lable class="main-lable main-inpyt-right">Когда планируете прибыть?</lable>
						<input class="main-inpyt main-inpyt2 main-inpyt-right" name="End_time" placeholder="" type="time" >
					</div>
					-->
				</div>
				<lable class="main-lable"><?= $loc['Планируемое количество человек'] ?></lable>
				<input class="main-inpyt" name="Number_people" placeholder="<?= $loc['Можете оставить это поле пустым, если едите в одиночку'] ?>">
				<lable class="main-lable"><?= $loc['Примечание'] ?></lable>
				<input class="main-inpyt" name="notes" placeholder="<?= $loc['Optional_field'] ?>" maxlength="4000">
				<lable class="main-lable"><?= $loc['Телефон'] ?></lable>
				<input class="main-inpyt" name="telephone" placeholder="<?= $loc['Optional_field'] ?>" maxlength="32">
				<button class="form-btn"><?= $loc['Оставить заявку'] ?></button>
			</form>
		</main>
	</div>
	<script>
		showPopup(<?= "'" . $loc['Новая заявка оставлена успешно!'] . "'" ?>, 'error7'); // Вывод сообщения об успешном создании заявки
	</script>
</body>

</html>