<?php include '../conectCOOKIE.php';   //Подключение к БД и проверка на авторизацию
if ($_COOKIE['language'] == 'eng')      //Подключение локализации
    include '../php_constructor/localization/localization_eng.php';
else
    include '../php_constructor/localization/localization_ru.php';
$Headline = $loc['Общие настройки'];   //Заголовок страницы
$nav_select = 1;    //Выбор активного пункта меню
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title><?= $Headline ?> </title>
    <link rel="stylesheet" href="/css/admin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/icons/logo1.png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Подключение JQuery -->
    <script src="/js/constructor.js"></script> <!-- Подключение скриптов для работы popup  -->
</head>


<body>
    <div class="Редактор-отделений">
        <div class="lable">Редактор политики конфиденциальности</div>
        <div class="kcfcgh">
            <div class="выбор-паролей">


                <button class="Удалить" name="submit_button" value="button1" id="button1" onclick="save_new_password()">Сохранить политику конфиденциальности</button>
                <textarea placeholder="Введите новую политику конфиденциальности" id="new_department_name"><?php
$sql = "SELECT * FROM `admin-panel` WHERE `admin-panel`.`id` = 1";
$result = mysqli_query($mysql, $sql);
$row = mysqli_fetch_assoc($result);
echo $row['PrivacyPolicy'];
mysqli_close($mysql);
?></textarea>
            </div>

        </div>
    </div>


    <script>
        function save_new_password() {

            // AJAX запрос на изменение  главного глобального единой для всех новых пользователей политики конфиденциальности
            $.ajax({
                url: 'NewPrivacyPolicy.php',
                type: 'POST',
                data: {
                    NewPrivacyPolicy: $('#new_department_name').val()
                },
                success: function(data) {
                    // Обновление списка отделений
                    showPopup(data, null); //Вывод сообщения об успешном изменении пароля
                    $('#button1').text("Сохранить политику конфиденциальности еще раз");

                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Вывод ошибки в консоль
                }
            });
        }


    </script>
</body>
<style>
    html,
    body {
        font-family: Arial, sans-serif;
        font-size: 16px;
        background-color: #f2f2f2;
        justify-content: center;
        align-items: center;
        display: flex;
        flex-wrap: wrap;

        width: 100%;
        height: 100%;
        margin: 0;
    }

    .lable {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    select {
        display: inline-block;
        padding: 10px;
        font-size: 16px;
        border-radius: 5px;
        border: 2px solid #ccc;
        background-color: #fff;
        outline: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin: 0 20px 20px 0;
    }

    select option {
        font-size: 16px;
    }

    button {
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: bold;
        color: #fff;
        background: linear-gradient(300deg, hsla(230, 35%, 52%, 1) 0%, hsla(202, 37%, 59%, 1) 100%);
        border: none;
        cursor: pointer;
        outline: none;
        transition: all 0.3s ease;

        border-radius: 5px 5px 0 0;
        width: calc(100%);
        height: 40px;
    }

    button:hover {
        background: linear-gradient(300deg, hsla(230, 35%, 52%, 1) 0%, hsla(202, 37%, 59%, 1) 80%);
        transition: all 0.3s ease;
    }

    textarea {
        display: inline-block;
        padding: 10px;
        font-size: 16px;
        border-radius: 0 0 5px 5px;
        width: calc(100% - 20px - 4px);
        max-height: calc(100% - 20px - 4px);
        border: 2px solid #ccc;
        border-top: 2px solid rgb(248, 248, 248);
        border-top: none;
        outline: none;
        transition: border-color 0.3s ease-in-out;
        margin: 0 0px 0 0;
        background-color: rgb(248, 248, 248);
        resize: none;
        flex-grow: 1;



    }

    #button2 {
        border-radius: 0 5px 5px 0;
        height: 82px;
        margin-top: 0px;
        margin-left: -20px;
        padding-left: 10px;
        margin-right: auto;
        transition: all 0.2s ease;
        background: linear-gradient(120deg, hsla(230, 35%, 52%, 1) 0%, hsla(202, 37%, 59%, 1) 100%);
        border: none;
    }

    #button2:hover {
        margin-left: -5px;
        background-color: rgb(56, 69, 133);
    }

    .new_ok {
        width: calc(100% - 274px);
        float: right;
        display: flex;
    }

    textarea:focus {
        border-color: #007bff;
    }

    .Редактор-отделений,
    .Редактор-кабинетов {
        background-color: #fff;
        padding: 20px;
        margin: 28px 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .Редактор-отделений {
        margin-top: 28px;
        width: 100%;
        height: 87%;


        display: flex;
        flex-direction: column;
    }

    .выбор-паролей {
        display: flex;
        flex-direction: column;
        justify-content: left;
        height: 100%;
    }

    .kcfcgh {
        height: 100%;
        display: flex;
        flex-direction: column;
    }
</style>

</html>