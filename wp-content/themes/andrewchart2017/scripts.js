$(document).ready(function(){

  $('.site-header .menu-button, .main-nav .dismiss .close-icon').on('click', function(){
    $('.nav-container').toggleClass('show');
    $('.main-nav').toggleClass('open');
  });

});
