//Script d'adaptation de la carte et liste sur mobile

if($(window).width()<=767) {
  $('.Liste').addClass('hidden');
}

$('.btnListe').click(function() {
  if ($('.Liste').hasClass("hidden")) {
    $('.Liste').removeClass('hidden');
    $('#Carte').addClass('hidden');
  }
});

$('.btnCarte').click(function() {
  if ($('#Carte').hasClass("hidden")) {
    $('.Liste').addClass('hidden');
    $('#Carte').removeClass('hidden');
    initMap();
  }
});
