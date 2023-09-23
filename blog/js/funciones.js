// JavaScript Document

//Carga de página
$(window).load(function() {
	$( "html,body" ).animate({
	opacity: 1
	}, 500);
});

//Menú lateral
$(".desplega-menu").click(function(e) {
    if($(this).hasClass("in")){
		$("header ul").hide();
		$(this).removeClass("in");
	}
	else{
		$("header ul").show();
		$(this).addClass("in");
	}
});

$("header button.suscribirse").click(function(e) {
	$("#modalSuscribirse .pantalla").hide();
	$("#modalSuscribirse .pantalla-1").show();
    $("#modalSuscribirse").modal("show");
});

$(window).load(function(e) {
	$(function() {
		$('.inicio-4 .cols').matchHeight({
		byRow: true,
		property: 'height',
		target: null,
		remove: false
		});
	});
});

var $m = jQuery;
$m("a[href='#top']").click(function() {
  $m("html, body").animate({ scrollTop: 0 }, "slow");
  return false;
});

//scroll
//<![CDATA[
jQuery(document).ready(function(){
	  jQuery('a.scroller[href*=#]').click(function() {
	  var name = jQuery(this).attr('href');
	  var no = new Array ('#mas', '#mas');
	  var  total = no.length;
	  var desplazamiento = 1000;

	  for (i=0;i<=total;i++) {
		   if(no[i] == name){
		   return false;
		   //console.log("final");
	  		}
		}
		setTimeout(function(){
		  $( "#menu" ).removeClass("up-menu");
		}, 1100);

	 if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
	 && location.hostname == this.hostname) {
	   var target = jQuery(this.hash);
	   target = target.length && target

	   || jQuery('[href=' + this.hash.slice(1) +']');
	   if (target.length) {
	  var targetOffset = target.offset().top;
	  jQuery('html,body')
	  .animate({scrollTop: targetOffset-30}, desplazamiento);
	    return false;

	   }}
	  });

});
//]]>
