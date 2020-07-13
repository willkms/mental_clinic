/*
var _window = $(window),
    introBottom;
 
_window.on('scroll',function(){     
    introBottom = $('.intro').height();
    console.log(introBottom);
    if(_window.scrollTop() > introBottom){
        $('header').addClass('fixed');
    }
    else{
        $('header').removeClass('fixed');   
    }
});
 
_window.trigger('scroll');
*/

/* PC版は電話のリンクを削除する */
var ua = navigator.userAgent.toLowerCase();
var isMobile = /iphone/.test(ua)||/android(.+)?mobile/.test(ua);

if (!isMobile) {
    $(document).on('click', 'a[href^="tel:"]', function(e) {
        e.preventDefault();
    });
}

