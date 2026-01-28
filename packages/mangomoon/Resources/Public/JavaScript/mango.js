/* 
 mango
 */


$(document).ready(function(){
  
  $('.frame-accordion header').click(function(){
    $(this).next().slideToggle( "fast", function() {
      $(this).prev().toggleClass( "offen" );
    });
  });
  
  $('a[href$=".pdf"]').attr('target', '_blank');
  
  
  $('#mangomoon-hilfe').hover(
    function() {
      $( this ).addClass( "hover" );
    }, function() {
      $( this ).removeClass( "hover" );
    }
  );
  
//  Abstract-Menu nach Categories v.0.1

 $('.catListItem').click(function(){
  $('.PageTeaser').hide();
  $('.catListItem').removeClass('active');
  catdata = $(this).attr('catlistdata');
  if (catdata == 'alle') {
    $('.PageTeaser').show();
  } else {
    $('.'+catdata).show();
  }
  $(this).addClass('active');
 });
 
  
// FUSSNOTEN bei Copy&Paste aus Word ############ 

$('a').each(function() {
  var $this = $(this);
  var href = $this.attr('href');
  if (href) {
    var intRegex = /^\d+$/;
    var fntest = href.substring(5,9);
    if ((href.includes('ftn') || href.includes('edn')) && intRegex.test(fntest)) {
      $(this).addClass('fussnotenzeichen');
      var fnhref = "#_ftnref"+fntest;
      var fntext = $('a[href="'+fnhref+'"]').parent().html();
      if (!fntext) {
        fnhref = "#_ednref"+fntest;
        fntext = $('a[href="'+fnhref+'"]').parent().html();
      }

      $('a[href="'+fnhref+'"]').parent().addClass('fussnotentext');
      // console.log(fntext);
      $(this).hover(function(e) {
          var seitenbreite = $(window).width();
          var position = $(this).offset();

          $('#infobox').html(fntext);
          $('#infobox').fadeIn(100);
          if (e.pageX < seitenbreite/2) {
            $('#infobox').css({
              'top': e.pageY + 10,
              'left': e.pageX + 10
            });
            
          } else {
            $('#infobox').css({
              'top': e.pageY + 10,
              'left': e.pageX - 400
            });
          }
      }, function(){
        $('#infobox').fadeOut(500);
      });
    }
  }
  });


});

  
