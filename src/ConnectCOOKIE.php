<?php

namespace Fmeech2;

// перейти в родительскую директорию, относительно этой директории.
if (!defined('ROOT_DIR'))
	define('ROOT_DIR', realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR));
require_once(ROOT_DIR . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');



use mysqli;

class ConnectCOOKIE extends ConnectSQL
{
	public static function start_session()
	{
		//Подключение к бд
		$mysql = parent::getStaticSQL();
		if (isset($_COOKIE['login']) && isset($_COOKIE['password'])) {
			$login = $_COOKIE['login'];
			$password = $_COOKIE['password'];
			//Проверка соответствия логина и пароля на наличие в бд
			$result = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
			$user = $result->fetch_object();
			//Если пользователей существует, то возвращаем результат = пользователь
			if ($user != null)	return $user;
			//иначе перекидываем на страницу авторизации и принудительно завершаем все остальные операции
			require_once ROOT_DIR . DIRECTORY_SEPARATOR . 'login.php';
			exit();
		} else {
			include 'login.php';
			exit();
		}
	}
}
