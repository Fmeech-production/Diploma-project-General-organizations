<?php error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'conectCOOKIE.php'; // Подключение к БД и проверка на авторизацию
if ($_COOKIE['language'] == 'eng')  // Проверка на язык
	include 'php_constructor/localization/localization_eng.php';    // Подключение файла с переводом на английский
else
	include 'php_constructor/localization/localization_ru.php';     // Подключение файла с переводом на русский
$Headline = $loc['Profile'];    // Заголовок страницы
$nav_select = 3;    // Выбор активного пункта меню
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title><?= $loc['Edit_Profile'] ?> </title>
	<link rel="stylesheet" href="css/CSSep.css">
	<link rel="stylesheet" href="css/css-all.css">
	<link rel="stylesheet" href="css/My_framevorke.css">
	<?php
	if (isset($_COOKIE['isDarkMode']) && $_COOKIE['isDarkMode'] == "true") {
		echo '<link rel="stylesheet" href="css/CSSep_Dark.css">';
	}
	?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="icons/logo1.png">
	<link rel="stylesheet" href="css/CSSep_mobail.css"> <!-- Подключение стилей для мобильных устройств -->
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
		include 'php_constructor/avatars-editor.php';   // Подключение редактора аватарок
		?>
		<main> <!-- Основной контент -->
			<form action="save_profil.php" method="post" id="block1"> <!-- Форма для отправки данных, изеняющаяя данные профиля -->
				<lable class="main-lable">*<?= $loc['Surname'] ?></lable>
				<input class="main-inpyt" placeholder="<?= $loc['Required_field_to_fill_in'] ?>" value="<?= $user['SName'] ?>" name="SName">
				<lable class="main-lable">*<?= $loc['Name'] ?></lable>
				<input class="main-inpyt" placeholder="<?= $loc['Required_field_to_fill_in'] ?>" value="<?= $user['Name'] ?>" name="Name">
				<lable class="main-lable"><?= $loc['Middle_name'] ?></lable>
				<input class="main-inpyt" placeholder="<?= $loc['Optional_field'] ?>" value="<?= $user['PName'] ?>" name="PName">
				<lable class="main-lable"><?= $loc['mail'] ?></lable>
				<input style="margin-bottom:3px;" class="main-inpyt" placeholder="<?= $loc['Optional_field'] ?>" value="<?= $user['Email'] ?>" name="Email">
				
				<input style="margin-left:9px;" type="checkbox" id="new_notification1" name="new_notification1" <?php if ($user['new_notification1'] == 1) echo "checked"?>>
				<lable style="width: calc(100% - 30px); margin-top:3px; " for="new_notification1" class="main-lable"><?= $loc['Присылать уведомления на почту при появлении новых сообщений'] ?></lable>
				<br>
				
				<input  style="margin-left:9px; margin-bottom:23px;"  type="checkbox" id="new_notification2" name="new_notification2" <?php if ($user['new_notification2'] == 1) echo "checked"?>>
				<lable style="width: calc(100% - 30px); margin-top:3px; margin-bottom:20px;" for="new_notification2" class="main-lable"><?= $loc['Присылать уведомления на почту при изменениях в заявках'] ?></lable>
				
				<lable class="main-lable"><?= $loc['Telephone'] ?></lable>
				<input class="main-inpyt" placeholder="<?= $loc['Optional_field'] ?>" value="<?= $user['Phone'] ?>" name="Phone">
				<button class="form-btn" type="submit"> <?= $loc['Save'] ?> </button> <!-- Кнопка для сохранения изменений -->
				<!--<button class="form-btn background-color-red exit-acc" onclick="document.cookie = 'login=;';">Выйти из аккаунта</button>-->
			</form>
		</main>
	</div>
	<script>
		showPopup('<?= $loc['Profile_data_has_been_successfully_updated'] ?>', 'error6'); // Вывод сообщения об успешном изменении данных профиля
	</script>
</body>

</html>