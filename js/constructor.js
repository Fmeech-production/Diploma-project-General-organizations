/**
 * Отображает всплывающее окно с сообщением об ошибке, если параметр error в строке get запроса соответствует заданному значению. 
 * (можно использовать как обычный попап, с помощью костыля. Для этого в параметр error вставть null)
 *
 * @param {string} message - Сообщение, которое будет отображаться в окне попапа.
 * @param {string} error - Текст ошибки в get запросе страницы у параметра error.
 */
function showPopup(message, error) {
  let searchParams = new URLSearchParams(window.location.search);
  let getZapros = searchParams.get('error');
  if (getZapros == error) {


    const overlay = document.createElement("div");
    overlay.style.position = "fixed";
    overlay.style.top = "0";
    overlay.style.left = "0";
    overlay.style.right = "0";
    overlay.style.bottom = "0";
    overlay.style.backgroundColor = "rgba(0, 0, 0, 0.5)";
    overlay.addEventListener("click", function () {
      document.body.removeChild(popup);
      document.body.removeChild(overlay);
      document.body.style.overflow = "auto";
    });

    document.body.appendChild(overlay);


    const popup = document.createElement("div");
    popup.style.position = "fixed";
    popup.style.top = "50%";
    popup.style.left = "50%";
    popup.style.transform = "translate(-50%, -50%)";
    popup.style.backgroundColor = "white";
    popup.style.padding = "20px 40px";
    popup.style.borderRadius = "10px";
    popup.style.boxShadow = "0px 0px 10px #ccc";

    const closeBtn = document.createElement("span");
    closeBtn.innerHTML = "&times;";
    closeBtn.style.position = "absolute";
    closeBtn.style.top = "10px";
    closeBtn.style.right = "10px";
    closeBtn.style.cursor = "pointer";
    closeBtn.style.width = "20px";
    closeBtn.style.height = "20px";
    closeBtn.style.textAlign = "center";
    closeBtn.style.lineHeight = "20px";
    closeBtn.style.fontSize = "35px";
    closeBtn.addEventListener("click", function () {
      document.body.removeChild(popup);
      document.body.removeChild(overlay);
      document.body.style.overflow = "auto";
    });

    popup.appendChild(closeBtn);

    const messageNode = document.createElement("p");
    messageNode.innerHTML = message;
    messageNode.style.textAlign = "center";
    popup.appendChild(messageNode);

    document.body.style.overflow = "hidden";
    document.body.appendChild(popup);


    //Вау! Следующая строчка оказалась абсолютно не нужна, но я её оставлю, чтобы не забыть, что такое можно делать
    let currentUrl = window.location.href; // current перевод: текущий
    let newUrl = currentUrl.replace("error=", "error-old=");  // replace перевод: заменить
    window.history.replaceState({}, "", newUrl); // State перевод: состояние
  }
}


$(window).on('wheel', function(e) {
  var isOverMain = $(e.target).is("main, main *");
  if (!isOverMain) {
      var delta = e.originalEvent.deltaY;
      var scrollTop = $("main").scrollTop();
      $("main").scrollTop(scrollTop + delta);
  } else {
      e.stopPropagation();
  }
});



$(document).ready(function() {
  $(".slider-box").click(function() {
      $("#phone-switch-toggle").change();
      console.log('Переключение режимов просмотра таблицы.');
  });

  $("#phone-switch-toggle").change(function() {
      console.log('Активировал старый рычаг.');
      $(".block1").toggleClass("hidden");
      $(".block2").toggleClass("hidden");
      $(".phone-switch-background").toggleClass("phone-switch-background-overflow");
      $(".phone-switch-label").toggleClass("phone-switch-label-owerflow");
      $("html").toggleClass("html-overflow");
      $("body").toggleClass("body-overflow");
      $(".wrap").toggleClass("wrap-overflow");
      $('main').toggleClass("main-overflow");
      $("header").toggleClass("header-overflow");
      $("hr").toggleClass("hr-overflow");
      $("#add-user-form").toggleClass("hidden");
  });
});


$("tr").click(function() {
  // если уже есть выделенная строка, убираем выделение
  $("tr").removeClass("highlighted");
  
  // выделяем выбранную строку
  $(this).addClass("highlighted");
});
