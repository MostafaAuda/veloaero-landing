$(document).ready(function() {
  $('.header__reigster').on('click', function () {
    $(this).toggleClass('animate__animated');
    $('.header__register_form').fadeToggle();
  });

  AOS.init();
});
