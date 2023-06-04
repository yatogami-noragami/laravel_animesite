$(document).ready(function () {

    //Preview For Chosen Image
    const input = $('#animeImage');
    const previewImage = $('#previewImage');

    input.on('change', function () {
        const reader = new FileReader();

        reader.onload = function (e) {
            previewImage.attr('src', e.target.result);
            previewImage.css('display', 'block');
        };

        reader.readAsDataURL(input[0].files[0]);
    });

    //Show/Hide Genres

    $('#genreDiv').hide();

    $('#genreBtn').click(function () {
        $('#genreDiv').fadeToggle();
    });

    //Get Selected Genres

    let totalVal = $('.genresHidden').val();
    let genre = "";
    $('.genresCheck').click(function () {

        genre = this.name;
        if (totalVal.indexOf(genre) !== -1) {
            totalVal = totalVal.replace(genre + ",", "");
            $('.genresHidden').val(totalVal);
        }
        else {
            totalVal += genre + ",";
            $('.genresHidden').val(totalVal);
        }
    });

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

    //Hide Message

    setTimeout(function () {
        $('#alertBox').hide();
    }, 2000);

});
