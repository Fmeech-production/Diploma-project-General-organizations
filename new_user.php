<?php   //Регистрация
$login = $_POST['newlogin'];
$password = $_POST['newpassword'];
$SName = $_POST['SName'];
$Name = $_POST['Name'];
$PName = $_POST['PName'];


//Поиск ключа в БД для регистрации нового пользователя
include 'conectSQL.php';
$sqlPASS = "SELECT * FROM `admin-panel` WHERE `admin-panel`.`id` = 1"; 
$sqlPASS = mysqli_query($mysql, $sqlPASS);
$row = mysqli_fetch_assoc($sqlPASS);


$key = $_POST['key'];   //ключ для регистрации (И да я его уже сменил на рабочий. Так что если вы это читаете, то не забыл про него)
if ($key != $row['TheSecretKey']) {
    header("Location: /?error=error2");
    exit();
}
$результат = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login'");   //проверка на существование пользователя
$user = $результат->fetch_assoc();
if ($user == null) {    //если пользователь не существует
    $password = md5($password . "соль");    //шифрование пароля
    $mysql->query("INSERT INTO `users` (`login`, `password`, `SName`, `Name`, `PName`) VALUES ('$login', '$password', '$SName', '$Name', '$PName')");   //добавление пользователя в БД

    setcookie('login', $login, time() + 3600 * 24 * 30 * 12);
    setcookie('password', $password, time() + 3600 * 24 * 30 * 12);
    setcookie('language', "ru", time() + 3600 * 24 * 30 * 12);  //куки на год



    $path1 = 'users/' . $login . '/img';     //создание папки для аватарки и обложки
    mkdir($path1, 0777, true);

    $file1 = 'img/ava1.jpg';    //копирование аватарки и обложки
    $newfile1 = 'users/' . $login . '/img/1.png';
    copy($file1, $newfile1);

    $file2 = 'img/cover1.jpg';  //копирование аватарки и обложки
    $newfile2 = 'users/' . $login . '/img/2.png';
    copy($file2, $newfile2);


    header('Location: /');
} else {    //если пользователь существует
    header("Location: /?error=error3");
    exit();
}
