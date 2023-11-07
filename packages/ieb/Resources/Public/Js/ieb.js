 // Validierung
 function validieren() {
     
     
     allesda = 1;

     $('.req').each(function() {
         if ($(this).val().length == 0) {
             $(this).addClass('req-leer');
             allesda = 0;
              console.log("Input: " + $(this).attr('id'));
         }
     });
     $('.reqcheckbox').each(function() {
         if (!$(this).is(':checked')) {
             $(this).addClass('req-leer');
             allesda = 0;
              console.log("Check: " + $(this).attr('id'));
         }
     });
     $('.reqtext').each(function() {
         if ($(this).text() == '') {
             $(this).addClass('req-leer');
             allesda = 0;
              console.log("Textarea: " + $(this).attr('id'));
         }
     });

     $('.reqselect').each(function() {
         if ($(this).val() == 0) {
             $(this).addClass('req-leer');
             allesda = 0;
              console.log("Select: " + $(this).attr('id'));
         }
     });

     $('.reqfile').each(function() {
         if ($(this).is('.req-leer')) {
             allesda = 0;
            console.log("File: " + $(this).attr('class'));
         }
     });

     $('#ok').attr('value', allesda);

     console.log("allesda = " + allesda);
 };

 // Vailidierung TRAINER
 function validierentr() {
     okbabi = 0;
     okpsa = 0;
     trbabi = 0;
     trpsa = 0;
     qb = 1;
     qp = 0;
     ll = 1;


    if ($('#verwendungBabi').is(':checked')) {
        trbabi = 1;
    };
    if ($('#verwendungPsa').is(':checked')) {
        trpsa = 1;
    };
    
    if (trbabi == 1) {
        if (($('div.upload-qualifikationBabiDatei').hasClass('req-leer'))  &&  ($('#qualifikationBabi').val()=='')) {
            qb = 0;
        };
        if ($('div.upload-lebenslaufDatei').hasClass('req-leer')) {
            ll = 0;
        };
        if ((qb == 1) && (ll == 1)) {
            okbabi = 1;
            $('#okbabi').attr('value', 1);
        }
    }
    if (trpsa == 1) {
        if (($('div.upload-qualifikationPsaDatei').hasClass('req-leer'))  &&  ($('#qualifikationPsa').val()=='')) {
            qp = 0;  
        } else {
            okpsa = 1;
            $('#okpsa').attr('value', 1);
        };
    }


    //   console.log('okBabi '+ okbabi + ' | okPsa' + okpsa + ' | qb ' + qb+ ' | ll ' + ll+ ' | qp ' + qp);
    //   console.log($('#qualifikationBabi').val());



 }

 function validierenansuchen() {
     allesda = 1;

     validieren();
     $('.fehlt').each(function() {
         $(this).html("Daten fehlen!");
         //allesda = 0;
     });
    //  console.log("Stammdaten: " + allesda);
     bb = 0;
     if ($('#bildungsbereich').hasClass('bb-1')) {
         bb = 1;
     }
     if ($('#bildungsbereich').hasClass('bb-2')) {
         bb = 2;
     }

     // PSA/Babi Bereinigung ################################
     if (bb == 2) {
         if ($('.upload-pruefbescheidDatei').hasClass('ok')) {
             $('.upload-kooperationDatei').removeClass('req-leer');
         }

     } else {
         $('.upload-kooperationDatei').removeClass('reqfile');
         $('#erklaerungd2').removeClass('reqcheckbox');
     }

    // Prüfbescheid Check Erklärung
    if (($('.pruefjanein.ja').hasClass('checked')) && $('#erklaerungd2').not(':checked')) {
        //console.log("Erklärung Wuppe");
        $('#erklaerungd2').addClass('reqcheckbox');
        allesda=0;
    }
     

    //  console.log("allesda ohne bb: " + allesda);

     var komp = 0;
     if ($('#kompetenz1').is(':checked')) {
         komp++;
     };
     if ($('#kompetenz2').is(':checked')) {
         komp++;
     };
     if ($('#kompetenz3').is(':checked')) {
         komp++;
     };
     if ($('#kompetenz4').is(':checked')) {
         komp++;
     };
     if ($('#kompetenz5').is(':checked')) {
         komp++;
     };

     if ((komp < 2)) {
         allesda = 0;
         $('.reqkomp').each(function() {
             $(this).addClass('req-leer');
         })
     }
     console.log("vor komp: allesda: " + allesda);
     console.log("komp: " + komp);


     $('span.multi-select-button').each(function() {
         if ($(this).html() == '') {
             $(this).parent().addClass('reqleer');
         }
     });

    //  Projektleitung
    p = 0;
    $('.projektleitungmail').each(function(){
        if ($(this).is(':checked')) {
            p++;
        }
    });
    if((p==0) || (p >2)) {
        $('#kontakpersonen').show();
        allesda = 0;
    } else {
        $('#kontakpersonen').hide();
    }
    // console.log('Kontakpersonen: '+p);

    // console.log("allesda am Schluss: " + allesda);


   

    if ($('#stammdatencheck').hasClass('ok-0')) {
        allesda = 0;
        $('#stammdatencheck').show();
    } else {
        $('#stammdatencheck').hide();
    };


     $('#ok').attr('value', allesda);
 }



 // Feldermanagement Form Trainer Edit ###############################

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
         $('#c-2-1-babi').show();
         $('#c-2-2').show();
        //  $('.upload-lebenslaufDatei').addClass('reqfile');
     }
     if (babi == 0) {
         $('#c-2-1-babi').hide();
        //  $('.upload-lebenslaufDatei').removeClass('reqfile');
     }
     if (psa == 1) {
         $('#c-2-1-psa').show();
         $('#c-2-2').show();
         $('#hinweisextra-c-2-1').show();
     }
     if (psa == 0) {
         $('#c-2-1-psa').hide();
         $('#hinweisextra-c-2-1').hide();
     }
 }

 // Feldermanagement Ansuchen ############################

 function ansuchenfelder() {
     if ($('#ansuchenbereichbabi').hasClass('babichecked')) {
         $('.babi').each(function() {
             $(this).addClass('ischecked');
         });
     };
     if ($('#ansuchenbereichpsa').hasClass('psachecked')) {
         $('.psa').each(function() {
             $(this).addClass('ischecked');
         });
     }
 };

 // Trainermanagement Ansuchen Prüfbescheid ############################

    function ansuchenTrainerPruefbescheid() {
        if($('.pruefjanein.ja').hasClass('checked')) {
            $('.nur-mit-pruefbescheid').each(function() {
                $(this).show();
            });
        };
    };

 // Anmerkung öffnen  ###################################
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

 // Angebotsstuerung anzeigen zweite Checkbox #####################

 function angebotssteuerungzwei() {

     $('.angebotssteuerungsperson').each(function() {
         if ($(this).is(':checked')) {
             $(this).parent().parent().addClass('angebotssteuernd');
             $(this).parent().parent().find('.spalte-2 input').show();
         }
     });


 }


// Standort Dings ...
 function submitten() {
    $('form').submit();
 };


// Trainer Begutachtung: öffnen der nicht-ok-Kommentarfelder und Check all Kompetenzen... ##########################

function oeffnenTrainerBegutachtung() {
    s = 1;
    var a = 0;
    var b = 0;
    var c = 0;
    var d = 0;
    a = $("#trainerbegutachtung input.c21b:checked").val();
    b = $("#trainerbegutachtung input.c21p:checked").val();
    c = $("#trainerbegutachtung input.c22b:checked").val();
    d = $("#trainerbegutachtung input.c22p:checked").val();
    console.log(a,b,c,d,s);
    
    if (a + b + c + d < 5) {
        s = 1;
    }
    if ((a == 2) || (b == 2) || (c == 2) || (d == 2)) {
        s = 2;
    }
    if ((a == 3) || (b == 3) || (c == 3) || (d == 3)) {
        s = 3;
    }
    if ((a == 4) || (b == 4) || (c == 4) || (d == 4)) {
        s = 4;
    }
    if (s < 3) {
             $('.komm-ext-1').hide();
             $('.komm-ext-2').hide();
    } else {
             $('.komm-ext-1').show();
             $('.komm-ext-2').show();
    }
    console.log(a,b,c,d,s);
    // console.log("a: "+ a + " | b: " + b +  " | c: " + c + " | d: " + d + " | s: " + s);

    var t = 0;
    $('.trainerqualifikationsbegutachtung input').each (function() {
        if($(this).prop('checked')){
            t++;
        }
    });
    if(t == 8){
        $('#checkall').addClass('checked');
    }
};

  
// Berater Begutachtung: öffnen der nicht-ok-Kommentarfelder

function oeffnenBeraterBegutachtung() {
    var s = 1;
    a = $("#beraterbegutachtung input.c3i:checked").val();
    b = $("#beraterbegutachtung input.c32i:checked").val();
    // console.log(a,b,s);
    if (a + b < 3) {
        s = 1;
    }
    if ((a == 2) || (b == 2) ) {
        s = 2;
    }
    if ((a == 3) || (b == 3) ) {
        s = 3;
    }
    if ((a == 4) || (b == 4) ) {
        s = 4;
    }
    if (s < 3) {
        $('.komm-ext').hide();
        $('')
    } else {
        $('.komm-ext').show();
    }
}

// Löschen der Validierung für Uploads bei ACTION=new

function reqleerLoeschen() {
    $('.upload').each(function() {
        $(this).removeClass('req-leer');
    });
}


