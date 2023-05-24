let remember = false;
let rememberMeImg = document.getElementById("rememberMeImg").style;
let rememberMe = document.getElementById("rememberMe").style;
let labelrememberMe = document.getElementById("labelrememberMe").style;
let zapomnit = document.getElementById("zapomnit");

let popup = document.getElementById("popup").style;
let popup2 = document.getElementById("popup2").style;
let formReg = document.getElementById("form-reg").style;
let formLog = document.getElementById("form-log").style;
let regInput1 = document.getElementById("reg-input1").style;
let regInput2 = document.getElementById("reg-input2").style;
let regInput3 = document.getElementById("reg-input3").style;

let SName = document.getElementById("SName");
let Name = document.getElementById("Name");
let PName = document.getElementById("PName");
let newlogin = document.getElementById("newlogin");
let newpassword = document.getElementById("newpassword");
let newpassword2 = document.getElementById("newpassword2");


showPopup("Неверный логин или пароль", "error")
showPopup("НЕ верный СЕКРЕТНЫЙ ключ!", "error2")
showPopup("Такой пользователь уже СУЩЕСТВУЕТ!", "error3")



function rememberMeFunc() {
    if (remember) { //превратить в серый
        rememberMeImg.display = "none";
        rememberMe.backgroundColor = "rgb(201, 202, 214)";
        rememberMe.border = "none"
        rememberMe.width = "13px";
        rememberMe.height = "13px";
        labelrememberMe.color = "rgb(201, 202, 214)";
        zapomnit.value = "NOzapomnit";
    }
    else { //превратить в зелёный
        rememberMeImg.display = "block";
        rememberMe.backgroundColor = "white";
        rememberMe.border = "2px #00d26a solid"
        rememberMe.width = "9px";
        rememberMe.height = "9px";
        labelrememberMe.color = "#00d26a";
        zapomnit.value = "zapomnit";
    }
    remember = !remember;
}
//Я не уверен что эта функция ещё нужна здесь, но пусть будет
function NotPassword(a) {
    if (a == 'popup') {
        if (popup.display == "block")
            popup.display = "none";
        else
            popup.display = "block";
    }
    else {
        if (a.style.display == "block")
            a.style.display = "none";
        else
            a.style.display = "block";
    }
}


function regform() {//Появиться окну регистрации
    formLog.display = "none";
    formReg.display = "block";
}
function logform() {//Появиться окну регистрации
    formLog.display = "block";
    formReg.display = "none";
}
function nextReg() {
    if (SName.value.length >= 2 && SName.value.length <= 32)
        if (Name.value.length >= 2 && Name.value.length <= 32)
            if (PName.value.length >= 2 && PName.value.length <= 32) {
                regInput1.display = "none";
                regInput2.display = "flex";
            }
            else
                popup2.display = "block";
        else
            popup2.display = "block";
    else
        popup2.display = "block";

}
function nextReg2() {
    if (newlogin.value.length >= 6 && newlogin.value.length <= 32)
        if (newpassword.value.length >= 6 && newpassword.value.length <= 32)
            if (newpassword.value == newpassword2.value) {
                regInput2.display = "none";
                regInput3.display = "flex";
            }
            else
                popup2.display = "block";
        else
            popup2.display = "block";
    else
        popup2.display = "block";
}

function jsERROR(Aclass, Aid) {
    var Aid = document.getElementById(Aid);
    if (Aid.value.length > 32) {
        document.getElementsByClassName(Aclass)[0].style.color = "#D55B44";
        document.getElementsByClassName(Aclass)[1].style.color = "#D55B44";
    }
    else {
        document.getElementsByClassName(Aclass)[0].style.color = "white";
        document.getElementsByClassName(Aclass)[1].style.color = "white";
    }


    if (Aid.value.length >= 6 && Aid.value.length <= 32) {
        Aid.style.backgroundColor = "rgb(248, 251, 252)";

    }
    else {
        Aid.style.backgroundColor = "#ffb8aa";
    }
}


function jsPass1(Aclass, Aid) {
    var pass1 = document.getElementById("newpassword");
    var pass2 = document.getElementById("newpassword2");
    var Aid = document.getElementById(Aid);
    if (Aid.value.length >= 6 && Aid.value.length <= 32)
        Aid.style.backgroundColor = "rgb(248, 251, 252)";
    else
        Aid.style.backgroundColor = "#ffb8aa";

    if (Aid.value.length > 32) {
        document.getElementsByClassName(Aclass)[0].style.color = "#D55B44";
        document.getElementsByClassName(Aclass)[1].style.color = "#D55B44";
    }
    else {
        document.getElementsByClassName(Aclass)[0].style.color = "white";
        document.getElementsByClassName(Aclass)[1].style.color = "white";
    }




    if (pass1.value != pass2.value) {
        document.getElementsByClassName("newpassword2js")[0].style.color = "#D55B44";
        document.getElementsByClassName("newpassword2js")[1].style.color = "#D55B44";
        if (pass2.value.length > 0)
            pass2.style.backgroundColor = "#ffb8aa";
    }
    else {
        document.getElementsByClassName("newpassword2js")[0].style.color = "white";
        document.getElementsByClassName("newpassword2js")[1].style.color = "white";
        pass2.style.backgroundColor = "rgb(248, 251, 252)";
    }
}
function jsPass2() {
    var pass1 = document.getElementById("newpassword");
    var pass2 = document.getElementById("newpassword2");
    if (pass1.value != pass2.value) {
        document.getElementsByClassName("newpassword2js")[0].style.color = "#D55B44";
        document.getElementsByClassName("newpassword2js")[1].style.color = "#D55B44";
        pass2.style.backgroundColor = "#ffb8aa";
    }
    else {
        document.getElementsByClassName("newpassword2js")[0].style.color = "white";
        document.getElementsByClassName("newpassword2js")[1].style.color = "white";
        pass2.style.backgroundColor = "rgb(248, 251, 252)";
    }
}