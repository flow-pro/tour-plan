$(document).ready(function () {
  var hotelSlider = new Swiper(".hotel-slider", {
    // Optional parameters
    loop: true,

    // Navigation arrows
    navigation: {
      nextEl: ".hotel-slider__button--next",
      prevEl: ".hotel-slider__button--prev",
    },
    // effect: "cube",
  });

  var reviewsSlider = new Swiper(".reviews-slider", {
    // Optional parameters
    loop: true,

    // Navigation arrows
    navigation: {
      nextEl: ".reviews-slider__button--next",
      prevEl: ".reviews-slider__button--prev",
    },
  });

  var menuButton = $(".menu-button");
  menuButton.on("click", function () {
    $(".navbar-bottom").toggleClass("navbar-bottom--visible");
  });

  var modalButton = $("[data-toggle=modal]");
  var closeModalButton = $(".modal__close");
  modalButton.on("click", openModal);
  closeModalButton.on("click", closeModal);

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
      rules: {
        name: {
          required: true,
          minlength: 2,
        },
        email: {
          required: true,
          email: true,
        },
        phone: {
          required: true,
          minlength: 16,
        },
      },
      messages: {
        name: {
          required: "Please specify your name",
          minlength: "The name must be at least two letters",
        },
        email: {
          required: "We need your email address",
          email: "Format for email - name@domain.com",
        },
        phone: {
          required: "Please enter your phone number",
          minlength: "Please, at least 15 characters are necessary",
        },
      },
    });
  });

  $(".phone").mask("+7(ZZZ)ZZZ-ZZ-ZZ", {
    autoclear: false,
    watchDataMask: true,
    minlength: true,
    translation: {
      Z: {
        pattern: /[0-9]/,
        optional: true,
      },
    },
  });

  jQuery(function initMap() {
    if (document.qwerySelector(".map") !== null) {
      map = new google.maps.Map(document.qwerySelector(".map"), {
        center: { lat: -34.397, lng: 150.644 },
        zoom: 8,
      });
    }
  });
});
