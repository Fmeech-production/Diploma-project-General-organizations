<?php
header('Content-Type: application/json');

// Подключитесь к базе данных
include 'conectCOOKIE.php';

// Получите данные из формы
$login = $_POST['login'];
$password = md5($_POST['password'] . "соль");    //шифрование пароля
$sName = $_POST['sName'];
$name = $_POST['name'];
$pName = $_POST['pName'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$account_type = $_POST['account_type'];








$результат = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login'");   //проверка на существование пользователя
$user = $результат->fetch_assoc();
if ($user == null) {    //если пользователь не существует
	$sql = "INSERT INTO `users` (`Login`, `Password`, `SName`, `Name`, `PName`, `Email`, `Phone`, `Account-type`) VALUES ('$login', '$password', '$sName', '$name', '$pName', '$email', '$phone', '$account_type');";

	// Выполните запрос на добавление нового пользователя
	$result = mysqli_query($mysql, $sql);

	$path1 = 'users/' . $login . '/img';     //создание папки для аватарки и обложки
	mkdir($path1, 0777, true);

	$file1 = 'img/ava1.jpg';    //копирование аватарки и обложки
	$newfile1 = 'users/' . $login . '/img/1.png';
	copy($file1, $newfile1);

	$file2 = 'img/cover1.jpg';  //копирование аватарки и обложки
	$newfile2 = 'users/' . $login . '/img/2.png';
	copy($file2, $newfile2);

	// Верните результат в виде JSON
	echo json_encode(['success' => $result]);
	exit();
}
echo json_encode(['success' => false]);
