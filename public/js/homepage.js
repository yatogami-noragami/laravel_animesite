$(document).ready(function () {

    //Show/Hide Comments
    $('#commentWrite').hide();
    $('#commentRead').hide();

    $('#commentBtn').click(function () {
        $('#commentWrite').fadeToggle();
        $('#commentRead').fadeToggle();
    });

    //Work When Scrolling

    $(window).scroll(function () {

        //Backtotop Button Animation
        var body = $('body');
        var bodyPosition = body.offset().top;

        if ($(window).scrollTop() >= bodyPosition) {
            $('#backToTop').css('animation', 'backToTop 1.5s ease-in-out forwards normal');
        }

    });

    //Backtotop Button

    $('#backToTop').click(function () {
        $("html, body").scrollTop(0);
        return false;
    });

    //Show/Hide Genres

    $('#homegenre').hide();
    $('#animelistgenre').hide();
    $('#newseasongenre').hide();
    $('#moviesgenre').hide();
    $('#populargenre').hide();

    $('#homegenrebtn').click(function () {
        $('#homegenre').fadeToggle();
    });

    $('#animelistgenrebtn').click(function () {
        $('#animelistgenre').fadeToggle();
    });

    $('#newseasongenrebtn').click(function () {
        $('#newseasongenre').fadeToggle();
    });

    $('#moviesgenrebtn').click(function () {
        $('#moviesgenre').fadeToggle();
    });

    $('#populargenrebtn').click(function () {
        $('#populargenre').fadeToggle();
    });


});