function qualifikationPsaSprache() {

    if ($('#qualifikationPsa8').is(':checked')   ) {
        $("#qualifikationPsaKommentar").show();
    } else {
        $("#qualifikationPsaKommentar").hide();
    }
}



 // +++++++++++++++++++++++++++++++++++++ ready ++++++++++++++++++++++++++++++ //// +++++++++++++++++++++++++++++++++++++ ready ++++++++++++++++++++++++++++++ //
 // +++++++++++++++++++++++++++++++++++++ ready ++++++++++++++++++++++++++++++ //// +++++++++++++++++++++++++++++++++++++ ready ++++++++++++++++++++++++++++++ //
 // +++++++++++++++++++++++++++++++++++++ ready ++++++++++++++++++++++++++++++ //// +++++++++++++++++++++++++++++++++++++ ready ++++++++++++++++++++++++++++++ //
 // +++++++++++++++++++++++++++++++++++++ ready ++++++++++++++++++++++++++++++ //// +++++++++++++++++++++++++++++++++++++ ready ++++++++++++++++++++++++++++++ //



 $(document).ready(function() {

    
    // Toggle Code

    $('#code-toggler').click(function(){
        $('code').each(function() {
            $(this).toggle();
        });
    });
    $('#validieren-test').click(function(){
        console.log("--------- Bericht: -----------");
        // validieren();
        validierenansuchen();
        // setStatusAfterReview();
        // validierentr();
        
    });
    

// on SUBMIT Berater/Ansuchen/Stammdaten ##########################

     $("form.tr").submit(function(e) {
        validieren();
        if($(this).hasClass('tra')) {

            validierenansuchen();
        }
       saralt = $('#sar').val();
       sar= 0;
       if (saralt == 1) {
            sar = 1;
        } else if (saralt == 3) {
            sar = 3;
        } else if (saralt == 4) {
            sar = 4;
        } else if (saralt == 5) {
            sar = 5;
        } 
        $('input').each(function() {
            
           if($(this).hasClass('geaendert')) {
                if(saralt == 0) {
                    sar = 0;
                } else if (saralt == 1) {
                    sar = 2;
                } else if (saralt == 3) {
                    sar = 4;
                } else if (saralt == 4 && sar < 5) {
                    sar = 4;
                } else if (saralt == 5) {
                    sar = 5;
                } 
                if (($(this).hasClass('status-negativ')) && (saralt > 2)) {
                   sar = 5;
                }
           }

        });

       $('#sar').val(sar);
       


    //    console.log("--------- Bericht: -----------");
    //    console.log("saralt: " + saralt + " sar: " + sar);


    //    e.preventDefault();
    });


// Form SUBMIT Trainer ####################################

    $("form.trtrainer").submit(function(e) {
        validierentr();
        sarBabialt = $('#sarBabi').val();
        sarPsaalt = $('#sarPsa').val();
       sarBabi= 0;
       sarPsa= 0;
       if (sarBabialt == 1) {
        sarBabi = 1;
        } else if (sarBabialt == 3) {
            sarBabi = 3;
        } else if (sarBabialt == 4) {
            sarBabi = 4;
        } else if (sarBabialt == 5) {
            sarBabi = 5;
        } 
        if (sarPsaalt == 1) {
            sarPsa = 1;
        } else if (sarPsaalt == 3) {
            sarPsa = 3;
        } else if (sarPsaalt == 4) {
            sarPsa = 4;
        } else if (sarPsaalt == 5) {
            sarPsa = 5;
        } 
        $('input').each(function() {

           if(($('input#qualifikationBabiDatei').hasClass('geaendert')) || ($('input#lebenslaufDatei').hasClass('geaendert'))) {
                if(sarBabialt == 0) {
                    sarBabi = 0;
                } else if (sarBabialt == 1) {
                    sarBabi = 2;
                } else if (sarBabialt == 3) {
                    sarBabi = 4;
                } else if (sarBabialt == 4 && sarBabi < 5) {
                    sarBabi = 4;
                } else if (sarBabialt == 5) {
                    sarBabi = 5;
                } 
                if (($(this).hasClass('status-negativ')) && (sarBabialt > 2)) {
                    sarBabi = 5;
                }
           }
           if(($('input#qualifikationPsaDatei').hasClass('geaendert')) || ($('input#lebenslaufDatei').hasClass('geaendert'))) {
                if(sarPsaalt == 0) {
                    sarPsa = 0;
                } else if (sarPsaalt == 1) {
                    sarPsa = 2;
                } else if (sarPsaalt == 3) {
                    sarPsa = 4;
                } else if (sarPsaalt == 4 && sarPsa < 5) {
                    sarPsa = 4;
                } else if (sarPsaalt == 5) {
                    sarPsa = 5;
                } 
                if (($(this).hasClass('status-negativ')) && (sarPsaalt > 2)) {
                    sarPsa = 5;
                }
           }
        });


       $('#sarBabi').val(sarBabi);
       $('#sarPsa').val(sarPsa);

    //    console.log("sarBabialt: " +sarBabialt + " | sarBabi: " +sarBabi + " | sarPsaalt: " +sarPsaalt + " | sarPsa: " +sarPsa);
    //    e.preventDefault();
    });


    // Tooltip ###############################
    $('.knopf-quadratisch').hover(function(e) {
        e.preventDefault();
            var title = $(this).attr('title');
            $('#mangoTooltip').html(title);
            var offset = $(this).offset();
            $('#mangoTooltip').css({ 'top':offset.top-20, 'left':offset.left+20 });     
            $('#mangoTooltip').addClass('active');
            $(this).attr('title', '');
            $(this).attr('alt', title);
        },
        function() {
            $('#mangoTooltip').removeClass('active');
            var title = $(this).attr('alt');
            //console.log(title);
            $(this).attr('title', title);
        });

    $('.titleview').hover(function(e) {
                e.preventDefault();
                var title = $(this).attr('title');
                $('#mangoTooltip').html(title);
                var offset = $(this).offset();
                $('#mangoTooltip').css({ 'top':offset.top-20, 'left':offset.left+16 });     
                $('#mangoTooltip').addClass('active');
                $(this).attr('title', '');
                $(this).attr('alt', title);
            },
            function() {
                $('#mangoTooltip').removeClass('active');
                var title = $(this).attr('alt');
                //console.log(title);
                $(this).attr('title', title);
            });

     // MODAL BOX 
     const modal = document.querySelector("#modal");
     const closeModal = document.querySelector(".close");
     closeModal.addEventListener("click", () => {
         modal.close();
     });


     $(".uploadfileinput").on("change", function(e) {
         $(this).parent().parent().parent().removeClass('reqfile');
     });



     // CHECKER
     $("form.tra").submit(function() {
         validierenansuchen();
     });







    // LISTE ANSUCHEN SORTIEREN #################################

    $('.sortierbutton').click(function(){

        $('.sortierbutton').each(function() {
            $(this).removeClass('aktiv');
        });
        $(this).addClass('aktiv');

        c = $(this).attr('id');
        console.log(c);
        $('.ansuchenlistenitem').sort(function(a, b) {

            return $(a).data(c) > $(b).data(c) ? 1 : -1;

          }).appendTo('#ansuchenlistencontainer');
    });


    $('.personarchivieren').click(function() {
        t = $(this).find('.modalcontent').html();
        $('.modalcontent').html(t);
        $(".close").html('Zurück zum Formular');
        $(".close").css('width','220px');
        modal.showModal();
    })

     $("#submitstartstandort").click(function() {

        validieren();
         if (allesda == 1) {
            $('.modalcontent').html('<p>Sie können diese Daten später nicht mehr bearbeiten: bitte achten Sie auf korrekte Angaben!<p><a class="knopfersatz knopf-s" href="javascript:submitten()">Alles korrekt: Daten speichern!</a>');
            $(".close").html('Zurück zum Formular');
            $(".close").css('width','220px');
            modal.showModal();
         }
     });

     // nur bei NEW in T/B
     $("#submitstartperson").click(function() {
        var vn = $('#nachname').val().length;
        var nn = $('#vorname').val().length;
        if ((vn == 0) || (nn == 0)) {
            $('.modalcontent').html('<p>Bitte geben Sie einen vollständigen Namen an!</p>');
            $(".close").html('Zurück zum Formular');
            $(".close").css('width','220px');
            modal.showModal();
         } else {
            submitten();
         }
     });

     // nur bei NEW Ansuchen
     $("form.transuchenneu").submit(function(event) {
         if (($('#typ').val() == 0) || ($('#name').val() == '')) {

             $('.bildungsbereich').addClass('req-leer');
             $('#name').addClass('req-leer');
             $('.modalcontent').html('Bitte Bezeichnung und Bildungsbereich angeben!');
             modal.showModal();
             event.preventDefault();
         }
     });





     trainerfelder();

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
            $('#pruefbescheidCheck').val(1);
             $('.nein').removeClass('checked');
             $(this).addClass("checked");
             $('.neinpruef').each(function() {
                 $(this).removeClass('ischecked');
             });
             $('.japruef').each(function() {
                 $(this).addClass('ischecked');
             });
             ansuchenTrainerPruefbescheid();
         };
         if ($(this).hasClass('nein')) {
            $('#pruefbescheidCheck').val(2);
             $('.ja').removeClass('checked');
             $(this).addClass("checked");
             $('.neinpruef').each(function() {
                 $(this).addClass('ischecked');
             });
             $('.japruef').each(function() {
                 $(this).removeClass('ischecked');
             });
             ansuchenTrainerPruefbescheid();
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
    //  $('.beraterwahl').click(function() {
    //      $('#verhueller').show();
    //      $('#beraterwahl').show();
    //  });

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

     $('.trainerchecker').click(function() {
         trainerfelder();
     });

    // ######################################## FORM Trainer Sprache anhaken öffnet Feld "welche"
     
        $('#qualifikationPsa8').on( "change", function() {
            
            qualifikationPsaSprache(); 
        } );






    // ######################################## überall statusAfterReview setzen bei Edit 
    //   wenn sar = 0 -> s = 0
    //   wenn sar = 1 -> s = 2
    //   wenn Änderung an einem Input, das zu einem negativen Status gehört, vorgenommen wird: 
    //   wenn s = 3 -> s = 5 
    //   wenn andere Änderung wenn s = 3 -> s = 4
    //   

     $( "input" ).on( "change", function() {
        $(this).addClass('geaendert');
      } );


     // ######################################## FORM Begutachtung

     $('.ansuchen .knopf input').click(function() {

        if($(this).parent().hasClass('checked')) {
            $(this).parent().removeClass('checked');
            $(this).parent().parent().find('.nan').prop('checked', true);
            if ($(this).parent().hasClass('nicht-ok')) {
                neu=" ";
                t = $(this).parent().parent().parent().find('.extern').val();
                if (t) {
                    i = $(this).parent().parent().parent().find('.komm-intern-textarea').val();
                    neu = i + " \nnicht ok war:\n" + t;
                    $(this).parent().parent().parent().find('.komm-intern-textarea').val(neu);
                }
                $(this).parent().parent().parent().find('.extern').val('');
            }

        } else {
            $(this).parent().parent().find('.knopf').removeClass('checked');
            $(this).parent().addClass('checked');
        }

        if ($(this).parent().hasClass('nicht-ok')) {
            $(this).parent().parent().parent().find('.komm-ext').toggle();
        } else {
            $(this).parent().parent().parent().find('.komm-ext').hide();
        }

        if ($(this).parent().hasClass('ok')) {
            neu=" ";
            t = $(this).parent().parent().parent().find('.extern').val();
            if (t) {
                i = $(this).parent().parent().parent().find('.komm-intern-textarea').val();
                neu = i + " \nnicht ok war:\n" + t;
                $(this).parent().parent().parent().find('.komm-intern-textarea').val(neu);
            }
            $(this).parent().parent().parent().find('.extern').val('');
            console.log(neu);
        }
     });

     $('.textbausteinoeffner').click(function() {
         $(this).toggleClass('checked');
         $(this).next().toggle();
         
     });
     $('.textbaustein').click(function() {
         var t = $(this).text() + " ";
         var u = $(this).parent().parent().find('.extern').val();
         $(this).parent().parent().find('.extern').val(u + t);
     });

     $('.infoknopf').click(function() {
         $(this).toggleClass('checked');
        //  $(this).parent().parent().parent().parent().find('.erlaeuterung').toggle();
        $(this).parent().parent().parent().parent().find('.erlaeuterung').each(function() {
            $(this).toggle();
        })
     });
     // ########################################


     //  ########################################### FORM Begutachtung Trainer
     $('.teilstatus label.knopf').click(function() {
         

        if($(this).hasClass('checked')) {
            $(this).removeClass('checked');
            $(this).find("input").prop('checked', false);
            $(this).parent().find('.nan').prop('checked', true);
            
            oeffnenTrainerBegutachtung();
            oeffnenBeraterBegutachtung();
        } else {
            $(this).find("input").prop('checked', true);
            
            oeffnenTrainerBegutachtung();
            oeffnenBeraterBegutachtung();
            
            $('#summestatus label').removeClass('checked');
            $(this).parent().parent().find('.knopf').removeClass('checked');
            $(this).addClass('checked');
        }
        

        if ((s == 1) && ($('.extern').val()!='')) {
            neu="";
            t = $('.extern').val();
            i = $('.intern').val();
            neu = i + " \nnicht ok war:\n" + t;
            $('.intern').val(neu);
            $('.extern').val('');
            }

         return false;
     });

     //  ########################################### FORM Begutachtung Trainer Checkall
        $('#checkall').on("change", function(e) {
            if( $(this).hasClass('checked') ) {
                $(this).removeClass('checked');
                $('.trainerqualifikationsbegutachtung input').each (function() {
                    $(this).prop("checked", false);
                    });
            } else {
                $(this).addClass('checked');
                $('.trainerqualifikationsbegutachtung input').each (function() {
                    $(this).prop("checked", true);
                    });
            }
        });

     //  ########################################### FORM Begutachtung Status
        $('.statusbutton').click(function() {
            $('.statusbutton').each(function() {
                $(this).removeClass('active');
            })
            ust = $(this).data('upstatus');
            st = $('.statusbuttonzeile').data('status');
            if(st==150 && ust==200) {
                ust=220
            };
            console.log(st,ust);
            $(this).addClass('active');
            $('#upcomingStatus').val(ust);
         });


     // ######################################## FORM Modal schliessen

     $('#schliessen').click(function() {
        parent.$.fancybox.close();
     });

    // ######################################## SUBMIT UND (!) FORM Modal schliessen



     //  ########################################### FORM Begutachtung Personen: Aktualisieren von AnsuchenBegutachtung/SHOW

     $("#ansuchenbegutachtung").submit(function(e) {

        sar = 0;
        b = 0;
        c = 0;
        x = 0;
        z= 0;
        sarst = 0;
        
        if ($('#typ').hasClass('typ-1')) {
            typ = 1;
        } else {
            typ = 2;
        }

        $('.sartest').each(function() {
            if ($(this).is(':checked') && !$(this).hasClass('f-stammdatenReviewA1') && !$(this).hasClass('f-stammdatenReviewA2')) {
                a = $(this).val();
                console.log(a);
                if (a ==1) {
                    x++;
                } else if (a==4) {
                    b = 3;
                } 
            } else if ($(this).is(':checked') && ($(this).hasClass('f-stammdatenReviewA1') || $(this).hasClass('f-stammdatenReviewA2'))) {
                
                y = $(this).val();

                if (y ==1) {
                    z++;
                } else if (y==4) {
                    c = 3;
                }
            }
        });

        if (typ == 1) {
            if (x == 8) {
                b = 1;
            }
        } else if (typ == 2) {
            if (x == 9) {
                b = 1;
            }
        }

        if (z == 2) {
            c = 1;
        }
        //console.log("b: " +b + " x: " + x + " typ " + typ);

        $('#sar').val(b);
        $('#sar-stammdaten').val(c);

        



        //e.preventDefault(); // Achtung!
     });

     $("#beraterbegutachtung").submit(function() {
        
        var t = $('#beraterId').val();
        var s1 = $("#beraterbegutachtung input.c3i:checked").val();
        var s2 = $("#beraterbegutachtung input.c32i:checked").val();
        var c1 = 'status-'+s1;
        var c2 = 'status-'+s2;
        var a = '#berater-'+ t +' .person-statuskugel-a';
        var b = '#berater-'+ t +' .person-statuskugel-b';
        
        $(a, window.parent.document).removeClass('status-0');
        $(a, window.parent.document).removeClass('status-1');
        $(a, window.parent.document).removeClass('status-2');
        $(a, window.parent.document).removeClass('status-3');
        $(a, window.parent.document).removeClass('status-4');
        $(a, window.parent.document).addClass(c1);
        $(b, window.parent.document).removeClass('status-0');
        $(b, window.parent.document).removeClass('status-1');
        $(b, window.parent.document).removeClass('status-2');
        $(b, window.parent.document).removeClass('status-3');
        $(b, window.parent.document).removeClass('status-4');
        $(b, window.parent.document).addClass(c2);
        

        s1 = parseInt(s1);
        s2 = parseInt(s2);
        if (s1 + s2 == 2) {
            $('#sar').val(1);
        } else if ((s1 > 2) || (s2 > 2)) {
            $('#sar').val(3);
        }  

        parent.$.fancybox.close();

    });

    // $("#trainerbegutachtung").submit(function(e) {
        $("#trainerbegutachtung").on( "submit", function() {



        var t = $('#trainerId').val();
        var as = $("#trainerbegutachtung input.c21b:checked").val();
        var bs = $("#trainerbegutachtung input.c22b:checked").val();
        var cs = $("#trainerbegutachtung input.c21p:checked").val();
        var ds = $("#trainerbegutachtung input.c22p:checked").val();
        var ac = 'status-'+as;
        var bc = 'status-'+bs;
        var cc = 'status-'+cs;
        var dc = 'status-'+ds;
        var a = '#trainer-'+ t +' .person-statuskugel-a';
        var b = '#trainer-'+ t +' .person-statuskugel-b';
        var c = '#trainer-'+ t +' .person-statuskugel-c';
        var d = '#trainer-'+ t +' .person-statuskugel-d';
        // Bildungsbereich:
        var at = $('#at').html();
        
        if (at == 1) {
            $(a, window.parent.document).removeClass('status-0');
            $(a, window.parent.document).removeClass('status-1');
            $(a, window.parent.document).removeClass('status-2');
            $(a, window.parent.document).removeClass('status-3');
            $(a, window.parent.document).removeClass('status-4');
            $(b, window.parent.document).removeClass('status-0');
            $(b, window.parent.document).removeClass('status-1');
            $(b, window.parent.document).removeClass('status-2');
            $(b, window.parent.document).removeClass('status-3');
            $(b, window.parent.document).removeClass('status-4');
        }
        if (at == 2) {
            $(c, window.parent.document).removeClass('status-0');
            $(c, window.parent.document).removeClass('status-1');
            $(c, window.parent.document).removeClass('status-2');
            $(c, window.parent.document).removeClass('status-3');
            $(c, window.parent.document).removeClass('status-4');
            $(d, window.parent.document).removeClass('status-0');
            $(d, window.parent.document).removeClass('status-1');
            $(d, window.parent.document).removeClass('status-2');
            $(d, window.parent.document).removeClass('status-3');
            $(d, window.parent.document).removeClass('status-4');
        }

        $(a, window.parent.document).addClass(ac);
        $(b, window.parent.document).addClass(bc);
        $(c, window.parent.document).addClass(cc);
        $(d, window.parent.document).addClass(dc);

        if((ds == 4) || (cs == 4)) {
            $('#okpsa').val(0);
        } else {
            $('#okpsa').val(1);
        }
        if((as == 4) || (bs == 4)) {
            $('#okbabi').val(0);
        } else {
            $('#okbabi').val(1);
        }

        // ############### SAR

        if (at == 1) {
            //mb = $('#sarBabi').val();
            nb = 0;
            as = parseInt(as);
            bs = parseInt(bs);
            if (as + bs == 2) {
                //nb = 1,
                $('#sarBabi').val(1);
            } else if ((bs > 2) || (as > 2)) {
                //nb = 2;
                $('#sarBabi').val(3);
            }  
        }


        if (at == 2) {
            //mp = $('#sarPsa').val();
            np = 0;
            cs = parseInt(cs);
            ds = parseInt(ds);
            if (cs + ds == 2) {
                //np = 1;
                $('#sarPsa').val(1);
            } else if ((cs > 2) || (ds > 2)) {
                //np = 2;
                $('#sarPsa').val(3);
            }
            //console.log("np: " + np)
            //console.log("cs: " +cs+" ds: "+ds);
        }
        
        //console.log(as,bs);
        // parent.jQuery.fancybox.fadeOut( 2000 );
        // parent.jQuery.fancybox.close();
       
    });


    $('fancyclose').click(function(){
        parent.$.fancybox.close();
    });

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

     // ######################################## Datei löschen

     $('.filedelete').click(function() {
         $(this).parent().toggleClass("geloescht");
         var s = $('.nextdel input');
        $(this).parent().find(s).prop("checked", true);
     });


     // ######################################## Sidebar

     $('#seite-nach-oben').click(function() {
        $('html, body').animate({scrollTop: "0px"}, 600);
     });
     $('#seite-nach-unten').click(function() {
        $("html, body").animate({ scrollTop: $(document).height() }, 600);
     });
     $('#notitzzettel-oeffnen').click(function() {
        $('#notitzzettel').toggle();
     });
 });

 // JQUERY MULTISELECT ########################################

 (function(d) {
     function g(a, b) {
         this.h = d(a);
         this.g = d.extend({}, k, b);
         this.U()
     }
     var k = {
         containerHTML: '<div class="multi-select-container">',
         menuHTML: '<div class="multi-select-menu">',
         buttonHTML: '<span class="multi-select-button">',
         menuItemsHTML: '<div class="multi-select-menuitems">',
         menuItemHTML: '<label class="multi-select-menuitem">',
         presetsHTML: '<div class="multi-select-presets">',
         modalHTML: void 0,
         menuItemTitleClass: "multi-select-menuitem--titled",
         activeClass: "multi-select-container--open",
         noneText: "-- Select --",
         allText: void 0,
         presets: void 0,
         positionedMenuClass: "multi-select-container--positioned",
         positionMenuWithin: void 0,
         viewportBottomGutter: 20,
         menuMinHeight: 200
     };
     d.extend(g.prototype, {
         U: function() {
             this.J();
             this.S();
             this.L();
             this.K();
             this.M();
             this.P();
             this.V();
             this.W();
             this.T()
         },
         J: function() { if (!1 === this.h.is("select[multiple]")) throw Error("$.multiSelect only works on <select multiple> elements"); },
         S: function() { this.u = d('label[for="' + this.h.attr("id") + '"]') },
         L: function() {
             this.j = d(this.g.containerHTML);
             this.h.data("multi-select-container", this.j);
             this.j.insertAfter(this.h)
         },
         K: function() {
             var a = this;
             this.l = d(this.g.buttonHTML);
             this.l.attr({ role: "button", "aria-haspopup": "true", tabindex: 0, "aria-label": this.u.eq(0).text() }).on("keydown.multiselect", function(b) {
                 var c = b.which;
                 13 === c || 32 === c ? (b.preventDefault(), a.l.click()) : 40 === c ? (b.preventDefault(), a.C(), (a.o || a.m).children().first().focus()) : 27 === c && a.s()
             }).on("click.multiselect", function() { a.D() }).on("blur.multiselect", this.v.bind(this)).appendTo(this.j);
             this.h.on("change.multiselect", function() { a.G() });
             this.G()
         },
         G: function() {
             var a = [],
                 b = [];
             this.h.find("option").each(function() {
                 var c = d(this).text();
                 a.push(c);
                 d(this).is(":selected") && b.push(d.trim(c))
             });
             this.l.empty();
             0 == b.length ? this.l.text(this.g.noneText) : b.length === a.length && this.g.allText ? this.l.text(this.g.allText) : this.l.text(b.join(", "))
         },
         M: function() {
             var a = this;
             this.i = d(this.g.menuHTML);
             this.i.attr({ role: "menu" }).on("keyup.multiselect", function(b) { 27 === b.which && (a.s(), a.l.focus()) }).appendTo(this.j);
             this.N();
             this.g.presets && this.R()
         },
         N: function() {
             var a = this;
             this.m = d(this.g.menuItemsHTML);
             this.i.append(this.m);
             this.h.on("change.multiselect", function(b, c) {!0 !== c && a.H() });
             this.H()
         },
         H: function() {
             var a = this;
             this.m.empty();
             this.h.children("optgroup,option").each(function(b, c) { "OPTION" === c.nodeName ? (b = a.B(d(c), b), a.m.append(b)) : a.O(d(c), b) })
         },
         F: function(a, b) {
             var c = b.which;
             38 === c ? (b.preventDefault(), b = d(b.currentTarget).prev(), b.length ? b.focus() : this.o && "menuitem" === a ? this.o.children().last().focus() :
                 this.l.focus()) : 40 === c && (b.preventDefault(), b = d(b.currentTarget).next(), b.length || "menuitem" === a ? b.focus() : this.m.children().first().focus())
         },
         R: function() {
             var a = this;
             this.o = d(this.g.presetsHTML);
             this.i.prepend(this.o);
             d.each(this.g.presets, function(b, c) {
                 b = a.h.attr("name") + "_preset_" + b;
                 var f = d(a.g.menuItemHTML).attr({ "for": b, role: "menuitem" }).text(" " + c.name).on("keydown.multiselect", a.F.bind(a, "preset")).appendTo(a.o);
                 b = d("<input>").attr({ type: "radio", name: a.h.attr("name") + "_presets", id: b }).prependTo(f);
                 c.all && (c.options = [], a.h.find("option").each(function() {
                     var e = d(this).val();
                     c.options.push(e)
                 }));
                 b.on("change.multiselect", function() {
                     a.h.val(c.options);
                     a.h.trigger("change")
                 }).on("blur.multiselect", a.v.bind(a))
             });
             this.h.on("change.multiselect", function() { a.I() });
             this.I()
         },
         I: function() {
             var a = this;
             d.each(this.g.presets, function(b, c) {
                 b = a.h.attr("name") + "_preset_" + b;
                 b = a.o.find("#" + b);
                 a: {
                     c = c.options || [];
                     var f = a.h.val() || [];
                     if (c.length != f.length) c = !1;
                     else {
                         c.sort();
                         f.sort();
                         for (var e = 0; e < c.length; e++)
                             if (c[e] !==
                                 f[e]) { c = !1; break a }
                         c = !0
                     }
                 }
                 c ? b.prop("checked", !0) : b.prop("checked", !1)
             })
         },
         O: function(a, b) {
             var c = this;
             a.children("option").each(function(f, e) {
                 e = c.B(d(e), b + "_" + f);
                 var h = c.g.menuItemTitleClass;
                 0 !== f && (h += "sr");
                 e.addClass(h).attr("data-group-title", a.attr("label"));
                 c.m.append(e)
             })
         },
         B: function(a, b) {
             var c = this.h.attr("name") + "_" + b;
             b = d(this.g.menuItemHTML).attr({ "for": c, role: "menuitem" }).on("keydown.multiselect", this.F.bind(this, "menuitem")).text(" " + a.text());
             c = d("<input>").attr({ type: "checkbox", id: c, value: a.val() }).prependTo(b);
             a.is(":disabled") && c.attr("disabled", "disabled");
             a.is(":selected") && c.prop("checked", "checked");
             c.on("change.multiselect", function() {
                 d(this).prop("checked") ? a.prop("selected", !0) : a.prop("selected", !1);
                 a.trigger("change", [!0])
             }).on("blur.multiselect", this.v.bind(this));
             return b
         },
         P: function() {
             var a = this;
             this.g.modalHTML && (this.A = d(this.g.modalHTML), this.A.on("click.multiselect", function() { a.s() }), this.A.insertBefore(this.i))
         },
         V: function() {
             var a = this;
             d("html").on("click.multiselect", function() { a.s() });
             this.j.on("click.multiselect", function(b) { b.stopPropagation() })
         },
         W: function() {
             var a = this;
             this.u.on("click.multiselect", function(b) {
                 b.preventDefault();
                 b.stopPropagation();
                 a.D()
             })
         },
         T: function() {
             this.h.hide();
             this.u.removeAttr("for")
         },
         C: function() {
             d("html").trigger("click.multiselect");
             this.j.addClass(this.g.activeClass);
             if (this.g.positionMenuWithin && this.g.positionMenuWithin instanceof d) {
                 var a = this.i.offset().left + this.i.outerWidth(),
                     b = this.g.positionMenuWithin.offset().left + this.g.positionMenuWithin.outerWidth();
                 a > b && (this.i.css("width", b - this.i.offset().left), this.j.addClass(this.g.positionedMenuClass))
             }
             a = this.i.offset().top + this.i.outerHeight();
             b = d(window).scrollTop() + d(window).height();
             a > b - this.g.viewportBottomGutter ? this.i.css({ maxHeight: Math.max(b - this.g.viewportBottomGutter - this.i.offset().top, this.g.menuMinHeight), overflow: "scroll" }) : this.i.css({ maxHeight: "", overflow: "" })
         },
         s: function() {
             this.j.removeClass(this.g.activeClass);
             this.j.removeClass(this.g.positionedMenuClass);
             this.i.css("width", "auto")
         },
         D: function() { this.j.hasClass(this.g.activeClass) ? this.s() : this.C() },
         v: function(a) { a.relatedTarget && !d(a.relatedTarget).closest(this.j).length && this.s() }
     });
     d.fn.multiSelect = function(a) { return this.each(function() { d.data(this, "plugin_multiSelect") || d.data(this, "plugin_multiSelect", new g(this, a)) }) }
 })(jQuery);



