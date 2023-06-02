<?php
ob_start(); // Включаем буферизацию вывода
if (isset($_FILES['img_loader'])) {
	// файл был отправлен    

	ob_start(); // Включаем буферизацию вывода


	include '../conectCOOKIE.php';

	$userId = $user['id']; // изменить обложу своего профиля



	$name_fale = rand();
	$name_fale = $name_fale . '.jpg';
	$path = '../users/' . $login . '/' . 'img/' . $name_fale;

	if (move_uploaded_file($_FILES['img_loader']['tmp_name'], $path)) {

		echo $_FILES['img_loader']['name'] . ' успешно загружен';
		$mysql->query("UPDATE `users` SET 
`cover` = '$name_fale'
WHERE `users`.`id` = '$userId'");
	} else {
		echo 'Ошибка загрузки файла';
	}


	header('Location: /Edit Profile.php?error=error6');
}
