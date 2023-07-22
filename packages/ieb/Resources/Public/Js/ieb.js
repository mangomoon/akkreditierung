 // Modal Box als <dialog> #####




 // Validierung
 function validieren() {

     allesda = 1;

     $('.req').each(function() {
         if ($(this).val().length == 0) {
             $(this).addClass('req-leer');
             allesda = 0;
             console.log($(this).attr('id'));
         }
     });
     $('.reqcheckbox').each(function() {
         if (!$(this).is(':checked')) {
             $(this).addClass('req-leer');
             allesda = 0;
             console.log($(this).attr('id'));
         }
     });
     $('.reqtext').each(function() {
         if ($(this).text() == '') {
             $(this).addClass('req-leer');
             allesda = 0;
             console.log($(this).attr('id'));
         }
     });

     $('.reqselect').each(function() {
         if ($(this).val() == 0) {
             $(this).addClass('req-leer');
             allesda = 0;
             console.log($(this).attr('id'));
         }
     });

     $('.reqfile').each(function() {
         if ($(this).is('.req-leer')) {
             allesda = 0;
             console.log("FILE: " + $(this).attr('id'));
         }
     });

     $('#ok').attr('value', allesda);

     console.log("allesda = " + allesda);
 };

 // Vailidierung TRAINER
 function validierentr() {
     okbabi = 0;
     okpsa = 0;
     validieren();


     if ($('#verwendungBabi').is(':checked')) {
         trbabi = 1;
     };
     if ($('#verwendungPsa').is(':checked')) {
         trpsa = 1;
     };
     if ($('.upload-qualifikationBabiDatei').is('.ok')) {
         qb = 1;
     };
     if ($('.upload-lehrBefugnisDatei').is('.ok')) {
         lb = 1;
     };
     if ($('.upload-qualifikationPsaDatei').is('.ok')) {
         qp = 1;
     };
     if ($('.upload-lebenslaufDatei').is('.ok')) {
         ll = 1;
     };


     if (((trbabi == 1) && (qb == 1) && (ll == 1)) || ((trbabi == 1) && (qb == 1) && (lb == 1))) {
         okbabi = 1;
         $('#okbabi').attr('value', 1);
     }
     if (((trpsa == 1) && (qp == 1)) || ((trpsa == 1) && (lb == 1))) {
         okpsa = 1;
         $('#okpsa').attr('value', 1);
     }

 }

 function validierenansuchen() {
     allesda = 1;
     $('.fehlt').each(function() {
         $(this).html("Daten fehlen!");
         allesda = 0;
     });
     console.log("Stammdaten: " + allesda);
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


     validieren();
     console.log("allesda ohne bb: " + allesda);

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



     console.log("allesda ohne Multiselect: " + allesda);
     $('span.multi-select-button').each(function() {
         if ($(this).html() == '') {
             $(this).parent().addClass('reqleer');
         }
     });
     console.log("allesda am Schluss: " + allesda);

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
     }
     if (babi == 0) {
         $('#c-2-1-babi').hide();
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
    $('.tr-standort').submit();
 };


// Trainer Begutachtung: öffnen der nicht-ok-Kommentarfelder und Check all ... ##########################

