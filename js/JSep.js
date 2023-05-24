let searchParams = new URLSearchParams(window.location.search);
let getZapros = searchParams.get('error-login');

if (getZapros == 'error7')
NotPassword(document.getElementById("popup7"))

function NotPassword(a) {
if (a == 'popup') {
    if (popup.display == "block")
        popup.display = "none";
    else
        popup.display = "block";
} else {
    if (a.style.display == "block")
        a.style.display = "none";
    else
        a.style.display = "block";
}
}


