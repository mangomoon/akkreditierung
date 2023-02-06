$(document).ready(function() {

    $('.janein').click(function() {

        if ($(this).hasClass("ja")) {
            var wert = 1;
        } else {
            var wert = 2;
        }
        if (!$(this).hasClass("checked")) {
            $(this).parent().parent().find('.checked').removeClass("checked");
            $(this).addClass("checked");
            var oecertclass = '.oecert-' + wert;
            $(this).parent().parent().find(oecertclass).addClass('checked');
            $('#qmsTyp').attr('value', wert);
        }
    });



    $('.info').click(function() {
        if (!$(this).hasClass("checked")) {
            $(this).addClass("checked");
            $(this).next('.infobox').show();
        } else {
            $(this).removeClass("checked");
            $(this).next('.infobox').hide();
        }
    });
});