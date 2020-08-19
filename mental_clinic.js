/* PC版は電話のリンクを削除する */
var ua = navigator.userAgent.toLowerCase();
var isMobile = /iphone/.test(ua)||/android(.+)?mobile/.test(ua);

if (!isMobile) {
    $(document).on('click', 'a[href^="tel:"]', function(e) {
        e.preventDefault();
    });
}

/* スライド */

$(function() {
    $(".slider").slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      fade: true,
      speed: 2000,
      autoplaySpeed: 3000,
      autoplay: true,
      pauseOnFocus: false,
      pauseOnHover: false,
      pauseOnDotsHover: false
    })
});

/* 下からスライドイン */

let windowHeight = $(window).height(); //<- 画面の縦幅

$(window).scroll(function(){

  var scrollPosition = $(this).scrollTop();
  var section_title_first_pos = $('.section-title-first').offset();
  var about_contents_wrapper_pos = $('.about-contents-wrapper').offset();
  var section_title_pos = $('.section-title').offset();
  var time_wrapper_first_pos = $('.time-wrapper-first').offset();
  var time_wrapper_pos = $('.time-wrapper').offset();

  if (scrollPosition > section_title_first_pos.top - windowHeight) {

        $('.section-title-first').css('opacity','1');
        $('.section-title-first').css('transform','translateY(0)');

  }

  if (scrollPosition > about_contents_wrapper_pos.top - windowHeight) {

        $('.about-contents-wrapper').css('opacity','1');
        $('.about-contents-wrapper').css('transform','translateY(0)');

  }

  if (scrollPosition > section_title_pos.top - windowHeight) {

        $('.section-title').css('opacity','1');
        $('.section-title').css('transform','translateY(0)');

  }

  if (scrollPosition > time_wrapper_first_pos.top - windowHeight) {

        $('.time-wrapper-first').css('opacity','1');
        $('.time-wrapper-first').css('transform','translateY(0)');

  }

  if (scrollPosition > time_wrapper_pos.top - windowHeight) {

        $('.time-wrapper').css('opacity','1');
        $('.time-wrapper').css('transform','translateY(0)');

  }

});