function oeffnenTrainerBegutachtung() {
    var s = 1;
    a = $("#trainerbegutachtung input.c21b:checked").val();
    b = $("#trainerbegutachtung input.c21psa:checked").val();
    c = $("#trainerbegutachtung input.c22r:checked").val();
    c = $(this).find('input.c22r:checked').val();
    if (a + b + c < 4) {
             s = 1;
         }
         if ((a == 2) || (b == 2) || (c == 2)) {
             s = 2;
         }
         if ((a == 3) || (b == 3) || (c == 3)) {
             s = 3;
         }
         if ((a == 4) || (b == 4) || (c == 4)) {
             s = 4;
         }
         if (s < 3) {
             $('.komm-ext').hide();
         } else {
             $('.komm-ext').show();
         }

    var t = 0;
    $('.trainerqualifikationsbegutachtung input').each (function() {
        if($(this).prop('checked')){
            t++;
            console.log(t);
        }
    });
    if(t == 8){
        $('#checkall').addClass('checked');
    }
};




 // +++++++++++++++++++++++++++++++++++++ ready ++++++++++++++++++++++++++++++ //// +++++++++++++++++++++++++++++++++++++ ready ++++++++++++++++++++++++++++++ //
 // +++++++++++++++++++++++++++++++++++++ ready ++++++++++++++++++++++++++++++ //// +++++++++++++++++++++++++++++++++++++ ready ++++++++++++++++++++++++++++++ //
 // +++++++++++++++++++++++++++++++++++++ ready ++++++++++++++++++++++++++++++ //// +++++++++++++++++++++++++++++++++++++ ready ++++++++++++++++++++++++++++++ //
 // +++++++++++++++++++++++++++++++++++++ ready ++++++++++++++++++++++++++++++ //// +++++++++++++++++++++++++++++++++++++ ready ++++++++++++++++++++++++++++++ //



 $(document).ready(function() {

    // Tooltip

    $('.knopf-quadratisch').hover(function(e) {
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
            console.log(title);
            $(this).attr('title', title);
        });

     // MODAL BOX 
     const modal = document.querySelector("#modal");
     const closeModal = document.querySelector(".close");
     console.log(closeModal);
     closeModal.addEventListener("click", () => {
         modal.close();
     });


     $(".uploadfileinput").on("change", function(e) {
         $(this).parent().parent().parent().removeClass('reqfile');
     });

     lb = 0;
     qb = 0;
     qp = 0;
     ll = 0;
     $("#qualifikationBabiDatei").on("change", function(e) {
         if ($(this).val() !== " ") {
             qb = 1;
         } else {
             return false;
         };
     });
     $("#lehrBefugnisDatei").on("change", function(e) {
         if ($(this).val() !== " ") {
             lb = 1;
         } else {
             return false;
         };
     });
     $("#qualifikationPsaDatei").on("change", function(e) {
         if ($(this).val() !== " ") {
             qp = 1;
         } else {
             return false;
         };
     });
     $("#lebenslaufDatei").on("change", function(e) {
         if ($(this).val() !== " ") {
             ll = 1;
         } else {
             return false;
         };
     });

     // CHECKER
     $('.sitename').click(function() {
         validierenansuchen();
         //console.log($('#name').val());
         // console.log("VAR: qb: [" + qb + "] lb: [" + lb + "] qp: [" + qp + "] ll: [" + ll + "]" + okbabi + "---" + okpsa);
         // console.log("BaBi: [" + okbabi + "] OOO PSA: [" + okpsa + "]");
     });

     $("form.tr").submit(function() {
         validieren();
     });

     $("form.trtrainer").submit(function() {
         validierentr();
     });

    //  Submit Standorte mit Frage 



     $("#submitstart").click(function() {

        validieren();
         if (allesda == 1) {
            $('.modalcontent').html('<p>Sie können diese Daten später nicht mehr bearbeiten: bitte achten Sie auf korrekte Angaben!<p><a class="knopfersatz knopf-s" href="javascript:submitten()">Alles korrekt: Daten speichern!</a>');
            $(".close").html('Zurück zum Formular');
            $(".close").css('width','220px');
            modal.showModal();
         }
     });

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

     // ######################################## FORM Begutachtung

     $('.ansuchen .knopf input').click(function() {

        if($(this).parent().hasClass('checked')) {
            $(this).parent().removeClass('checked');
            $(this).parent().parent().find('.nan').prop('checked', true);
        } else {
            $(this).parent().parent().find('.knopf').removeClass('checked');
            $(this).parent().addClass('checked');
        }

        if ($(this).parent().hasClass('nicht-ok')) {
            $(this).parent().parent().next().toggle();
        } else {
            $(this).parent().parent().next().hide();
        }

     });

     $('.textbausteinoeffner').click(function() {
         $(this).toggleClass('checked');
         $(this).next().toggle();
         
     });
     $('.textbaustein').click(function() {
         var t = $(this).text();
         var u = $(this).parent().parent().find('.extern').val();
         $(this).parent().parent().find('.extern').val(u + t);
     });

     $('.infoknopf').click(function() {
         $(this).toggleClass('checked');
         $(this).parent().parent().parent().parent().find('.erlaeuterung').toggle();
     });
     // ########################################


     //  ########################################### FORM Begutachtung Trainer
     $('.teilstatus label.knopf').click(function() {
         
         $(this).find("input").prop('checked', true);
         
         oeffnenTrainerBegutachtung();

         $('#summestatus label').removeClass('checked');
         //$(sr).addClass('checked');
         $(this).parent().parent().find('.knopf').removeClass('checked');
         $(this).addClass('checked');

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

     // ######################################## Datei löschen

     $('.filedelete').click(function() {
         $(this).parent().toggleClass("geloescht");
         var s = $('.nextdel input');
         $(this).parent().find(s).prop("checked", !s.prop("checked"));
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