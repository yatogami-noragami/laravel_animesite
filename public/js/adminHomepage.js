

$(document).ready(function () {

    //Nav Tab Color

    $('.navTabColor').hover(function () {
        $(this).toggleClass('bg-primary');
    }
    );

    //Show/Hide Sorting

    $('#sorting').hide();

    $('#sortBtn').click(function () {
        $(this).toggleClass('btn-danger');
        $('#sorting').fadeToggle();
    });

    //Message Hide

    setTimeout(function () {
        $('#alertBox').hide();
    }, 2000);

    //Work When Scroll

    $(window).scroll(function () {

        //Backtotop Button Animation

        var body = $('#maindiv');
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




});
