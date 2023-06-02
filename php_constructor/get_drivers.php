<?php

if (!defined('ROOT_DIR'))
	define('ROOT_DIR', realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR));
require_once(ROOT_DIR . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

use Fmeech2\Car;
use Fmeech2\ConnectSQL;
use Fmeech2\ConnectCOOKIE;

$user = ConnectCOOKIE::start_session();

$drivers_idS = $_POST['drivers_idS'];

echo Car::DriversIdOptionSUCCESS($drivers_idS);
