//Script JS pour la page recherche.html.twig + results.html.twig
var markers = [];
var resultArray = (function getGeoDataArray() {
  var $coords = $('#coordonnees').find('div');
  var resultsArray = [];
  for (var i = 0; i < $coords.length; i++) {
      var lat = $($coords[i]).data('latitude');
      var lng = $($coords[i]).data('longitude');
      var src = $($coords[i]).data('src').toString();

      var content = '<div class="row"><div class="miniObs"><div class="photo col-md-5"><img class="miniPic" src="'+ src + '"></div>'
      + '<div class="description col-md-7"><p class="center">' + $($coords[i]).data("espece") + '</p>' + '<p>' + $($coords[i]).data("username") + '.' + '</p></div></div></div>';

      var coord = [lat, lng, content];
      resultsArray.push(coord);
  }
  return resultsArray;
})();

function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 5,
    center: { lat: 46.52863469527167, lng: 2.43896484375 }
  });

  setMarkers(map);
}


function setMarkers(map) {
  for (var i = 0; i < resultArray.length; i++) {
      var result = resultArray[i];
      var infowindow = new google.maps.InfoWindow({
        content: result[2],
        minWidth: 300,
      });
      var marker = new google.maps.Marker({
          position: {lat: result[0], lng: result[1]},
          map: map,
          infowindow: infowindow
      });
      markers.push(marker);

      google.maps.event.addListener(marker,'click', function(){
              hideAllInfoWindows(map);
              this.infowindow.open(map,this);
      });
  }
}

function hideAllInfoWindows(map) {
   markers.forEach(function(marker) {
     marker.infowindow.close(map, marker);
  });
}
