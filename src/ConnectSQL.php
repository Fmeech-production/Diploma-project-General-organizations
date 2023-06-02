<?php

namespace Fmeech2;

// перейти в родительскую директорию, относительно этой директории.
if (!defined('ROOT_DIR'))
    define('ROOT_DIR', realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR));
require_once(ROOT_DIR . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');


use mysqli;

class ConnectSQL
{
    private $mysql;
    function __construct()
    {
        $this->mysql = new mysqli("192.168.1.36", "root", "", "diplompp"); //подключение к базе данныx



    }

    function getSQL(): mysqli
    {
        return $this->mysql;
    }

    /**
     * Статический метод, возвращает объект mysqli для выполнения запросов к базе данных
     *
     * @return mysqli
     */
    public static function getStaticSQL(): mysqli
    {
        return new mysqli("192.168.1.36", "root", "", "diplompp"); //подключение к базе данныx
    }
}
