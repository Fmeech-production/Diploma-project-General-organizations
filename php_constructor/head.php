<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<link rel="preload" href="img/loading.gif" as="image">

<title><?= $Headline ?> </title>
<link rel="stylesheet" href="css/CSSep.css">
<link rel="stylesheet" href="css/CSSpa.css">
<link rel="stylesheet" href="css/css-all.css">
<link rel="stylesheet" href="css/My_framevorke.css">
<?php
if (isset($_COOKIE['isDarkMode']) && $_COOKIE['isDarkMode'] == "true") {
    echo '<link rel="stylesheet" href="css/CSSep_Dark.css">';
}
if ($user['Account-type'] == 4) { ?>
    <link rel="stylesheet" href="css/admin.css">
<?php }
?>
<link rel="stylesheet" href="css/CSSep_mobail.css?t=<?php echo (microtime(true) . rand()); ?>"> <!-- Подключение стилей для мобильных устройств -->
<link rel="icon" type="image/x-icon" href="icons/logo1.png">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Подключение JQuery -->
<script src="js/constructor.js"></script> <!-- Подключение скриптов для работы popup  -->
<?php // header('Cache-Control: max-age=3600'); 
?>

<link rel="stylesheet" type="text/css" href="ImportedLibraries/datatables/jquery.dataTables.min.css">
<script type="text/javascript" src="ImportedLibraries/datatables/jquery.dataTables.min.js"></script>
<script src="ImportedLibraries/datatables/datatables-ru.json"></script>