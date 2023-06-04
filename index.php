<?php
include 'conectCOOKIE.php'; // Подключение к БД и проверка на авторизацию

if ($user == null) { // Если пользователь не авторизован
	include 'login.php'; // Перекидываем на страницу авторизации
	exit();
} else {
	if ($user['Account-type'] == 0) { // Работник наркологии
		include 'panel_worker_narcology.php';
	} else if ($user['Account-type'] == 1) { // Начальник ахо
		include 'panel_HeadOfFacilities.php';
	} else if ($user['Account-type'] == 2) { // Работник ахо административно хозяйственный отдел
		include 'panel_worker_narcology.php';  //panel_worker_facilities.php
	} else if ($user['Account-type'] == 3) { // Водитель
		include 'active_routes__HeadOfFacilities.php'; //panel_driver.php
	} else if ($user['Account-type'] == 4) { // Системный-администратор
		include 'panel_admin.php';
	}
	exit();
}


exit();

class User
{
	protected $mysql; // Свойство для подключения к БД
	public function __construct($mysql)
	{
		$this->mysql = $mysql;
	}
	public function authenticate()
	{
		$login = $_COOKIE['login'];
		$password = $_COOKIE['password'];
		$результат = $this->mysql->query("SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
		$user = $результат->fetch_assoc();
		return $user;
	}

	public function redirectIfNotAuthenticated()
	{
		$user = $this->authenticate();
		if ($user == null) {
			include 'login.php';
			exit();
		}
	}
}




class NarcologyWorker extends User
{
	public function __construct($mysql)
	{
		parent::__construct($mysql);
	}
	public function showPanel()
	{
		include 'panel_worker_narcology.php';
	}
}


class FacilitiesHead extends User
{
	public function __construct($mysql)
	{
		parent::__construct($mysql);
	}
	public function showPanel()
	{
		include 'panel_HeadOfFacilities.php';
	}
}






include 'conectSQL.php';
include 'User.php';
include 'NarcologyWorker.php';
include 'FacilitiesHead.php';

$user = new User($mysql);
$user->redirectIfNotAuthenticated();

$accountType = $user->authenticate()['Account-type'];

switch ($accountType) {
	case 0:
		$narcologyWorker = new NarcologyWorker($mysql);
		$narcologyWorker->showPanel();
		break;
	case 1:
		$facilitiesHead = new FacilitiesHead($mysql);
		$facilitiesHead->showPanel();
		break;
	case 2:
		// Класс для работника ахо
		break;
	case 3:
		// Класс для водителя
		break;
	case 4:
		// Класс для администратора
		break;
	default:
		// Ошибка - недопустимый тип аккаунта
}
