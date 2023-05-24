<?php
namespace Fmeech2;

	use mysqli;

	class User
	{

		public $userExists;
		private $sql;
		public $login;
		public $password;
		public $id;

		public $user;


		public $surname;
		public $name;
		public $patronymic;

		/**
		 * @param string $password Сюда посылать уже зашифрованный пароль пользователя.
		 */
		public function __construct($login, $password)
		{
			$result = ConnectSQL::getStaticSQL()->query("SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");   //проверка на существование пользователя
			$user = $result->fetch_assoc();
			if ($user == null) {
				$this->userExists = false;
				return;
			}

			//если пользователь существует

			$this->login = $user['login'];
			$this->password = $user['password'];
			$this->id = $user['id'];
			$this->sql = new ConnectSQL();
			$this->userExists = true;
			$this->user = $user;


			$this->surname = $user['surname'];
			$this->name = $user['name'];
			$this->patronymic = $user['patronymic'];
		}

		/**
		 * Создает экземпляр класса User на основе cookie.
		 * @return User Возвращает экземпляр класса User.
		 * @return User Или сообщение "НЕНАЙДЕН"
		 */
		public static function createAuto__construct(): User
		{
			return new User($_COOKIE['login'], $_COOKIE['password']);
		}

		/**
		 * @param string $password НЕ зашифрованный пароль пользователя.
		 */
		public static function createUser($login, $password)
		{
			if (strlen($login) > 32) return "Логин не может быть больше 32 симмволов";
			if (strlen($password) > 32) return "Пароль не может быть больше 32 симмволов";
			if (strlen($login) < 6) return "Логин не может быть короче 6-ти симмволов";
			if (strlen($password) < 6) return "Пароль не может быть короче 6-ти симмволов";
			
			$login=ConnectSQL::getStaticSQL()->real_escape_string($login);
			$password=ConnectSQL::getStaticSQL()->real_escape_string($password);

			$result = ConnectSQL::getStaticSQL()->query("SELECT * FROM `users` WHERE `login` = '$login'");   //проверка на существование пользователя
			$user = $result->fetch_assoc();
			if ($user == null) {    //если пользователь не существует
				$password = md5($password . "соль");    //шифрование пароля
				ConnectSQL::getStaticSQL()->query("INSERT INTO `users` (`login`, `password`) VALUES ('$login', '$password')");   //добавление пользователя в БД
				setcookie('login', $login, time() + 3600 * 24 * 30 * 12);
				setcookie('password', $password, time() + 3600 * 24 * 30 * 12);
				header('Location: /');
				return true;
			} else {    //если пользователь существует
				header("Location: /");
				return false;
			}
		}
		public static function createUser_Pro($login, $password, $surname, $name, $patronymic)
		{
			if (!User::createUser($login, $password)) return;
			$sql = "UPDATE `users` SET `surname` = '$surname', `name` = '$name', `patronymic` = '$patronymic' WHERE `login` = '$login'";
			$result = ConnectSQL::getStaticSQL()->query($sql);
		}

		/**
		 * @param string $password НЕ зашифрованный пароль пользователя.
		 */
		public static function signIn($login, $password, $save_password)
		{
			if (strlen($login) > 32) return false;
			if (strlen($password) > 32) return false;
			if (strlen($login) < 6) return false;
			if (strlen($password) < 6) return false;
			
			$login=ConnectSQL::getStaticSQL()->real_escape_string($login);
			$password=ConnectSQL::getStaticSQL()->real_escape_string($password);

			$password = md5($password . "соль");    //шифрование пароля
			$result = ConnectSQL::getStaticSQL()->query("SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");   //проверка на существование пользователя с таками данными
			$user = $result->fetch_assoc();

			//Если пользователь не найден
			if ($user == null) return;

			if ($save_password == "on") {
				setcookie('login', $login, time() + 3600 * 24 * 30 * 12);
				setcookie('password', $password, time() + 3600 * 24 * 30 * 12);
			} else {
				setcookie('login', $login);
				setcookie('password', $password);
			}
		}
	}