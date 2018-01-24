//Script d'adaptation de la carte et liste sur mobile

if($(window).width()<=767) {
  $('.Liste').addClass('hidden');
  $('.glyphicon-map-marker').css("color", "white");
  $('.glyphicon-tasks').css("color", "#00c4b6");
}

$('.btnListe').click(function() {
  if ($('.Liste').hasClass("hidden")) {
    $('.Liste').removeClass('hidden');
    $('#Carte').addClass('hidden');
    $('.glyphicon-map-marker').css("color", "#00c4b6");
    $('.glyphicon-tasks').css("color", "white");
  }
});

$('.btnCarte').click(function() {
  if ($('#Carte').hasClass("hidden")) {
    $('.Liste').addClass('hidden');
    $('#Carte').removeClass('hidden');
    $('.glyphicon-map-marker').css("color", "white");
    $('.glyphicon-tasks').css("color", "#00c4b6");
    initMap();
  }
});