//  JQUERY UI Draggable #################################################################################################################


/*! jQuery UI - v1.13.2 - 2023-10-25
* http://jqueryui.com
* Includes: widget.js, position.js, data.js, scroll-parent.js, widgets/draggable.js, widgets/mouse.js
* Copyright jQuery Foundation and other contributors; Licensed MIT */

!function(t){"use strict";"function"==typeof define&&define.amd?define(["jquery"],t):t(jQuery)}(function(P){"use strict";P.ui=P.ui||{};P.ui.version="1.13.2";var o,i=0,r=Array.prototype.hasOwnProperty,l=Array.prototype.slice;P.cleanData=(o=P.cleanData,function(t){for(var e,i,s=0;null!=(i=t[s]);s++)(e=P._data(i,"events"))&&e.remove&&P(i).triggerHandler("remove");o(t)}),P.widget=function(t,i,e){var s,o,n,r={},l=t.split(".")[0],a=l+"-"+(t=t.split(".")[1]);return e||(e=i,i=P.Widget),Array.isArray(e)&&(e=P.extend.apply(null,[{}].concat(e))),P.expr.pseudos[a.toLowerCase()]=function(t){return!!P.data(t,a)},P[l]=P[l]||{},s=P[l][t],o=P[l][t]=function(t,e){if(!this||!this._createWidget)return new o(t,e);arguments.length&&this._createWidget(t,e)},P.extend(o,s,{version:e.version,_proto:P.extend({},e),_childConstructors:[]}),(n=new i).options=P.widget.extend({},n.options),P.each(e,function(e,s){function o(){return i.prototype[e].apply(this,arguments)}function n(t){return i.prototype[e].apply(this,t)}r[e]="function"==typeof s?function(){var t,e=this._super,i=this._superApply;return this._super=o,this._superApply=n,t=s.apply(this,arguments),this._super=e,this._superApply=i,t}:s}),o.prototype=P.widget.extend(n,{widgetEventPrefix:s&&n.widgetEventPrefix||t},r,{constructor:o,namespace:l,widgetName:t,widgetFullName:a}),s?(P.each(s._childConstructors,function(t,e){var i=e.prototype;P.widget(i.namespace+"."+i.widgetName,o,e._proto)}),delete s._childConstructors):i._childConstructors.push(o),P.widget.bridge(t,o),o},P.widget.extend=function(t){for(var e,i,s=l.call(arguments,1),o=0,n=s.length;o<n;o++)for(e in s[o])i=s[o][e],r.call(s[o],e)&&void 0!==i&&(P.isPlainObject(i)?t[e]=P.isPlainObject(t[e])?P.widget.extend({},t[e],i):P.widget.extend({},i):t[e]=i);return t},P.widget.bridge=function(n,e){var r=e.prototype.widgetFullName||n;P.fn[n]=function(i){var t="string"==typeof i,s=l.call(arguments,1),o=this;return t?this.length||"instance"!==i?this.each(function(){var t,e=P.data(this,r);return"instance"===i?(o=e,!1):e?"function"!=typeof e[i]||"_"===i.charAt(0)?P.error("no such method '"+i+"' for "+n+" widget instance"):(t=e[i].apply(e,s))!==e&&void 0!==t?(o=t&&t.jquery?o.pushStack(t.get()):t,!1):void 0:P.error("cannot call methods on "+n+" prior to initialization; attempted to call method '"+i+"'")}):o=void 0:(s.length&&(i=P.widget.extend.apply(null,[i].concat(s))),this.each(function(){var t=P.data(this,r);t?(t.option(i||{}),t._init&&t._init()):P.data(this,r,new e(i,this))})),o}},P.Widget=function(){},P.Widget._childConstructors=[],P.Widget.prototype={widgetName:"widget",widgetEventPrefix:"",defaultElement:"<div>",options:{classes:{},disabled:!1,create:null},_createWidget:function(t,e){e=P(e||this.defaultElement||this)[0],this.element=P(e),this.uuid=i++,this.eventNamespace="."+this.widgetName+this.uuid,this.bindings=P(),this.hoverable=P(),this.focusable=P(),this.classesElementLookup={},e!==this&&(P.data(e,this.widgetFullName,this),this._on(!0,this.element,{remove:function(t){t.target===e&&this.destroy()}}),this.document=P(e.style?e.ownerDocument:e.document||e),this.window=P(this.document[0].defaultView||this.document[0].parentWindow)),this.options=P.widget.extend({},this.options,this._getCreateOptions(),t),this._create(),this.options.disabled&&this._setOptionDisabled(this.options.disabled),this._trigger("create",null,this._getCreateEventData()),this._init()},_getCreateOptions:function(){return{}},_getCreateEventData:P.noop,_create:P.noop,_init:P.noop,destroy:function(){var i=this;this._destroy(),P.each(this.classesElementLookup,function(t,e){i._removeClass(e,t)}),this.element.off(this.eventNamespace).removeData(this.widgetFullName),this.widget().off(this.eventNamespace).removeAttr("aria-disabled"),this.bindings.off(this.eventNamespace)},_destroy:P.noop,widget:function(){return this.element},option:function(t,e){var i,s,o,n=t;if(0===arguments.length)return P.widget.extend({},this.options);if("string"==typeof t)if(n={},t=(i=t.split(".")).shift(),i.length){for(s=n[t]=P.widget.extend({},this.options[t]),o=0;o<i.length-1;o++)s[i[o]]=s[i[o]]||{},s=s[i[o]];if(t=i.pop(),1===arguments.length)return void 0===s[t]?null:s[t];s[t]=e}else{if(1===arguments.length)return void 0===this.options[t]?null:this.options[t];n[t]=e}return this._setOptions(n),this},_setOptions:function(t){for(var e in t)this._setOption(e,t[e]);return this},_setOption:function(t,e){return"classes"===t&&this._setOptionClasses(e),this.options[t]=e,"disabled"===t&&this._setOptionDisabled(e),this},_setOptionClasses:function(t){var e,i,s;for(e in t)s=this.classesElementLookup[e],t[e]!==this.options.classes[e]&&s&&s.length&&(i=P(s.get()),this._removeClass(s,e),i.addClass(this._classes({element:i,keys:e,classes:t,add:!0})))},_setOptionDisabled:function(t){this._toggleClass(this.widget(),this.widgetFullName+"-disabled",null,!!t),t&&(this._removeClass(this.hoverable,null,"ui-state-hover"),this._removeClass(this.focusable,null,"ui-state-focus"))},enable:function(){return this._setOptions({disabled:!1})},disable:function(){return this._setOptions({disabled:!0})},_classes:function(o){var n=[],r=this;function t(t,e){for(var i,s=0;s<t.length;s++)i=r.classesElementLookup[t[s]]||P(),i=o.add?(function(){var i=[];o.element.each(function(t,e){P.map(r.classesElementLookup,function(t){return t}).some(function(t){return t.is(e)})||i.push(e)}),r._on(P(i),{remove:"_untrackClassesElement"})}(),P(P.uniqueSort(i.get().concat(o.element.get())))):P(i.not(o.element).get()),r.classesElementLookup[t[s]]=i,n.push(t[s]),e&&o.classes[t[s]]&&n.push(o.classes[t[s]])}return(o=P.extend({element:this.element,classes:this.options.classes||{}},o)).keys&&t(o.keys.match(/\S+/g)||[],!0),o.extra&&t(o.extra.match(/\S+/g)||[]),n.join(" ")},_untrackClassesElement:function(i){var s=this;P.each(s.classesElementLookup,function(t,e){-1!==P.inArray(i.target,e)&&(s.classesElementLookup[t]=P(e.not(i.target).get()))}),this._off(P(i.target))},_removeClass:function(t,e,i){return this._toggleClass(t,e,i,!1)},_addClass:function(t,e,i){return this._toggleClass(t,e,i,!0)},_toggleClass:function(t,e,i,s){var o="string"==typeof t||null===t,i={extra:o?e:i,keys:o?t:e,element:o?this.element:t,add:s="boolean"==typeof s?s:i};return i.element.toggleClass(this._classes(i),s),this},_on:function(o,n,t){var r,l=this;"boolean"!=typeof o&&(t=n,n=o,o=!1),t?(n=r=P(n),this.bindings=this.bindings.add(n)):(t=n,n=this.element,r=this.widget()),P.each(t,function(t,e){function i(){if(o||!0!==l.options.disabled&&!P(this).hasClass("ui-state-disabled"))return("string"==typeof e?l[e]:e).apply(l,arguments)}"string"!=typeof e&&(i.guid=e.guid=e.guid||i.guid||P.guid++);var s=t.match(/^([\w:-]*)\s*(.*)$/),t=s[1]+l.eventNamespace,s=s[2];s?r.on(t,s,i):n.on(t,i)})},_off:function(t,e){e=(e||"").split(" ").join(this.eventNamespace+" ")+this.eventNamespace,t.off(e),this.bindings=P(this.bindings.not(t).get()),this.focusable=P(this.focusable.not(t).get()),this.hoverable=P(this.hoverable.not(t).get())},_delay:function(t,e){var i=this;return setTimeout(function(){return("string"==typeof t?i[t]:t).apply(i,arguments)},e||0)},_hoverable:function(t){this.hoverable=this.hoverable.add(t),this._on(t,{mouseenter:function(t){this._addClass(P(t.currentTarget),null,"ui-state-hover")},mouseleave:function(t){this._removeClass(P(t.currentTarget),null,"ui-state-hover")}})},_focusable:function(t){this.focusable=this.focusable.add(t),this._on(t,{focusin:function(t){this._addClass(P(t.currentTarget),null,"ui-state-focus")},focusout:function(t){this._removeClass(P(t.currentTarget),null,"ui-state-focus")}})},_trigger:function(t,e,i){var s,o,n=this.options[t];if(i=i||{},(e=P.Event(e)).type=(t===this.widgetEventPrefix?t:this.widgetEventPrefix+t).toLowerCase(),e.target=this.element[0],o=e.originalEvent)for(s in o)s in e||(e[s]=o[s]);return this.element.trigger(e,i),!("function"==typeof n&&!1===n.apply(this.element[0],[e].concat(i))||e.isDefaultPrevented())}},P.each({show:"fadeIn",hide:"fadeOut"},function(n,r){P.Widget.prototype["_"+n]=function(e,t,i){var s,o=(t="string"==typeof t?{effect:t}:t)?!0!==t&&"number"!=typeof t&&t.effect||r:n;"number"==typeof(t=t||{})?t={duration:t}:!0===t&&(t={}),s=!P.isEmptyObject(t),t.complete=i,t.delay&&e.delay(t.delay),s&&P.effects&&P.effects.effect[o]?e[n](t):o!==n&&e[o]?e[o](t.duration,t.easing,i):e.queue(function(t){P(this)[n](),i&&i.call(e[0]),t()})}});var s,x,T,n,a,h,p,c,C;P.widget;function H(t,e,i){return[parseFloat(t[0])*(c.test(t[0])?e/100:1),parseFloat(t[1])*(c.test(t[1])?i/100:1)]}function k(t,e){return parseInt(P.css(t,e),10)||0}function D(t){return null!=t&&t===t.window}x=Math.max,T=Math.abs,n=/left|center|right/,a=/top|center|bottom/,h=/[\+\-]\d+(\.[\d]+)?%?/,p=/^\w+/,c=/%$/,C=P.fn.position,P.position={scrollbarWidth:function(){if(void 0!==s)return s;var t,e=P("<div style='display:block;position:absolute;width:200px;height:200px;overflow:hidden;'><div style='height:300px;width:auto;'></div></div>"),i=e.children()[0];return P("body").append(e),t=i.offsetWidth,e.css("overflow","scroll"),t===(i=i.offsetWidth)&&(i=e[0].clientWidth),e.remove(),s=t-i},getScrollInfo:function(t){var e=t.isWindow||t.isDocument?"":t.element.css("overflow-x"),i=t.isWindow||t.isDocument?"":t.element.css("overflow-y"),e="scroll"===e||"auto"===e&&t.width<t.element[0].scrollWidth;return{width:"scroll"===i||"auto"===i&&t.height<t.element[0].scrollHeight?P.position.scrollbarWidth():0,height:e?P.position.scrollbarWidth():0}},getWithinInfo:function(t){var e=P(t||window),i=D(e[0]),s=!!e[0]&&9===e[0].nodeType;return{element:e,isWindow:i,isDocument:s,offset:!i&&!s?P(t).offset():{left:0,top:0},scrollLeft:e.scrollLeft(),scrollTop:e.scrollTop(),width:e.outerWidth(),height:e.outerHeight()}}},P.fn.position=function(c){if(!c||!c.of)return C.apply(this,arguments);var f,u,d,g,m,t,v="string"==typeof(c=P.extend({},c)).of?P(document).find(c.of):P(c.of),_=P.position.getWithinInfo(c.within),w=P.position.getScrollInfo(_),y=(c.collision||"flip").split(" "),b={},e=9===(t=(e=v)[0]).nodeType?{width:e.width(),height:e.height(),offset:{top:0,left:0}}:D(t)?{width:e.width(),height:e.height(),offset:{top:e.scrollTop(),left:e.scrollLeft()}}:t.preventDefault?{width:0,height:0,offset:{top:t.pageY,left:t.pageX}}:{width:e.outerWidth(),height:e.outerHeight(),offset:e.offset()};return v[0].preventDefault&&(c.at="left top"),u=e.width,d=e.height,m=P.extend({},g=e.offset),P.each(["my","at"],function(){var t,e,i=(c[this]||"").split(" ");(i=1===i.length?n.test(i[0])?i.concat(["center"]):a.test(i[0])?["center"].concat(i):["center","center"]:i)[0]=n.test(i[0])?i[0]:"center",i[1]=a.test(i[1])?i[1]:"center",t=h.exec(i[0]),e=h.exec(i[1]),b[this]=[t?t[0]:0,e?e[0]:0],c[this]=[p.exec(i[0])[0],p.exec(i[1])[0]]}),1===y.length&&(y[1]=y[0]),"right"===c.at[0]?m.left+=u:"center"===c.at[0]&&(m.left+=u/2),"bottom"===c.at[1]?m.top+=d:"center"===c.at[1]&&(m.top+=d/2),f=H(b.at,u,d),m.left+=f[0],m.top+=f[1],this.each(function(){var i,t,r=P(this),l=r.outerWidth(),a=r.outerHeight(),e=k(this,"marginLeft"),s=k(this,"marginTop"),o=l+e+k(this,"marginRight")+w.width,n=a+s+k(this,"marginBottom")+w.height,h=P.extend({},m),p=H(b.my,r.outerWidth(),r.outerHeight());"right"===c.my[0]?h.left-=l:"center"===c.my[0]&&(h.left-=l/2),"bottom"===c.my[1]?h.top-=a:"center"===c.my[1]&&(h.top-=a/2),h.left+=p[0],h.top+=p[1],i={marginLeft:e,marginTop:s},P.each(["left","top"],function(t,e){P.ui.position[y[t]]&&P.ui.position[y[t]][e](h,{targetWidth:u,targetHeight:d,elemWidth:l,elemHeight:a,collisionPosition:i,collisionWidth:o,collisionHeight:n,offset:[f[0]+p[0],f[1]+p[1]],my:c.my,at:c.at,within:_,elem:r})}),c.using&&(t=function(t){var e=g.left-h.left,i=e+u-l,s=g.top-h.top,o=s+d-a,n={target:{element:v,left:g.left,top:g.top,width:u,height:d},element:{element:r,left:h.left,top:h.top,width:l,height:a},horizontal:i<0?"left":0<e?"right":"center",vertical:o<0?"top":0<s?"bottom":"middle"};u<l&&T(e+i)<u&&(n.horizontal="center"),d<a&&T(s+o)<d&&(n.vertical="middle"),x(T(e),T(i))>x(T(s),T(o))?n.important="horizontal":n.important="vertical",c.using.call(this,t,n)}),r.offset(P.extend(h,{using:t}))})},P.ui.position={fit:{left:function(t,e){var i=e.within,s=i.isWindow?i.scrollLeft:i.offset.left,o=i.width,n=t.left-e.collisionPosition.marginLeft,r=s-n,l=n+e.collisionWidth-o-s;e.collisionWidth>o?0<r&&l<=0?(i=t.left+r+e.collisionWidth-o-s,t.left+=r-i):t.left=!(0<l&&r<=0)&&l<r?s+o-e.collisionWidth:s:0<r?t.left+=r:0<l?t.left-=l:t.left=x(t.left-n,t.left)},top:function(t,e){var i=e.within,s=i.isWindow?i.scrollTop:i.offset.top,o=e.within.height,n=t.top-e.collisionPosition.marginTop,r=s-n,l=n+e.collisionHeight-o-s;e.collisionHeight>o?0<r&&l<=0?(i=t.top+r+e.collisionHeight-o-s,t.top+=r-i):t.top=!(0<l&&r<=0)&&l<r?s+o-e.collisionHeight:s:0<r?t.top+=r:0<l?t.top-=l:t.top=x(t.top-n,t.top)}},flip:{left:function(t,e){var i=e.within,s=i.offset.left+i.scrollLeft,o=i.width,n=i.isWindow?i.scrollLeft:i.offset.left,r=t.left-e.collisionPosition.marginLeft,l=r-n,a=r+e.collisionWidth-o-n,h="left"===e.my[0]?-e.elemWidth:"right"===e.my[0]?e.elemWidth:0,i="left"===e.at[0]?e.targetWidth:"right"===e.at[0]?-e.targetWidth:0,r=-2*e.offset[0];l<0?((s=t.left+h+i+r+e.collisionWidth-o-s)<0||s<T(l))&&(t.left+=h+i+r):0<a&&(0<(n=t.left-e.collisionPosition.marginLeft+h+i+r-n)||T(n)<a)&&(t.left+=h+i+r)},top:function(t,e){var i=e.within,s=i.offset.top+i.scrollTop,o=i.height,n=i.isWindow?i.scrollTop:i.offset.top,r=t.top-e.collisionPosition.marginTop,l=r-n,a=r+e.collisionHeight-o-n,h="top"===e.my[1]?-e.elemHeight:"bottom"===e.my[1]?e.elemHeight:0,i="top"===e.at[1]?e.targetHeight:"bottom"===e.at[1]?-e.targetHeight:0,r=-2*e.offset[1];l<0?((s=t.top+h+i+r+e.collisionHeight-o-s)<0||s<T(l))&&(t.top+=h+i+r):0<a&&(0<(n=t.top-e.collisionPosition.marginTop+h+i+r-n)||T(n)<a)&&(t.top+=h+i+r)}},flipfit:{left:function(){P.ui.position.flip.left.apply(this,arguments),P.ui.position.fit.left.apply(this,arguments)},top:function(){P.ui.position.flip.top.apply(this,arguments),P.ui.position.fit.top.apply(this,arguments)}}};P.ui.position,P.extend(P.expr.pseudos,{data:P.expr.createPseudo?P.expr.createPseudo(function(e){return function(t){return!!P.data(t,e)}}):function(t,e,i){return!!P.data(t,i[3])}}),P.fn.scrollParent=function(t){var e=this.css("position"),i="absolute"===e,s=t?/(auto|scroll|hidden)/:/(auto|scroll)/,t=this.parents().filter(function(){var t=P(this);return(!i||"static"!==t.css("position"))&&s.test(t.css("overflow")+t.css("overflow-y")+t.css("overflow-x"))}).eq(0);return"fixed"!==e&&t.length?t:P(this[0].ownerDocument||document)},P.ui.ie=!!/msie [\w.]+/.exec(navigator.userAgent.toLowerCase());var f=!1;P(document).on("mouseup",function(){f=!1});P.widget("ui.mouse",{version:"1.13.2",options:{cancel:"input, textarea, button, select, option",distance:1,delay:0},_mouseInit:function(){var e=this;this.element.on("mousedown."+this.widgetName,function(t){return e._mouseDown(t)}).on("click."+this.widgetName,function(t){if(!0===P.data(t.target,e.widgetName+".preventClickEvent"))return P.removeData(t.target,e.widgetName+".preventClickEvent"),t.stopImmediatePropagation(),!1}),this.started=!1},_mouseDestroy:function(){this.element.off("."+this.widgetName),this._mouseMoveDelegate&&this.document.off("mousemove."+this.widgetName,this._mouseMoveDelegate).off("mouseup."+this.widgetName,this._mouseUpDelegate)},_mouseDown:function(t){if(!f){this._mouseMoved=!1,this._mouseStarted&&this._mouseUp(t),this._mouseDownEvent=t;var e=this,i=1===t.which,s=!("string"!=typeof this.options.cancel||!t.target.nodeName)&&P(t.target).closest(this.options.cancel).length;return i&&!s&&this._mouseCapture(t)?(this.mouseDelayMet=!this.options.delay,this.mouseDelayMet||(this._mouseDelayTimer=setTimeout(function(){e.mouseDelayMet=!0},this.options.delay)),this._mouseDistanceMet(t)&&this._mouseDelayMet(t)&&(this._mouseStarted=!1!==this._mouseStart(t),!this._mouseStarted)?(t.preventDefault(),!0):(!0===P.data(t.target,this.widgetName+".preventClickEvent")&&P.removeData(t.target,this.widgetName+".preventClickEvent"),this._mouseMoveDelegate=function(t){return e._mouseMove(t)},this._mouseUpDelegate=function(t){return e._mouseUp(t)},this.document.on("mousemove."+this.widgetName,this._mouseMoveDelegate).on("mouseup."+this.widgetName,this._mouseUpDelegate),t.preventDefault(),f=!0)):!0}},_mouseMove:function(t){if(this._mouseMoved){if(P.ui.ie&&(!document.documentMode||document.documentMode<9)&&!t.button)return this._mouseUp(t);if(!t.which)if(t.originalEvent.altKey||t.originalEvent.ctrlKey||t.originalEvent.metaKey||t.originalEvent.shiftKey)this.ignoreMissingWhich=!0;else if(!this.ignoreMissingWhich)return this._mouseUp(t)}return(t.which||t.button)&&(this._mouseMoved=!0),this._mouseStarted?(this._mouseDrag(t),t.preventDefault()):(this._mouseDistanceMet(t)&&this._mouseDelayMet(t)&&(this._mouseStarted=!1!==this._mouseStart(this._mouseDownEvent,t),this._mouseStarted?this._mouseDrag(t):this._mouseUp(t)),!this._mouseStarted)},_mouseUp:function(t){this.document.off("mousemove."+this.widgetName,this._mouseMoveDelegate).off("mouseup."+this.widgetName,this._mouseUpDelegate),this._mouseStarted&&(this._mouseStarted=!1,t.target===this._mouseDownEvent.target&&P.data(t.target,this.widgetName+".preventClickEvent",!0),this._mouseStop(t)),this._mouseDelayTimer&&(clearTimeout(this._mouseDelayTimer),delete this._mouseDelayTimer),this.ignoreMissingWhich=!1,f=!1,t.preventDefault()},_mouseDistanceMet:function(t){return Math.max(Math.abs(this._mouseDownEvent.pageX-t.pageX),Math.abs(this._mouseDownEvent.pageY-t.pageY))>=this.options.distance},_mouseDelayMet:function(){return this.mouseDelayMet},_mouseStart:function(){},_mouseDrag:function(){},_mouseStop:function(){},_mouseCapture:function(){return!0}}),P.ui.plugin={add:function(t,e,i){var s,o=P.ui[t].prototype;for(s in i)o.plugins[s]=o.plugins[s]||[],o.plugins[s].push([e,i[s]])},call:function(t,e,i,s){var o,n=t.plugins[e];if(n&&(s||t.element[0].parentNode&&11!==t.element[0].parentNode.nodeType))for(o=0;o<n.length;o++)t.options[n[o][0]]&&n[o][1].apply(t.element,i)}},P.ui.safeActiveElement=function(e){var i;try{i=e.activeElement}catch(t){i=e.body}return i=!(i=i||e.body).nodeName?e.body:i},P.ui.safeBlur=function(t){t&&"body"!==t.nodeName.toLowerCase()&&P(t).trigger("blur")};P.widget("ui.draggable",P.ui.mouse,{version:"1.13.2",widgetEventPrefix:"drag",options:{addClasses:!0,appendTo:"parent",axis:!1,connectToSortable:!1,containment:!1,cursor:"auto",cursorAt:!1,grid:!1,handle:!1,helper:"original",iframeFix:!1,opacity:!1,refreshPositions:!1,revert:!1,revertDuration:500,scope:"default",scroll:!0,scrollSensitivity:20,scrollSpeed:20,snap:!1,snapMode:"both",snapTolerance:20,stack:!1,zIndex:!1,drag:null,start:null,stop:null},_create:function(){"original"===this.options.helper&&this._setPositionRelative(),this.options.addClasses&&this._addClass("ui-draggable"),this._setHandleClassName(),this._mouseInit()},_setOption:function(t,e){this._super(t,e),"handle"===t&&(this._removeHandleClassName(),this._setHandleClassName())},_destroy:function(){(this.helper||this.element).is(".ui-draggable-dragging")?this.destroyOnClear=!0:(this._removeHandleClassName(),this._mouseDestroy())},_mouseCapture:function(t){var e=this.options;return!(this.helper||e.disabled||0<P(t.target).closest(".ui-resizable-handle").length)&&(this.handle=this._getHandle(t),!!this.handle&&(this._blurActiveElement(t),this._blockFrames(!0===e.iframeFix?"iframe":e.iframeFix),!0))},_blockFrames:function(t){this.iframeBlocks=this.document.find(t).map(function(){var t=P(this);return P("<div>").css("position","absolute").appendTo(t.parent()).outerWidth(t.outerWidth()).outerHeight(t.outerHeight()).offset(t.offset())[0]})},_unblockFrames:function(){this.iframeBlocks&&(this.iframeBlocks.remove(),delete this.iframeBlocks)},_blurActiveElement:function(t){var e=P.ui.safeActiveElement(this.document[0]);P(t.target).closest(e).length||P.ui.safeBlur(e)},_mouseStart:function(t){var e=this.options;return this.helper=this._createHelper(t),this._addClass(this.helper,"ui-draggable-dragging"),this._cacheHelperProportions(),P.ui.ddmanager&&(P.ui.ddmanager.current=this),this._cacheMargins(),this.cssPosition=this.helper.css("position"),this.scrollParent=this.helper.scrollParent(!0),this.offsetParent=this.helper.offsetParent(),this.hasFixedAncestor=0<this.helper.parents().filter(function(){return"fixed"===P(this).css("position")}).length,this.positionAbs=this.element.offset(),this._refreshOffsets(t),this.originalPosition=this.position=this._generatePosition(t,!1),this.originalPageX=t.pageX,this.originalPageY=t.pageY,e.cursorAt&&this._adjustOffsetFromHelper(e.cursorAt),this._setContainment(),!1===this._trigger("start",t)?(this._clear(),!1):(this._cacheHelperProportions(),P.ui.ddmanager&&!e.dropBehaviour&&P.ui.ddmanager.prepareOffsets(this,t),this._mouseDrag(t,!0),P.ui.ddmanager&&P.ui.ddmanager.dragStart(this,t),!0)},_refreshOffsets:function(t){this.offset={top:this.positionAbs.top-this.margins.top,left:this.positionAbs.left-this.margins.left,scroll:!1,parent:this._getParentOffset(),relative:this._getRelativeOffset()},this.offset.click={left:t.pageX-this.offset.left,top:t.pageY-this.offset.top}},_mouseDrag:function(t,e){if(this.hasFixedAncestor&&(this.offset.parent=this._getParentOffset()),this.position=this._generatePosition(t,!0),this.positionAbs=this._convertPositionTo("absolute"),!e){e=this._uiHash();if(!1===this._trigger("drag",t,e))return this._mouseUp(new P.Event("mouseup",t)),!1;this.position=e.position}return this.helper[0].style.left=this.position.left+"px",this.helper[0].style.top=this.position.top+"px",P.ui.ddmanager&&P.ui.ddmanager.drag(this,t),!1},_mouseStop:function(t){var e=this,i=!1;return P.ui.ddmanager&&!this.options.dropBehaviour&&(i=P.ui.ddmanager.drop(this,t)),this.dropped&&(i=this.dropped,this.dropped=!1),"invalid"===this.options.revert&&!i||"valid"===this.options.revert&&i||!0===this.options.revert||"function"==typeof this.options.revert&&this.options.revert.call(this.element,i)?P(this.helper).animate(this.originalPosition,parseInt(this.options.revertDuration,10),function(){!1!==e._trigger("stop",t)&&e._clear()}):!1!==this._trigger("stop",t)&&this._clear(),!1},_mouseUp:function(t){return this._unblockFrames(),P.ui.ddmanager&&P.ui.ddmanager.dragStop(this,t),this.handleElement.is(t.target)&&this.element.trigger("focus"),P.ui.mouse.prototype._mouseUp.call(this,t)},cancel:function(){return this.helper.is(".ui-draggable-dragging")?this._mouseUp(new P.Event("mouseup",{target:this.element[0]})):this._clear(),this},_getHandle:function(t){return!this.options.handle||!!P(t.target).closest(this.element.find(this.options.handle)).length},_setHandleClassName:function(){this.handleElement=this.options.handle?this.element.find(this.options.handle):this.element,this._addClass(this.handleElement,"ui-draggable-handle")},_removeHandleClassName:function(){this._removeClass(this.handleElement,"ui-draggable-handle")},_createHelper:function(t){var e=this.options,i="function"==typeof e.helper,t=i?P(e.helper.apply(this.element[0],[t])):"clone"===e.helper?this.element.clone().removeAttr("id"):this.element;return t.parents("body").length||t.appendTo("parent"===e.appendTo?this.element[0].parentNode:e.appendTo),i&&t[0]===this.element[0]&&this._setPositionRelative(),t[0]===this.element[0]||/(fixed|absolute)/.test(t.css("position"))||t.css("position","absolute"),t},_setPositionRelative:function(){/^(?:r|a|f)/.test(this.element.css("position"))||(this.element[0].style.position="relative")},_adjustOffsetFromHelper:function(t){"string"==typeof t&&(t=t.split(" ")),"left"in(t=Array.isArray(t)?{left:+t[0],top:+t[1]||0}:t)&&(this.offset.click.left=t.left+this.margins.left),"right"in t&&(this.offset.click.left=this.helperProportions.width-t.right+this.margins.left),"top"in t&&(this.offset.click.top=t.top+this.margins.top),"bottom"in t&&(this.offset.click.top=this.helperProportions.height-t.bottom+this.margins.top)},_isRootNode:function(t){return/(html|body)/i.test(t.tagName)||t===this.document[0]},_getParentOffset:function(){var t=this.offsetParent.offset(),e=this.document[0];return"absolute"===this.cssPosition&&this.scrollParent[0]!==e&&P.contains(this.scrollParent[0],this.offsetParent[0])&&(t.left+=this.scrollParent.scrollLeft(),t.top+=this.scrollParent.scrollTop()),{top:(t=this._isRootNode(this.offsetParent[0])?{top:0,left:0}:t).top+(parseInt(this.offsetParent.css("borderTopWidth"),10)||0),left:t.left+(parseInt(this.offsetParent.css("borderLeftWidth"),10)||0)}},_getRelativeOffset:function(){if("relative"!==this.cssPosition)return{top:0,left:0};var t=this.element.position(),e=this._isRootNode(this.scrollParent[0]);return{top:t.top-(parseInt(this.helper.css("top"),10)||0)+(e?0:this.scrollParent.scrollTop()),left:t.left-(parseInt(this.helper.css("left"),10)||0)+(e?0:this.scrollParent.scrollLeft())}},_cacheMargins:function(){this.margins={left:parseInt(this.element.css("marginLeft"),10)||0,top:parseInt(this.element.css("marginTop"),10)||0,right:parseInt(this.element.css("marginRight"),10)||0,bottom:parseInt(this.element.css("marginBottom"),10)||0}},_cacheHelperProportions:function(){this.helperProportions={width:this.helper.outerWidth(),height:this.helper.outerHeight()}},_setContainment:function(){var t,e,i,s=this.options,o=this.document[0];this.relativeContainer=null,s.containment?"window"!==s.containment?"document"!==s.containment?s.containment.constructor!==Array?("parent"===s.containment&&(s.containment=this.helper[0].parentNode),(i=(e=P(s.containment))[0])&&(t=/(scroll|auto)/.test(e.css("overflow")),this.containment=[(parseInt(e.css("borderLeftWidth"),10)||0)+(parseInt(e.css("paddingLeft"),10)||0),(parseInt(e.css("borderTopWidth"),10)||0)+(parseInt(e.css("paddingTop"),10)||0),(t?Math.max(i.scrollWidth,i.offsetWidth):i.offsetWidth)-(parseInt(e.css("borderRightWidth"),10)||0)-(parseInt(e.css("paddingRight"),10)||0)-this.helperProportions.width-this.margins.left-this.margins.right,(t?Math.max(i.scrollHeight,i.offsetHeight):i.offsetHeight)-(parseInt(e.css("borderBottomWidth"),10)||0)-(parseInt(e.css("paddingBottom"),10)||0)-this.helperProportions.height-this.margins.top-this.margins.bottom],this.relativeContainer=e)):this.containment=s.containment:this.containment=[0,0,P(o).width()-this.helperProportions.width-this.margins.left,(P(o).height()||o.body.parentNode.scrollHeight)-this.helperProportions.height-this.margins.top]:this.containment=[P(window).scrollLeft()-this.offset.relative.left-this.offset.parent.left,P(window).scrollTop()-this.offset.relative.top-this.offset.parent.top,P(window).scrollLeft()+P(window).width()-this.helperProportions.width-this.margins.left,P(window).scrollTop()+(P(window).height()||o.body.parentNode.scrollHeight)-this.helperProportions.height-this.margins.top]:this.containment=null},_convertPositionTo:function(t,e){e=e||this.position;var i="absolute"===t?1:-1,t=this._isRootNode(this.scrollParent[0]);return{top:e.top+this.offset.relative.top*i+this.offset.parent.top*i-("fixed"===this.cssPosition?-this.offset.scroll.top:t?0:this.offset.scroll.top)*i,left:e.left+this.offset.relative.left*i+this.offset.parent.left*i-("fixed"===this.cssPosition?-this.offset.scroll.left:t?0:this.offset.scroll.left)*i}},_generatePosition:function(t,e){var i,s=this.options,o=this._isRootNode(this.scrollParent[0]),n=t.pageX,r=t.pageY;return o&&this.offset.scroll||(this.offset.scroll={top:this.scrollParent.scrollTop(),left:this.scrollParent.scrollLeft()}),e&&(this.containment&&(i=this.relativeContainer?(i=this.relativeContainer.offset(),[this.containment[0]+i.left,this.containment[1]+i.top,this.containment[2]+i.left,this.containment[3]+i.top]):this.containment,t.pageX-this.offset.click.left<i[0]&&(n=i[0]+this.offset.click.left),t.pageY-this.offset.click.top<i[1]&&(r=i[1]+this.offset.click.top),t.pageX-this.offset.click.left>i[2]&&(n=i[2]+this.offset.click.left),t.pageY-this.offset.click.top>i[3]&&(r=i[3]+this.offset.click.top)),s.grid&&(t=s.grid[1]?this.originalPageY+Math.round((r-this.originalPageY)/s.grid[1])*s.grid[1]:this.originalPageY,r=!i||t-this.offset.click.top>=i[1]||t-this.offset.click.top>i[3]?t:t-this.offset.click.top>=i[1]?t-s.grid[1]:t+s.grid[1],t=s.grid[0]?this.originalPageX+Math.round((n-this.originalPageX)/s.grid[0])*s.grid[0]:this.originalPageX,n=!i||t-this.offset.click.left>=i[0]||t-this.offset.click.left>i[2]?t:t-this.offset.click.left>=i[0]?t-s.grid[0]:t+s.grid[0]),"y"===s.axis&&(n=this.originalPageX),"x"===s.axis&&(r=this.originalPageY)),{top:r-this.offset.click.top-this.offset.relative.top-this.offset.parent.top+("fixed"===this.cssPosition?-this.offset.scroll.top:o?0:this.offset.scroll.top),left:n-this.offset.click.left-this.offset.relative.left-this.offset.parent.left+("fixed"===this.cssPosition?-this.offset.scroll.left:o?0:this.offset.scroll.left)}},_clear:function(){this._removeClass(this.helper,"ui-draggable-dragging"),this.helper[0]===this.element[0]||this.cancelHelperRemoval||this.helper.remove(),this.helper=null,this.cancelHelperRemoval=!1,this.destroyOnClear&&this.destroy()},_trigger:function(t,e,i){return i=i||this._uiHash(),P.ui.plugin.call(this,t,[e,i,this],!0),/^(drag|start|stop)/.test(t)&&(this.positionAbs=this._convertPositionTo("absolute"),i.offset=this.positionAbs),P.Widget.prototype._trigger.call(this,t,e,i)},plugins:{},_uiHash:function(){return{helper:this.helper,position:this.position,originalPosition:this.originalPosition,offset:this.positionAbs}}}),P.ui.plugin.add("draggable","connectToSortable",{start:function(e,t,i){var s=P.extend({},t,{item:i.element});i.sortables=[],P(i.options.connectToSortable).each(function(){var t=P(this).sortable("instance");t&&!t.options.disabled&&(i.sortables.push(t),t.refreshPositions(),t._trigger("activate",e,s))})},stop:function(e,t,i){var s=P.extend({},t,{item:i.element});i.cancelHelperRemoval=!1,P.each(i.sortables,function(){var t=this;t.isOver?(t.isOver=0,i.cancelHelperRemoval=!0,t.cancelHelperRemoval=!1,t._storedCSS={position:t.placeholder.css("position"),top:t.placeholder.css("top"),left:t.placeholder.css("left")},t._mouseStop(e),t.options.helper=t.options._helper):(t.cancelHelperRemoval=!0,t._trigger("deactivate",e,s))})},drag:function(i,s,o){P.each(o.sortables,function(){var t=!1,e=this;e.positionAbs=o.positionAbs,e.helperProportions=o.helperProportions,e.offset.click=o.offset.click,e._intersectsWith(e.containerCache)&&(t=!0,P.each(o.sortables,function(){return this.positionAbs=o.positionAbs,this.helperProportions=o.helperProportions,this.offset.click=o.offset.click,t=this!==e&&this._intersectsWith(this.containerCache)&&P.contains(e.element[0],this.element[0])?!1:t})),t?(e.isOver||(e.isOver=1,o._parent=s.helper.parent(),e.currentItem=s.helper.appendTo(e.element).data("ui-sortable-item",!0),e.options._helper=e.options.helper,e.options.helper=function(){return s.helper[0]},i.target=e.currentItem[0],e._mouseCapture(i,!0),e._mouseStart(i,!0,!0),e.offset.click.top=o.offset.click.top,e.offset.click.left=o.offset.click.left,e.offset.parent.left-=o.offset.parent.left-e.offset.parent.left,e.offset.parent.top-=o.offset.parent.top-e.offset.parent.top,o._trigger("toSortable",i),o.dropped=e.element,P.each(o.sortables,function(){this.refreshPositions()}),o.currentItem=o.element,e.fromOutside=o),e.currentItem&&(e._mouseDrag(i),s.position=e.position)):e.isOver&&(e.isOver=0,e.cancelHelperRemoval=!0,e.options._revert=e.options.revert,e.options.revert=!1,e._trigger("out",i,e._uiHash(e)),e._mouseStop(i,!0),e.options.revert=e.options._revert,e.options.helper=e.options._helper,e.placeholder&&e.placeholder.remove(),s.helper.appendTo(o._parent),o._refreshOffsets(i),s.position=o._generatePosition(i,!0),o._trigger("fromSortable",i),o.dropped=!1,P.each(o.sortables,function(){this.refreshPositions()}))})}}),P.ui.plugin.add("draggable","cursor",{start:function(t,e,i){var s=P("body"),i=i.options;s.css("cursor")&&(i._cursor=s.css("cursor")),s.css("cursor",i.cursor)},stop:function(t,e,i){i=i.options;i._cursor&&P("body").css("cursor",i._cursor)}}),P.ui.plugin.add("draggable","opacity",{start:function(t,e,i){e=P(e.helper),i=i.options;e.css("opacity")&&(i._opacity=e.css("opacity")),e.css("opacity",i.opacity)},stop:function(t,e,i){i=i.options;i._opacity&&P(e.helper).css("opacity",i._opacity)}}),P.ui.plugin.add("draggable","scroll",{start:function(t,e,i){i.scrollParentNotHidden||(i.scrollParentNotHidden=i.helper.scrollParent(!1)),i.scrollParentNotHidden[0]!==i.document[0]&&"HTML"!==i.scrollParentNotHidden[0].tagName&&(i.overflowOffset=i.scrollParentNotHidden.offset())},drag:function(t,e,i){var s=i.options,o=!1,n=i.scrollParentNotHidden[0],r=i.document[0];n!==r&&"HTML"!==n.tagName?(s.axis&&"x"===s.axis||(i.overflowOffset.top+n.offsetHeight-t.pageY<s.scrollSensitivity?n.scrollTop=o=n.scrollTop+s.scrollSpeed:t.pageY-i.overflowOffset.top<s.scrollSensitivity&&(n.scrollTop=o=n.scrollTop-s.scrollSpeed)),s.axis&&"y"===s.axis||(i.overflowOffset.left+n.offsetWidth-t.pageX<s.scrollSensitivity?n.scrollLeft=o=n.scrollLeft+s.scrollSpeed:t.pageX-i.overflowOffset.left<s.scrollSensitivity&&(n.scrollLeft=o=n.scrollLeft-s.scrollSpeed))):(s.axis&&"x"===s.axis||(t.pageY-P(r).scrollTop()<s.scrollSensitivity?o=P(r).scrollTop(P(r).scrollTop()-s.scrollSpeed):P(window).height()-(t.pageY-P(r).scrollTop())<s.scrollSensitivity&&(o=P(r).scrollTop(P(r).scrollTop()+s.scrollSpeed))),s.axis&&"y"===s.axis||(t.pageX-P(r).scrollLeft()<s.scrollSensitivity?o=P(r).scrollLeft(P(r).scrollLeft()-s.scrollSpeed):P(window).width()-(t.pageX-P(r).scrollLeft())<s.scrollSensitivity&&(o=P(r).scrollLeft(P(r).scrollLeft()+s.scrollSpeed)))),!1!==o&&P.ui.ddmanager&&!s.dropBehaviour&&P.ui.ddmanager.prepareOffsets(i,t)}}),P.ui.plugin.add("draggable","snap",{start:function(t,e,i){var s=i.options;i.snapElements=[],P(s.snap.constructor!==String?s.snap.items||":data(ui-draggable)":s.snap).each(function(){var t=P(this),e=t.offset();this!==i.element[0]&&i.snapElements.push({item:this,width:t.outerWidth(),height:t.outerHeight(),top:e.top,left:e.left})})},drag:function(t,e,i){for(var s,o,n,r,l,a,h,p,c,f=i.options,u=f.snapTolerance,d=e.offset.left,g=d+i.helperProportions.width,m=e.offset.top,v=m+i.helperProportions.height,_=i.snapElements.length-1;0<=_;_--)a=(l=i.snapElements[_].left-i.margins.left)+i.snapElements[_].width,p=(h=i.snapElements[_].top-i.margins.top)+i.snapElements[_].height,g<l-u||a+u<d||v<h-u||p+u<m||!P.contains(i.snapElements[_].item.ownerDocument,i.snapElements[_].item)?(i.snapElements[_].snapping&&i.options.snap.release&&i.options.snap.release.call(i.element,t,P.extend(i._uiHash(),{snapItem:i.snapElements[_].item})),i.snapElements[_].snapping=!1):("inner"!==f.snapMode&&(s=Math.abs(h-v)<=u,o=Math.abs(p-m)<=u,n=Math.abs(l-g)<=u,r=Math.abs(a-d)<=u,s&&(e.position.top=i._convertPositionTo("relative",{top:h-i.helperProportions.height,left:0}).top),o&&(e.position.top=i._convertPositionTo("relative",{top:p,left:0}).top),n&&(e.position.left=i._convertPositionTo("relative",{top:0,left:l-i.helperProportions.width}).left),r&&(e.position.left=i._convertPositionTo("relative",{top:0,left:a}).left)),c=s||o||n||r,"outer"!==f.snapMode&&(s=Math.abs(h-m)<=u,o=Math.abs(p-v)<=u,n=Math.abs(l-d)<=u,r=Math.abs(a-g)<=u,s&&(e.position.top=i._convertPositionTo("relative",{top:h,left:0}).top),o&&(e.position.top=i._convertPositionTo("relative",{top:p-i.helperProportions.height,left:0}).top),n&&(e.position.left=i._convertPositionTo("relative",{top:0,left:l}).left),r&&(e.position.left=i._convertPositionTo("relative",{top:0,left:a-i.helperProportions.width}).left)),!i.snapElements[_].snapping&&(s||o||n||r||c)&&i.options.snap.snap&&i.options.snap.snap.call(i.element,t,P.extend(i._uiHash(),{snapItem:i.snapElements[_].item})),i.snapElements[_].snapping=s||o||n||r||c)}}),P.ui.plugin.add("draggable","stack",{start:function(t,e,i){var s,i=i.options,i=P.makeArray(P(i.stack)).sort(function(t,e){return(parseInt(P(t).css("zIndex"),10)||0)-(parseInt(P(e).css("zIndex"),10)||0)});i.length&&(s=parseInt(P(i[0]).css("zIndex"),10)||0,P(i).each(function(t){P(this).css("zIndex",s+t)}),this.css("zIndex",s+i.length))}}),P.ui.plugin.add("draggable","zIndex",{start:function(t,e,i){e=P(e.helper),i=i.options;e.css("zIndex")&&(i._zIndex=e.css("zIndex")),e.css("zIndex",i.zIndex)},stop:function(t,e,i){i=i.options;i._zIndex&&P(e.helper).css("zIndex",i._zIndex)}});P.ui.draggable});