function trainerfelder() {

    var babi = 0;
    var psa = 0;
    if ($('#verwendungBabi').is(':checked')) {
        babi = 1;
    } else {
        babi = 0;
    }
    if ($('#verwendungPsa').is(':checked')) {
        if ($('#lehrBefugnisDateiListe').html() == '') {
            psa = 1;
        } else {
            psa = 2;
        }
    } else {
        psa = 0;
    }

    // console.log(babi + ' und psa: ' + psa);

    if (babi == 1) {
        $('#c-2-1').show();
        $('#c-2-a-2').show();
    }
    if (babi == 0) {
        $('#c-2-1').hide();
        $('#c-2-a-2').hide();
    }
    if (psa > 0) {
        $('#c-2-1').show();
        $('#hinweisextra-c-2-1').show();
        $('#c-2-b-1').show();
        $('#c-2-b-2').show();
    }
    if (psa == 2 && babi == 0) {
        $('#c-2-1').hide();
        $('#hinweisextra-c-2-1').hide();
    }
    if (psa == 0) {
        $('#c-2-1').hide();
        $('#hinweisextra-c-2-1').hide();
        $('#c-2-b-1').hide();
        $('#c-2-b-2').hide();
    }
    if (psa == 0 && babi == 1) {
        $('#c-2-1').show();
        $('#hinweisextra-c-2-1').hide();
        $('#c-2-b-1').hide();
        $('#c-2-b-2').hide();
    }
    if (babi == 1) {
        $('#hinweisextra-c-2-1').hide();
    }
}

$(document).ready(function() {

    trainerfelder();


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

    $('.checker').click(function() {
        trainerfelder();
    });

});