$(document).ready(function () {

    //Show/Hide Password
    $('#passwordHideShow').click(function () {
        if ($('#passwordHideShow').hasClass('fa-eye')) {
            $('#passwordHideShow').toggleClass('fa-eye');
            $('#passwordHideShow').toggleClass('fa-eye-slash');
            $('#passwordHideShowTxt').text('hide password');
            $("#userPassword").prop("type", "text");
            $("#userConfirmPassword").prop("type", "text");
        }
        else {
            $('#passwordHideShow').toggleClass('fa-eye-slash');
            $('#passwordHideShow').toggleClass('fa-eye');
            $('#passwordHideShowTxt').text('show password');
            $("#userPassword").prop("type", "password");
            $("#userConfirmPassword").prop("type", "password");
        }
    });

    $('#passwordHideShowTxt').click(function () {
        $('#passwordHideShow').click();
    });
});
