$(document).ready(function(){

  //Mobile slide in menu
  $('.site-header .menu-button, .main-nav .dismiss .close-icon, .nav-overlay').on('click', function(){
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

  //Scrolldown buttons
  $('button.scroll-down').on('click', function(){

    //Scroll to .main-content by default
    var pos = $('.main-content').position().top;

    $('html, body').animate({
        scrollTop: pos
    }, 580);

  });

  //Contact form submit handler
  $('#contact-form').submit(function(){

    var nameErr = $('#contact-form input[name=your_name]').next('.validation-error');
    var emailErr = $('#contact-form input[name=email]').next('.validation-error');
    var msgErr = $('#contact-form textarea[name=message]').next('.validation-error');

    if(this.your_name.value.trim().length === 0) {
      nameErr.slideDown();
    } else {
      nameErr.hide();
    }

    if(this.email.value.trim().length === 0) {
      emailErr.slideDown();
    } else {
      emailErr.hide();
    }

    if(this.message.value.trim().length === 0) {
      msgErr.slideDown();
    } else {
      msgErr.hide();
    }

    if(nameErr.is(':visible') || emailErr.is(':visible') || msgErr.is(':visible'))
      return false;

    var response = grecaptcha.getResponse();
    if(response.length === 0) {
      return false;
    } else {
      return true;
    }

  });


  /* Add transparency to desktop menu dropdowns on pages with hero graphics */
  if($('.page-hero-header').length > 0)
    $('.main-nav').addClass('overlays-hero');


  /* Post Reading Progress Bar */
  if($('progress.post-progress').length === 1) {

    //Update the progress bar (run on document ready)
    (window.updatePostProgressValue = function() {
      var progress = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
      $('progress.post-progress').attr("value",progress);
    })();

    //Set the max
    var scrollableHeight = document.body.scrollHeight - $('body').outerHeight();
    $('progress.post-progress').attr("max",scrollableHeight);

    //Attach the scroll handler (only execute on idle if possible)
    if('requestIdleCallback' in window) {

      var scrollFunc = function(){
        requestIdleCallback(updatePostProgressValue);
      }

    } else {

      var scrollFunc = function(){
        updatePostProgressValue();
      }

    }

    $(window).on('scroll', scrollFunc);

  }

  /* Font Resizing Controls */
  $('.font-size-controls button').on('click', function(){

    let targetEl = $(this).parent().siblings('.font-size-resizeable');
    let oldValue = targetEl.data('zoom-percent');
    let newValue;

    // Deal with undefined or non int zoom value by setting to 100%
    if(isNaN(parseInt(oldValue))) oldValue = 100;
   
    if($(this).hasClass('font-size-decrease')) newValue = oldValue - 15;
    if($(this).hasClass('font-size-increase')) newValue = oldValue + 15;

    // Limit zoom amount
    if (newValue < 20 || newValue > 500) return;
    
    // Set new sizing
    targetEl.css('font-size', newValue + "%").data('zoom-percent', newValue);

  });

});

/* Once the hero image has loaded, hide the blurred placeholder */
(function() {

  var heroEls = $('.hero-image-container');

  if(heroEls.length === 0)
    return;

  function bestImgSize() {
    var s = screen.width;

    if(s <= 320) return "s";
    if(s <= 640) return "m";
    if(s <= 960) return "l";
    return "xl";

  }

  heroEls.each(function(){

    var suffix = bestImgSize();
    var imgSrc = $(this).data('hero-image-' + suffix);
    var heroImg = new Image();
    window.targetHeroEl = $(this);

    heroImg.onload = function() {
      targetHeroEl.children('.hero-fullres-container').css("background-image", "url('" + imgSrc + "')");
      targetHeroEl.children('.hero-placeholder-container').addClass('hide');
    }

    heroImg.src = imgSrc;

  });

  /* Add line numbers to all code */
  $('code').parents('pre').addClass('line-numbers')

})();

/* Create a Photoswipe lightbox */
function initLightbox() {

  const lightbox = new PhotoSwipeLightbox({
    gallery: '.photo-gallery',
    children: 'li',
    showHideAnimationType: (
      // If thumbnails are visible, zoom the thumbnail into the full gallery. If not fade from nothing.
      document.querySelector('#photo-gallery-thumbnails.visually-hidden') === null ?
         'zoom' : 
         'fade'
    ),
    pswpModule: PhotoSwipe 
  });

  lightbox.on('uiRegister', function() {
    lightbox.pswp.ui.registerElement({
      name: 'custom-caption',
      order: 9,
      isButton: false,
      appendTo: 'wrapper',
      onInit: (el) => {
        lightbox.pswp.on('change', () => {
          const currSlideElement = lightbox.pswp.currSlide.data.element;
          let captionHTML = '';
          if (currSlideElement) {
            captionHTML = currSlideElement.querySelector('a').getAttribute('data-caption');
          }

          if(captionHTML.length > 0) {
            el.innerHTML = "<p>" + captionHTML + "</p>";    
          } else {
            el.innerHTML = '';
          }
        
        });
      }
    });
  });

  let openPhotoGalleryButton = document.getElementById('open-photo-gallery');

  if(openPhotoGalleryButton) {
    openPhotoGalleryButton.onclick = () => {
      document.getElementById('pg-img-0').click();
    }
  }

  return lightbox.init();  

}
