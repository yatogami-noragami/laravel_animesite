

$(document).ready(function () {

    //Show/Hide Password

    $('#passwordHideShow').click(function () {
        if ($('#passwordHideShow').hasClass('fa-eye')) {
            $('#passwordHideShow').toggleClass('fa-eye');
            $('#passwordHideShow').toggleClass('fa-eye-slash');
            $('#passwordHideShowTxt').text('hide password');
            $("#oldPassword").prop("type", "text");
            $("#newPassword").prop("type", "text");
            $("#confirmPassword").prop("type", "text");
        }
        else {
            $('#passwordHideShow').toggleClass('fa-eye-slash');
            $('#passwordHideShow').toggleClass('fa-eye');
            $('#passwordHideShowTxt').text('show password');
            $("#oldPassword").prop("type", "password");
            $("#newPassword").prop("type", "password");
            $("#confirmPassword").prop("type", "password");
        }
    });

    $('#passwordHideShowTxt').click(function () {
        $('#passwordHideShow').click();
    });

    //Message Hide

    setTimeout(function () {
        $('#alertBox').hide();
    }, 2000);

    //Preview For Chosen Image

    const input = $('#profileImage');
    const previewImage = $('#previewImage');

    input.on('change', function () {
        const reader = new FileReader();

        reader.onload = function (e) {
            previewImage.attr('src', e.target.result);
            previewImage.css('display', 'block');
        };

        reader.readAsDataURL(input[0].files[0]);
    });

    //Show/Hide Bookmarks

    $('#bookmarkDiv').hide();

    $('#bookmarkBtn').click(function () {
        $('#bookmarkDiv').fadeToggle();
    });

    //Work When Scrolling

    $(window).scroll(function () {

        //Backtotop Button
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

