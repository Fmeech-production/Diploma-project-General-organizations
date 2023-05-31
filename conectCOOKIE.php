<?php
include 'conectSQL.php';

if (isset($_COOKIE['login']) && isset($_COOKIE['password'])) {
	$login = $_COOKIE['login'];
	$password = $_COOKIE['password'];

	$результат = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
	$user = $результат->fetch_assoc();
	
	if ($user == null) {
		include 'login.php';
		exit();
	}
} 
else {
	include 'login.php';
	exit();
}
$userId = $user['id'];
?>
