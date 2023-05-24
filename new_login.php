<?php // Авторизация
$login = $_POST['login'];   
$password = $_POST['password'];
$zapomnit = $_POST['zapomnit']; //запомнить меня при в ходе
$password = md5($password . "соль");    //шифрование пароля
include 'conectSQL.php';    
$результат = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");  //проверка на существование пользователя
$user = $результат->fetch_assoc();  
if ($user != null) {    //если пользователь существует
    if ($zapomnit == "zapomnit") {//куки на год
        setcookie('login', $login, time() + 3600 * 24 * 30 * 12);
        setcookie('password', $password, time() + 3600 * 24 * 30 * 12);
        setcookie('language', "ru", time() + 3600 * 24 * 30 * 12);
        header('Location: /');
    }
    else{//куки на одну ссесию
        setcookie('login', $login);
        setcookie('password', $password);
        setcookie('language', "ru");
        header('Location: /');
    }
} else {    //если пользователь не существует
    header("Location: /?error=error");
    exit();
}


