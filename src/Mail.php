<?php

namespace Fmeech2;

// перейти в родительскую директорию, относительно этой директории.
if (!defined('ROOT_DIR'))
	define('ROOT_DIR', realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR));
require_once(ROOT_DIR . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use Fmeech2\ConnectSQL;

class Mail
{
	public static function PUSHmess($email, $mess)
	{
		$config = file_get_contents(ROOT_DIR . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'mail.json');
		$config = json_decode($config, false);
		// создаем объект PHPMailer
		$mail = new PHPMailer();
		// настройки SMTP-сервера
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Username = $config->email; //ваша_почта@gmail.com
		$mail->Password = $config->token; //ваш_пароль
		$mail->SMTPSecure = 'tls';
		$mail->Port = 587;
		// настройки письма
		$mail->setFrom('Манипулятор', 'Робот наркологии');
		$mail->addAddress($email);
		$mail->isHTML(true);
		$mail->Subject = 'Уведомление:';
		$mail->Body = $mess;
		// отправляем письмо
		if ($mail->send()) {
			echo 'ПИСЬМО ОТПРАВЛЕНО';
		} else {
			echo 'ОШИБКА: ' . $mail->ErrorInfo;
		}
	}
	public static function PUSHmessByStatus_1($mess, int $status)
	{
		$mysql = ConnectSQL::getStaticSQL();
		//Поиск Работяг ахо по статусу
		$admin_userS = $mysql->query("SELECT * FROM `users` WHERE `Account-type`= $status");
		while ($admin = $admin_userS->fetch_object()) {
			if ($admin->new_notification1 == 1)
				//Отправка письма по почте
				Mail::PUSHmess($admin->Email, $mess);
		}
	}
	public static function PUSHmessByStatus_2($mess, int $status)
	{
		$mysql = ConnectSQL::getStaticSQL();
		//Поиск Работяг ахо по статусу
		$admin_userS = $mysql->query("SELECT * FROM `users` WHERE `Account-type`= $status");
		while ($admin = $admin_userS->fetch_object()) {
			if ($admin->new_notification2 == 1)
				//Отправка письма по почте
				Mail::PUSHmess($admin->Email, $mess);
		}
	}
	public static function PUSHmessById_1(int $id_user, $mess)
	{
		$mysql = ConnectSQL::getStaticSQL();
		$user = $mysql->query("SELECT * FROM users WHERE id = $id_user");
		if ($user) {
			$userData = $user->fetch_object();
			//Отправка письма пользователю написавшим эту заявку по айди
			if ($userData->new_notification1 == 1)
				Mail::PUSHmess($userData->Email, $mess);
		}
	}
	public static function PUSHmessById_2(int $id_user, $mess)
	{
		$mysql = ConnectSQL::getStaticSQL();
		$user = $mysql->query("SELECT * FROM users WHERE id = $id_user");
		if ($user) {
			$userData = $user->fetch_object();
			//Отправка письма пользователю написавшим эту заявку по айди
			if ($userData->new_notification2 == 1)
				Mail::PUSHmess($userData->Email, $mess);
		}
	}
}
	//PUSHmess::method1('kto-to.tchyata@yandex.ru', "123");
