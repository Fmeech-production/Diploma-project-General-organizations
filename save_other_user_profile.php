<?php   //Изменение данных пользователя


include 'conectCOOKIE.php';

$Name = $_POST['Name'];
$SName = $_POST['SName'];
$PName = $_POST['PName'];
$Email = $_POST['Email'];
$Phone = $_POST['Phone'];
$account_type = $_POST['account_type'];
$Password = md5($_POST['Password'] . "соль");    //шифрование пароля
$Login = $_POST['Login'];
$save_password = $_POST['save_password'];
$userId = $_POST['userId'];

if ($save_password == 1) {
    $результат = $mysql->query("UPDATE `users` SET
     `Login` = '$Login', 
     `Password` = '$Password', 
     `Name` = '$Name', 
     `SName` = '$SName', 
     `PName` = '$PName', 
     `Email` = '$Email', 
     `Phone` = '$Phone',
     `Account-type` = '$account_type'
     WHERE `users`.`id` = '$userId'");
} else {
    $результат = $mysql->query("UPDATE `users` SET
     `Name` = '$Name', 
     `SName` = '$SName', 
     `PName` = '$PName', 
     `Email` = '$Email', 
     `Phone` = '$Phone',
     `Account-type` = '$account_type'
     WHERE `users`.`id` = '$userId'");
}

header('Location: /user_details.php?error=error6&id=' . $userId);
