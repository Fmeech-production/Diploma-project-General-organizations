<?php   //Изменение данных пользователя
$Name = $_POST['Name'];
$SName = $_POST['SName'];
$PName = $_POST['PName'];
$Email = $_POST['Email'];
$Phone = $_POST['Phone'];
$new_notification1 = 0;
$new_notification2 = 0;

if ( isset($_POST['new_notification1']) == true )  $new_notification1 = 1;
if ( isset($_POST['new_notification2']) == true )  $new_notification2 = 1;



include 'conectCOOKIE.php';

$userId = $user['id'];
$результат = $mysql->query("UPDATE `users` SET
 `Name` = '$Name', 
 `SName` = '$SName', 
 `PName` = '$PName', 
 `Email` = '$Email', 
 `Phone` = '$Phone', 
 `new_notification1` = '$new_notification1', 
 `new_notification2` = '$new_notification2'
 WHERE `users`.`id` = '$userId'");


header('Location: /Edit Profile.php?error=error6');
