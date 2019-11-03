$(document).ready(function(){

    var btn = $('#button');

    $('#action_menu_btn').click(function(){
        $('.action_menu').toggle();
    });

    $(window).scroll(function() {
        if ($(window).scrollTop() > 300) {
            btn.addClass('show');
        } else {
            btn.removeClass('show');
        }
    });

    btn.on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({scrollTop:0}, '300');
    });

    $('.slider-wrapper-2').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        rows: 1,
        swipeToSlide: true
    });




});




