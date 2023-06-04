<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Авторизация</title>
    <link rel="stylesheet" href="css/CSSreg.css">
    <link rel="stylesheet" href="css/My_framevorke.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="icons/logo1.png">
    <script src="js/constructor.js"></script> <!-- Подключение скриптов для работы popup  -->
</head>

<body>
    <div onclick="NotPassword(this)" id="popup" class="popup">
        <div class="popup-main">
            <div class="popup-text">
                Обратитесь к администрации, чтобы вам восстановили пароль.
            </div>
        </div>
    </div>

    <div onclick="NotPassword(this)" id="popup2" class="popup">
        <div class="popup-main">
            <div class="popup-text">
                Какие-то данные введены не коректно
            </div>
        </div>
    </div>



    <div class="otstyp">
        <main>
            <form class="form-log" id="form-log" action="new_login.php" method="post">
                <div class="div-img-logo">
                    <img class="img-logo" src="icons/logo.png">
                </div>

                <p class="Hello">Приветствуем вас!</p>
                <p class="Hello podpis"><!--Система подачи заявок о неисправностях--> Система бронирования автомобилей</p>
                <div class="contener-input">
                    <input class="login" id="login" name="login" placeholder="Логин" type="text">
                    <input class="login password" id="password" name="password" placeholder="Пароль" type="password">
                    <input style="display: none;" id="zapomnit" name="zapomnit" value="NOzapomnit" type="text">
                    <div class="box-acktiv">
                        <div class="acktiv1 flex relative"><img onclick="rememberMeFunc()" src="icons/check_mark3.png" id="rememberMeImg">
                            <div onclick="rememberMeFunc()" id="rememberMe"></div><label onclick="rememberMeFunc()" for="rememberMe" id="labelrememberMe">Запомнить меня</label>
                        </div>
                        <div class="acktiv2" onclick="NotPassword('popup')">Не помню пароль</div>
                    </div>
                    <button class="form-btn">Войти</button>
                </div>
                <div class="acktiv3">Ещё не имеете аккаунта? <a class="RegSing" onclick="regform()">Зарегистрироваться</a>
                </div>
            </form>

            <form class="form-log form-reg" id="form-reg" action="new_user.php" method="post">
                <div class="div-img-logo">
                    <img class="img-logo" src="icons/logo.png">
                </div>

                <p class="Hello">Регистрация</p>
                <div class="contener-input">
                    <div class="contener-input" id="reg-input1">

                        <div class="error error-login error-desk SNamejs">Фамилия не может быть больше 32 символов</div>
                        <div class="error error-login error-mob SNamejs">Фамилия должна быть короче</div>
                        <input class="login" id="SName" name="SName" placeholder="Фамилия" type="text" onkeyup="jsERROR('SNamejs','SName',2,32)">

                        <div class="error error-newpassword error-desk Namejs">Имя не может быть больше 32 символов
                        </div>
                        <div class="error error-newpassword error-mob Namejs">Имя должно быть короче</div>
                        <input class="login password" id="Name" name="Name" placeholder="Имя" type="text" onkeyup="jsERROR('Namejs','Name',2,32)">

                        <div class="error error-newpassword2 error-desk PNamejs">Отчество не может быть больше 32
                            символов</div>
                        <div class="error error-newpassword2 error-mob PNamejs">Отчество должно быть короче</div>
                        <input class="login password" id="PName" name="PName" placeholder="Отчество" type="text" onkeyup="jsERROR('PNamejs','PName',0,32)">
                        <button class="form-btn" type="button" onclick="nextReg()">Продолжить</button>
                    </div>

                    <div class="contener-input" id="reg-input2">

                        <div class="error error-login error-desk newloginjs">Логин не может быть больше 32 символов
                        </div>
                        <div class="error error-login error-mob newloginjs">Логин должен быть короче</div>
                        <input class="login" id="newlogin" name="newlogin" placeholder="Придумайте свой логин" type="text" onkeyup="jsERROR('newloginjs','newlogin',6,32)">

                        <div class="error error-newpassword error-desk newpasswordjs">Пароль не может быть больше 32
                            символов</div>
                        <div class="error error-newpassword error-mob newpasswordjs">Пароль должен быть короче</div>
                        <input class="login password" id="newpassword" name="newpassword" placeholder="Придумайте пароль" type="password" onkeyup="jsPass1('newpasswordjs','newpassword')">

                        <div class="error error-newpassword2 error-desk newpassword2js">Пароли не совпадают</div>
                        <div class="error error-newpassword2 error-mob newpassword2js">Пароли не совпадают</div>
                        <input class="login password" id="newpassword2" name="newpassword2" placeholder="Повторите пароль" type="password" onkeyup="jsPass2()">

                        <button class="form-btn" type="button" onclick="checkInput(); nextReg2();">Продолжить</button>
                    </div>

                    <div class="contener-input" id="reg-input3">
                        <input class="login" id="key" name="key" placeholder="Секретный ключ" type="text">
                        <div class="PrivacyPolicy">
                            <input type="checkbox" id="checkboxPrivacyPolicy" name="checkboxPrivacyPolicy" required>
                            <label for="checkboxPrivacyPolicy" class="labelPrivacyPolicy">Я подтверждаю, что ознакомился(-ась) с условиями <div class="PrivacyPolicySsilka" onclick="window.location.href = 'php_form/PrivacyPolicyUser.php'">пользовательского соглашения </div> и согласен(-на) с ними</label>
                        </div>
                        <button class="form-btn">Зарегестрироваться</button>
                    </div>
                </div>
                <div class="acktiv3">Уже есть аккаунт? <a class="RegSing" onclick="logform()">Войти</a>
                </div>
            </form>

            <aside>
                <img class="img-start-left" src="img/fon3.svg">
            </aside>
        </main>
    </div>
    <script src="js/js_reg.js"></script>
</body>

</html>