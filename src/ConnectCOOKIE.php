<?php

namespace Fmeech2;

// перейти в родительскую директорию, относительно этой директории.
if (!defined('ROOT_DIR'))
	define('ROOT_DIR', realpath(__DIR__ . './../'));
// подключаем файл класса PHPMailer
require_once(ROOT_DIR . '\vendor\autoload.php');


use mysqli;

class ConnectCOOKIE extends ConnectSQL
{
	public static function start_session()
	{
		//Подключение к бд
		$mysql = parent::getStaticSQL();
		$login = $_COOKIE['login'];
		$password = $_COOKIE['password'];
		//Проверка соответствия логина и пароля на наличие в бд
		$result = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
		$user = $result->fetch_object();
		//Если пользователей существует, то возвращаем результат = пользователь
		if ($user != null)	return $user;
		//иначе перекидываем на страницу авторизации и принудительно завершаем все остальные операции
		require_once ROOT_DIR . '\login.php';
		exit();
	}
}
