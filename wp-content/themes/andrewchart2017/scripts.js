


$(document).ready(function(){

  $('.site-header .menu-button, .main-nav .dismiss .close-icon').on('click', function(){
    $('.nav-container').toggleClass('show');
    $('.main-nav').toggleClass('open');
  });


  $('#contact-form').submit(function(){
    var response = grecaptcha.getResponse();
    if (response.length == 0) {
      return false;
    } else {
      return true;
    }
  });

});
