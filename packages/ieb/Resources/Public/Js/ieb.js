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

// Feldermanagement Ansuchen

function ansuchenfelder() {
    if ($('#ansuchenbereich').hasClass('babichecked')) {
        $('.babi').each(function() {
            $(this).addClass('ischecked');
        });
    };
    if ($('#ansuchenbereich').hasClass('psachecked')) {
        $('.psa').each(function() {
            $(this).addClass('ischecked');
        });
    }
};

// Anmerkung öffnen 
function anmerkungoeffnen() {
    $('.anmerkung').each(function() {

        if ($(this).val()) {
            var txt = "Anmerkung zum Upload";
            $(this).prev(".anmerkunglabel").removeClass("labelknopf");
            $(this).prev(".anmerkunglabel").html(txt);

            $(this).show();
        }
    });
}

// +++++++++++++++++++++++++++++++++++++ ready ++++++++++++++++++++++++++++++ //

$(document).ready(function() {

    trainerfelder();
    // validieren();
    anmerkungoeffnen();

    // ######################################## Form Stammdaten öCert


    $('.stammdatenjanein').click(function() {

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

    // ######################################## Form Standort Koop
    $('#pruefBescheid').change(function() {
        if (this.checked) {
            $("#koopschuledatei").hide();
        } else {
            $("#koopschuledatei").show();
        }
    });
    // ######################################## Form Ansuchen Prüfbescheid

    $('.pruefjanein').click(function() {
        if ($(this).hasClass('ja')) {
            $('.nein').removeClass('checked');
            $(this).addClass("checked");
            $('.neinpruef').each(function() {
                $(this).removeClass('ischecked');
            });
            $('.japruef').each(function() {
                $(this).addClass('ischecked');
            });
        };
        if ($(this).hasClass('nein')) {
            $('.ja').removeClass('checked');
            $(this).addClass("checked");
            $('.neinpruef').each(function() {
                $(this).addClass('ischecked');
            });
            $('.japruef').each(function() {
                $(this).removeClass('ischecked');
            });
        }
    });

    // ######################################## Form Ansuchen Tabelle Angebotssteuerung
    $('.angebotssteuerungsperson').change(function() {
        if (this.checked) {
            $(this).parent().parent().addClass('angebotssteuernd');
            $(this).parent().parent().find('.spalte-2 input').show();
        } else {
            $(this).parent().parent().removeClass('angebotssteuernd');
            $(this).parent().parent().find('.spalte-2 input').hide();
            $(this).parent().parent().find('.spalte-2 input').prop('checked', false);
        }
    });

    // ######################################## Form Ansuchen Beraterhinzufügen
    $('.beraterwahl').click(function() {
        $('#verhueller').show();
        $('#beraterwahl').show();
    });

    // ######################################## Form Ansuchen Babi/PSA

    $('.ansuchenjanein').click(function() {
        if ($(this).hasClass('istbabi')) {
            $('.istpsa').removeClass('checked');
            $(this).addClass("checked");
            $('.psa').each(function() {
                $(this).removeClass('ischecked');
            });
            $('.babi').each(function() {
                $(this).addClass('ischecked');
            });
            $('#typ').attr('value', 1);
        };
        if ($(this).hasClass('istpsa')) {
            $('.istbabi').removeClass('checked');
            $(this).addClass("checked");
            $('.psa').each(function() {
                $(this).addClass('ischecked');
            });
            $('.babi').each(function() {
                $(this).removeClass('ischecked');
            });
            $('#typ').attr('value', 2);
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
        $(this).removeClass("labelknopf");
        $(this).next(".anmerkung").show();

    });


});