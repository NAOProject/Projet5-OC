//Script d'adaptation de la carte et liste sur mobile

if($(window).width()<=767) {
  $('#Carte').addClass('hidden');
  $('.btnListe').removeClass('hidden');
  $('.btnCarte').removeClass('hidden');
}

$('.btnListe').click(function() {
  if ($('#Observations').hasClass("hidden")) {
    $('#Observations').removeClass('hidden');
    $('#Carte').addClass('hidden');
  }
});

$('.btnCarte').click(function() {
  if ($('#Carte').hasClass("hidden")) {
    $('#Observations').addClass('hidden');
    $('#Carte').removeClass('hidden');
    initMap();
  }
});
