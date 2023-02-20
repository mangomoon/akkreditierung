// Validierung
function validieren() {
    $('.req').each(function() {

        //if ($(this).val() == '') {
        if (!$(this).val() || !$(this).text()) {
            $(this).addClass('req-leer');
        }

    });
    $('.reqselect').each(function() {

        if ($("option:selected").val() == '') {
            $(this).addClass('req-leer');
        }

    });
};

function validierenansuchen() {
    $('.fehlt').each(function() {
        $(this).html("Daten fehlen!");
    });
}

// Feldermanagement Form Trainer Edit

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
    validieren();

    // ######################################## Form Stammdaten öCert

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

    // ######################################## Infobox öffnen

    $('.info').click(function() {
        if (!$(this).hasClass("checked")) {
            $(this).addClass("checked");
            $(this).next('.infobox').show();
        } else {
            $(this).removeClass("checked");
            $(this).next('.infobox').hide();
        }
    });

    // ######################################## FORM Trainer BaBi/PSA

    $('.checker').click(function() {
        trainerfelder();
    });

    // ########################################

    $(".req").focus(function() {
        $(this).removeClass("req-leer");
    });
    $(".reqselect").focus(function() {
        $(this).removeClass("req-leer");
    });


});