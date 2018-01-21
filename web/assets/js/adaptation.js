//Script d'adaptation de la carte et liste sur mobile

if($(window).width()<=767) {
  $('.Liste').addClass('hidden');
  $('.glyphicon-map-marker').css("color", "turquoise");
}

$('.btnListe').click(function() {
  if ($('.Liste').hasClass("hidden")) {
    $('.Liste').removeClass('hidden');
    $('#Carte').addClass('hidden');
    $('.glyphicon-map-marker').css("color", "black");
    $('.glyphicon-tasks').css("color", "turquoise");
  }
});

$('.btnCarte').click(function() {
  if ($('#Carte').hasClass("hidden")) {
    $('.Liste').addClass('hidden');
    $('#Carte').removeClass('hidden');
    $('.glyphicon-map-marker').css("color", "turquoise");
    $('.glyphicon-tasks').css("color", "black");
    initMap();
  }
});
