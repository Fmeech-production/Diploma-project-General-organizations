<?php 
// В будущем подключение должно находиться в head.php, но пока оно находится в header.php из-за несовместимости с некоторыми страницами.
include 'php_constructor/library.php';
?>
<header> <!-- Шапка сайта -->
    <div class="nav_burger"> <!-- Бургер -->
        <span></span> <!-- Линии бургера -->
        <span></span> <!-- Линии бургера -->
        <span></span> <!-- Линии бургера -->
    </div>
    <div class="cabinet-name-header"><?= $Headline ?></div> <!-- Название страницы -->
    <div class="left-ava" onclick="window.location.href = 'Edit Profile.php';"> <!-- Аватарка -->
        <div class="div-img-ava"> <!-- Контейнер для аватарки -->
            <img class="img-ava" src="<?=get_avatar($user) ?>" id="header_ava"> <!-- Изображение аватарки -->
 
            <!-- Старый путь на случай ошибок -  /users/<?= $user['Login'] ?>/img/<?= $user['ava'] ?>  -->
        </div>
        <div class="name-acc"><?= $user['Name'] ?> </div> <!-- Имя пользователя -->
    </div>
</header>

<hr> <!-- Разделитель -->

<script>
    // Скрипт для изменения размера аватарки
    $(document).ready(function() {
        // Код, выполняемый после загрузки страницы
        var image = $('#header_ava');
        image.css({
            'transform': 'scale(' + <?= $user['range_img'] ?> + ')'
        });
    });
</script>