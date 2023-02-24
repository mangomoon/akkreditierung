// Validierung
function validieren() {

    // SKIZZE: if( document.getElementById("videoUploadFile").files.length == 0 )

    $('.req').each(function() {
        console.log($(this).text());
        $(this).addClass('req-leer');
        if (!$(this).val() == '' || !$(this).text()) {
            $(this).removeClass('req-leer');
        }

    });
    $('.reqselect').each(function() {

        if ($("option:selected").val() == '') {
            $(this).addClass('req-leer');
        }

    });
    $('.reqfile').each(function() {
        if ($(this).get[0].files.length == 0) {
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
        psa = 1;
    } else {
        psa = 0;
    }

    // console.log(babi + ' und psa: ' + psa);

    if (babi == 1) {
        $('#c-2-1').show();
        $('#c-2-a-2').show();
    }
    if (babi == 0) {
        $('#c-2-a-2').hide();
    }
    if (psa == 1) {
        $('#c-2-b').show();
        $('#c-2-1').show();
        $('#hinweisextra-c-2-1').show();
    }
    if (psa == 0) {
        $('#c-2-b').hide();
        $('#hinweisextra-c-2-1').hide();
    }
}

// Anmerkung öffnen 
function anmerkungoeffnen() {
    $('.anmerkung').each(function() {

        if ($(this).val()) {
            var txt = "Anmerkung zum Upload";
            $(this).prev(".anmerkunglabel").html(txt);
            $(this).show();
        }
    });
}

$(document).ready(function() {

    trainerfelder();
    // validieren();
    anmerkungoeffnen();

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

    // ######################################## Anmerkung aufklappen

    $('.anmerkunglabel').click(function() {
        var txt = "Anmerkung zum Upload";
        $(this).html(txt);
        $(this).next(".anmerkung").show();
    });


});