/* PC版は電話のリンクを削除する */
var ua = navigator.userAgent.toLowerCase();
var isMobile = /iphone/.test(ua)||/android(.+)?mobile/.test(ua);

if (!isMobile) {
    $(document).on('click', 'a[href^="tel:"]', function(e) {
        e.preventDefault();
    });
}
