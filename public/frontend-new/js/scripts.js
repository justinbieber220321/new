var app = app || {};

var spBreak = 767.98;

app.init = function () {
  app.navigationMobile();
  app.sliderKeyvisual();
  app.tabs();
};

app.isMobile = function () {
  return window.matchMedia('(max-width: ' + spBreak + 'px)').matches;
};

app.tabs = function () {
  $('.js-tabs li').click(function () {
    var t = $(this).attr('data-tab');
    $('.js-tabs li').removeClass('is-current'),
    $('.js-tab-content .tab-content').removeClass('is-current'),
    $(this).addClass('is-current'),
    $('#' + t).addClass('is-current');
  });
};

app.sliderKeyvisual = function () {
  if ($('.js-slider-keyvisual').length) {
    $('.js-slider-keyvisual').slick({
      speed: 500,
      dots: true,
      arrows: false,
      autoplay: true,
      autoplaySpeed: 3000
    });
  }
};

var offsetY = window.pageYOffset;

app.closeMenu = function () {
  $('body').css({
    position: 'static',
    top: 'auto'
  });
  $(window).scrollTop(offsetY);
};

app.navigationMobile = function () {
  var navigation = $('.js-navigation');

  $('.js-header-menu').click(function () {
    $('header').toggleClass('is-active');
    $(this).toggleClass('is-active');
    if ($(this).hasClass('is-active')) {
      offsetY = window.pageYOffset;
      $('body').css({
        position: 'fixed',
        top: -offsetY + 'px',
        width: '100%'
      });
      navigation.stop().fadeIn();
    } else {
      app.closeMenu();
      navigation.stop().fadeOut();
    }
    return false;
  });

  $('.js-overlay').click(function () {
    app.closeMenu();
    navigation.stop().fadeOut();
    $('header').removeClass('is-active');
    $('.js-header-menu').removeClass('is-active');
  });
};

$(function () {
  app.init();
});

$(window).on('load', function () {
  /* Font */
  var head = document.getElementsByTagName('head')[0];
  var link = document.createElement('link');
  link.rel = 'stylesheet';
  link.type = 'text/css';
  link.href =
    'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap';
  head.appendChild(link);
});
