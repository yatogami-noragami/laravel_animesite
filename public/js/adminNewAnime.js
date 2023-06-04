
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

    //Message Hide

    setTimeout(function () {
        $('#alertBox').hide();
    }, 2000);

    //Get Selected Genres

    let totalVal = "";
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
});

