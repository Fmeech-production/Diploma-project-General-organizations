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
        <div class="lable">Редактор Секретного ключа</div>
        <div class="kcfcgh">
<div class="new_ok">
                <button name="submit_button" value="button2" id="button2" onclick="save_new_password()">Сохранить новый ключ</button>
                </div>
            <div class="выбор-паролей">


                <button class="Удалить" name="submit_button" value="button1" id="button1" onclick="edit_visible_password()">Посмотреть на ключ</button>
                <input placeholder="Секретный ключ" id="new_department_name" value="<?php
                                                                                        $sql = "SELECT * FROM `admin-panel` WHERE `admin-panel`.`id` = 1";
                                                                                        $result = mysqli_query($mysql, $sql);
                                                                                        $row = mysqli_fetch_assoc($result);
                                                                                        echo $row['TheSecretKey'];
                                                                                        mysqli_close($mysql);
                                                                                        ?>" type="password">
            </div>

        </div>
    </div>


    <script>
        function save_new_password() {

            // AJAX запрос на изменение  главного глобального единого для всех новых пользователей при регистрации пароля
            $.ajax({
                url: 'NewSecretKey.php',
                type: 'POST',
                data: {
                    NewKey: $('#new_department_name').val()
                },
                success: function(data) {
                    // Обновление списка отделений
                    showPopup(data, null);   //Вывод сообщения об успешном изменении пароля
                    $('#button2').text("Сохранить ключ снова");
                    
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Вывод ошибки в консоль
                }
            });
        }
        function edit_visible_password(){
            if ($('#new_department_name').attr('type') == 'password') {
                $('#new_department_name').attr('type', 'text');
                $('#button1').text('Скрыть ключ');
                $('#button1').css('background', 'linear-gradient(300deg, rgb(252 145 91) 0%, rgb(228 75 75) 100%)');
                $('#new_department_name').css('background-color', 'rgb(255 237 216)');
                $('#new_department_name').css('border', '2px solid rgb(255 237 216)');
                $('#new_department_name').css('border-top', 'none');
            } else {
                $('#new_department_name').attr('type', 'password');
                $('#button1').text('Посмотреть на ключ');
                $('#button1').css('background', 'linear-gradient(300deg, hsla(230, 35%, 52%, 1) 0%, hsla(202, 37%, 59%, 1) 100%)');
                $('#new_department_name').css('background-color', 'rgb(248 248 248)');
                $('#new_department_name').css('border', '2px solid rgb(204 204 204)');
                $('#new_department_name').css('border-top', 'none');
            }
        }
    </script>
</body>
<style>
    body {
        font-family: Arial, sans-serif;
        font-size: 16px;
        background-color: #f2f2f2;
        justify-content: center;
        align-items: center;
        display: flex;
        flex-wrap: wrap;
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
        width: calc(250px + 20px + 4px);
        height: 40px;
    }

    button:hover {
        background: linear-gradient(300deg, hsla(230, 35%, 52%, 1) 0%, hsla(202, 37%, 59%, 1) 80%);
        transition: all 0.3s ease;
    }

    input {
        display: inline-block;
        padding: 10px;
        font-size: 16px;
        border-radius: 0 0 5px 5px;
        width: 250px;
        height: 20px;
        border: 2px solid #ccc;
        border-top: 2px solid rgb(248, 248, 248);
        border-top: none;
        outline: none;
        transition: border-color 0.3s ease-in-out;
        margin: 0 0px 0 0;
        background-color: rgb(248, 248, 248);
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
    #button2:hover{
        margin-left: -5px;
        background-color: rgb(56, 69, 133);
    }
    .new_ok{
width: calc(100% - 274px);
        float: right;
        display: flex;
    }

    input:focus {
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
        width: 538px;
    }

    .выбор-паролей {
        display: flex;
        flex-direction: column;
        justify-content: left;
    }

    .kcfcgh {

    }
</style>

</html>