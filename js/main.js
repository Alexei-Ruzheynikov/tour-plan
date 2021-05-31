$(document).ready(function () {
  const hotelSwiper = new Swiper(".hotel__slider", {
    // Optional parameters
    loop: true,

    // Navigation arrows
    navigation: {
      nextEl: ".hotel-slider__button--next",
      prevEl: ".hotel-slider__button--prev",
    },
    keyboard: true,
  });
  const reviewsSwiper = new Swiper(".reviews-slider", {
    // Optional parameters
    loop: true,

    // Navigation arrows
    navigation: {
      nextEl: ".reviews-slider__button--next",
      prevEl: ".reviews-slider__button--prev",
    },
    keyboard: true,
  });
  $(".parallax-window").parallax({ imageSrc: "img/newsletter-bg.jpg" });
  // Функция ymaps.ready() будет вызвана, когда
  // загрузятся все компоненты API, а также когда будет готово DOM-дерево.
  ymaps.ready(init);
  function init() {
    // Создание карты.
    var myMap = new ymaps.Map("map", {
      // Координаты центра карты.
      // Порядок по умолчанию: «широта, долгота».
      // Чтобы не определять координаты центра карты вручную,
      // воспользуйтесь инструментом Определение координат.
      center: [55.888008, 36.722365],
      // Уровень масштабирования. Допустимые значения:
      // от 0 (весь мир) до 19.
      zoom: 14,
    });
  }

  var menuButton = $(".menu-button");
  menuButton.on("click", function () {
    $(".navbar-bottom").toggleClass("navbar-bottom--visible");
  });

  var modalButton = $("[data-toggle=modal]");
  var closemodalButton = $(".modal__close");
  modalButton.on("click", openModal);
  closemodalButton.on("click", closeModal);

  function openModal() {
    var targetModal = $(this).attr("data-href");
    $(targetModal).find(".modal__overlay").addClass("modal__overlay--visible");
    $(targetModal).find(".modal__dialog").addClass("modal__dialog--visible");
  }

  function closeModal(event) {
    event.preventDefault();
    var modalOverlay = $(".modal__overlay");
    var modalDialog = $(".modal__dialog");
    modalOverlay.removeClass("modal__overlay--visible");
    modalDialog.removeClass("modal__dialog--visible");
  }

  // Обработка форм
  $(".form").each(function () {
    $(this).validate({
      errorClass: "invalid",
      messages: {
        name: {
          required: "Enter your name",
          minlength: "At least 2 letters",
        },
        email: {
          required: "Enter your contact email",
          email: "Format email of name@domain.com",
        },
        emailstwo: {
          required: "Enter your contact email",
          email: "Format email of name@domain.com",
        },
        phone: {
          required: "Enter your phone number",
          minlength: "At least 10 characters",
        },
      },
    });
  });

  $(".phone").mask("+7 (999) 999-99-99");
});
$(document).keydown(function (e) {
  var code = e.keyCode || e.which;
  var modalOverlay = $(".modal__overlay");
  var modalDialog = $(".modal__dialog");
  if (code == 27) modalDialog.removeClass("modal__dialog--visible");
  if (code == 27) modalOverlay.removeClass("modal__overlay--visible");
});
AOS.init();
