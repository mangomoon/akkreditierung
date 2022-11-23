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
 
  
  
});



/*
 * Baron Bone Slider
 * js in jquery.fancybox.min.js 
 * https://www.jqueryscript.net/slider/Flexible-Simple-Image-Slider-Plugin-Bare-Bones-Slider.html
 */
