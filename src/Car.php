<?php

namespace Fmeech2;

// перейти в родительскую директорию, относительно этой директории.
if (!defined('ROOT_DIR'))
	define('ROOT_DIR', realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR));
require_once(ROOT_DIR . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

use Fmeech2\ConnectSQL;

class Car
{
	/**
	 * Метод для получения объекта автомобиль по его id 

	 * @param int $idCar id автомобиля для поиска в таблице cars
	 * 
	 * @return object Возвращает объект автомобиля
	 * 
	 * @version 1.0
	 * @since 1.0
	 * @todo 
	 */
	public static function getCar($idCar)
	{
		$query = ConnectSQL::getStaticSQL()->query("SELECT * FROM cars WHERE id = '$idCar'");

		if ($query && mysqli_num_rows($query) > 0) {
			return $query->fetch_object();
		} else {
			return null;
		}
	}
	/**
	 * Возвращает названия автомобиля по его id, в формате "номер автомобиля - марка автомобиля | модель автомобиля"

	 * @param int $idCar id автомобиля для поиска в таблице cars
	 * 
	 * @return string Возвращает строку названия автомобиля в формате "номер автомобиля - марка автомобиля | модель автомобиля"
	 * 
	 * @version 1.0
	 * @since 1.0
	 * @todo 
	 */
	public static function getNameCar($idCar): string
	{
		$car = Car::getCar($idCar);
		if ($car == null) return "";
		return "$car->license_plate - $car->make | $car->model ";
	}

	/**
	 * Метод для получения 
	 * <div.>водитель</div.>
	 * <div.>водитель</div.> 
	 * и тд..
	 * @param string $drivers_idS Строка с id пользователей из поля drivers_id в таблице cars
	 * 
	 * @return string Выводит лишь последовательно строчки с именами и id водителей обёрнутые в <div>, а значит их все можно обернуть в ещё один див на ваше усмотрение
	 * 
	 * @version 1.0
	 * @since 1.0
	 * @todo 
	 */
	public static function DriversIdName($drivers_idS): string
	{
		$end_string = "";
		$drivers_idS = Car::GetDriversIdS($drivers_idS);


		//Получаем из базы данных всех водителей, к которым привязан автомобиль
		$drivers = ConnectSQL::getStaticSQL()->query("SELECT * FROM users WHERE id IN ($drivers_idS) AND `Account-type` = 3");
		if (!$drivers) return "Для этого автомобиля нет добавленных водителей.";
		while ($driver = $drivers->fetch_object()) {
			$end_string .= "<div title=" . '"' .
				"Удалить водителя  для этой машины: $driver->SName $driver->Name $driver->PName"
				. '"' .
				"data-id=" . '"' . $driver->id . '"' .
				">";
			$end_string .= "→ $driver->SName ";
			$end_string .= "$driver->Name ";
			$end_string .= "$driver->PName ";
			$end_string .= "</div>";
		}
		return $end_string;
	}

	/**
	 * Метод для получения 
	 * <option.>водитель</option.>
	 * <option.>водитель</option.> 
	 * и тд.. 
	 * к которым ещё не привязан этот автомобиль
	 * @param string $drivers_idS Строка с id пользователей из поля drivers_id в таблице cars
	 * 
	 * @return string Выводит последовательно option-ны с именами и id водителей, к которым ещё не привязан этот автомобиль. Обёрнутые в <option>, а значит их все НУЖНО обернуть в ещё один select 
	 * 
	 * @version 1.0
	 * @since 1.0
	 * @todo 
	 */
	public static function DriversIdOption($drivers_idS): string
	{
		$end_string = "";
		$drivers_idS = Car::GetDriversIdS($drivers_idS);
		// Получаем из базы данных всех водителей, за исключением уже привязанных к автомобилю водителей.
		if ($drivers_idS == "")
			$drivers = ConnectSQL::getStaticSQL()->query("SELECT * FROM users WHERE `Account-type` = 3");
		else
			$drivers = ConnectSQL::getStaticSQL()->query("SELECT * FROM users WHERE `Account-type` = 3 AND id NOT IN ($drivers_idS)");
		while ($driver = $drivers->fetch_object()) {
			$end_string .= '<option value="' . $driver->id . '">';
			$end_string .= "$driver->SName ";
			$end_string .= "$driver->Name ";
			$end_string .= "$driver->PName ";
			$end_string .= "</option>";
		}


		if ($end_string == "")
			return "<option value=" . '"' . '"' . " selected disabled>Пока нет зарегистрированных водителей или вы уже выбрали всех водителей.</option>";

		$end_string = '<option value="" selected disabled>Выберите водителя</option>' . $end_string;
		return $end_string;
	}

	/**
	 * Метод для очистки лишнего в параметре $drivers_idS, удаляющий лишние запятые перед отправкой запроса на сервер для поиска нескольких водителей
	 * @param string $drivers_idS Строка с id пользователей из поля drivers_id в таблице cars
	 * 
	 * @return string $drivers_idS готовый к SQL запросу
	 * 
	 * @version 1.0
	 * @since 1.0
	 * @todo 
	 */
	private static function GetDriversIdS($drivers_idS): string
	{
		//Удаляем запятую в начале
		if (substr($drivers_idS, 0, 1) == ",") {
			$drivers_idS = substr_replace($drivers_idS, "", 0, 1);
		}
		//Удаляем запятую в в конце
		if (substr($drivers_idS, -1) == ",") {
			$drivers_idS = substr_replace($drivers_idS, "", -1);
		}


		return $drivers_idS;
	}

	/**
	 * Метод для получения 
	 * <option.>водитель</option.>
	 * <option.>водитель</option.> 
	 * и тд.. 
	 * к которым УЖЕ привязан этот автомобиль
	 * @param string $drivers_idS Строка с id пользователей из поля drivers_id в таблице cars
	 * 
	 * @return string Выводит последовательно option-ны с именами и id водителей, к которым УЖЕ привязан этот автомобиль. Обёрнутые в <option>, а значит их все НУЖНО обернуть в ещё один select 
	 * 
	 * @version 1.0
	 * @since 1.0
	 * @todo 
	 */
	public static function DriversIdOptionSUCCESS($drivers_idS): string
	{
		$end_string = "";
		$drivers_idS = Car::GetDriversIdS($drivers_idS);
		// Получаем из базы данных всех водителей, за исключением уже привязанных к автомобилю водителей.
		if ($drivers_idS == "")
			$drivers = ConnectSQL::getStaticSQL()->query("SELECT * FROM users WHERE `Account-type` = 99 LIMIT 1");
		else
			$drivers = ConnectSQL::getStaticSQL()->query("SELECT * FROM users WHERE `Account-type` = 3 AND id IN ($drivers_idS)");
		while ($driver = $drivers->fetch_object()) {
			$end_string .= '<option value="' . $driver->id . '">';
			$end_string .= "$driver->SName ";
			$end_string .= "$driver->Name ";
			$end_string .= "$driver->PName ";
			$end_string .= "</option>";
		}


		if ($end_string == "")
			return "<option value=" . '"' . '"' . " selected >Пока нет зарегистрированных водителей или вы уже выбрали всех водителей.</option>";

		$end_string = '<option value="" selected >Выберите водителя</option>' . $end_string;
		return $end_string;
	}
}
