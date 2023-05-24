<?php

/**
 * Функция для получения аватара пользователя
 * @param  array $USER Массив с данными пользователя
 * 
 * @return string       Путь к аватару пользователя
 * 
 * @version 1.0
 * 
 * @since 1.0
 * 
 * @todo Не уверен в том что путь идёт от корня сервера, а не от страницы на которой вызывается функция
 * 
 */
function get_avatar($USER)
{
	// Получение данных пользователя
	$id = $USER['id'];
	$login = $USER['Login'];
	$name_avatar = $USER['ava'];
	$range_ava = $USER['range_img'];

	// Путь к аватару
	$path_avatar =  "/users" . "/" . $login . "/img" . "/" . $name_avatar;

	// Проверка на наличие аватара
	if (file_exists($_SERVER['DOCUMENT_ROOT'] . $path_avatar))
		// Если аватар есть, то возвращаем путь к нему
		return $path_avatar;
	else
		// Если аватара нет, то возвращаем путь к дефолтному аватару
		return "/users/default_avatar.png";
}


/**
 * Функция для получения аватара пользователя
 * @param  array $USER Массив с данными пользователя
 * 
 * @return string       Путь к аватару пользователя
 * 
 * @version 1.0
 * 
 * @since 1.0
 * 
 * @todo Не уверен в том что путь идёт от корня сервера, а не от страницы на которой вызывается функция
 * 
 */
function get_avatar_id($user_id)
{
	include 'conectSQL.php';
	//дале идёт запрос на получение данных пользователя из БД
	$user = mysqli_fetch_assoc(mysqli_query($mysql, "SELECT * FROM `users` WHERE `id` = '$user_id'"));

	// Получение данных пользователя
	$id = $user['id'];
	$login = $user['Login'];
	$name_avatar = $user['ava'];
	$range_ava = $user['range_img'];

	// Путь к аватару
	$path_avatar =  "/users" . "/" . $login . "/img" . "/" . $name_avatar;

	// Проверка на наличие аватара
	if (file_exists($_SERVER['DOCUMENT_ROOT'] . $path_avatar))
		// Если аватар есть, то возвращаем путь к нему
		return $path_avatar;
	else
		// Если аватара нет, то возвращаем путь к дефолтному аватару
		return "/users/default_avatar.png";
}

/**
 * проверка на null и вывод последующего сообщения
 * @param  string $value   Проверяемое значение
 * 
 * @param  string $message Дефолтное сообщение, которое будет возвращено, если ты передашь null
 * 
 */
function check_null($value, $message)
{
	if ($value == null) return $message;
	return $value;
}

/**
 * Класс для работы с логами бронирования
 * 
 * @version 1.0
 * 
 * @since 1.0
 * 
 * @todo Попытки использовать классы в php
 */
class BookingLog
{
	//Свойство для хранения подключения к БД
	private $mysql;

	/*
	*Конструктор класса
	*@param mysqli $mysql Подключение к БД
	*/
	public function __construct($mysql)
	{
		//Присвоение свойству класса значения подключения к БД
		$this->mysql = $mysql;
	}

	/**
	* Добавление записи в логи бронирования и не обязательный для дальнейшего использования возврат результата
	* @param int $id ID бронирования
	* @param string $action Действие
	* @param int $user_id ID пользователя
	* @return mysqli $booking_log Результат запроса
	*/
	public function addLog($id, $action, $user_id)
	{
		$current_time = date("Y-m-d H:i:s");
		//Добавление записи в логи
		$booking_log = $this->mysql->query("INSERT INTO `booking_log` (`booking_id`, `action`, `time`, `user_id`) 
		VALUES ('$id','$action','$current_time','$user_id')");

		//Возвращение результата
		return $booking_log;
	}
}
