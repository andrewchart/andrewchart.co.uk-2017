$(document).ready(function(){

  //Mobile slide in menu
  $('.site-header .menu-button, .main-nav .dismiss .close-icon, .nav-overlay').on('click', function(e){
    $('.nav-container').toggleClass('open');
    $('body').toggleClass('nav-open');
  });


  //Mobile menu submenus
  $('.main-nav li.cat-item').on('click', function(e){
    $(this).toggleClass('open');

    if($(this).closest('ul').hasClass('children')) {
      e.stopPropagation();
    } else {
      e.preventDefault();
    }
  });

  //Contact form submit handler
  $('#contact-form').submit(function(){

    var errors = 0;

    var nameErr = $('#contact-form input[name=your_name]').next('.validation-error');
    var emailErr = $('#contact-form input[name=email]').next('.validation-error');
    var msgErr = $('#contact-form textarea[name=message]').next('.validation-error');

    if(this.your_name.value.trim().length === 0) {
      nameErr.slideDown();
    } else {
      nameErr.slideUp();
    }

    if(this.email.value.trim().length === 0) {
      emailErr.slideDown();
    } else {
      emailErr.slideUp();
    }

    if(this.message.value.trim().length === 0) {
      msgErr.slideDown();
    } else {
      msgErr.slideUp();
    }

    if(errors > 0)
      return false;

    var response = grecaptcha.getResponse();
    if(response.length === 0) {
      return false;
    } else {
      return true;
    }

  });

});
