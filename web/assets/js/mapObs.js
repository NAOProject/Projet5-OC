//Script de la carte pour observation.html.twig

var resultArray = (function getGeoDataArray() {
  var $coords = $('#coordonnees').find('div');
  var resultsArray = [];
  for (var i = 0; i < $coords.length; i++) {
      var lat = $($coords[i]).data('latitude');
      var lng = $($coords[i]).data('longitude');
      var coord = [lat, lng];
      resultsArray.push(coord);
  }
  return resultsArray;
})();

function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 16,
    center: { lat: 46.52863469527167, lng: 2.43896484375 }
  });

  for (var i = 0; i < resultArray.length; i++) {
      var result = resultArray[i];
      var marker = new google.maps.Marker({
          position: {lat: result[0], lng: result[1]},
          map: map,
      });
      var geocoder = new google.maps.Geocoder;
      var lat = result[0];
      var lng = result[1];
      geocodeLatLng(geocoder, map, lat, lng);
  }
}

var marker
function geocodeLatLng(geocoder, map, lat, lng) {
  var latlng = {lat: lat, lng: lng};
  map.panTo(latlng);
  geocoder.geocode({'location': latlng}, function(results, status) {
    $(".obsPlaceText").html("<p class='bold'>" + results[1].formatted_address +
    "</p><p class='italic'>" +
    "long: " + lng + ", lat: " + lat );
  });
}

$(".changeTaxrefname").click(function() {
  $(".changeName").removeClass("hidden");
  $('.changeBtn').addClass("hidden");
})

$(".notconforme").click(function() {
  $(".notconformzone").removeClass("hidden");
})

function toggleFullscreen(elem) {
  elem = elem || document.documentElement;
  if (!document.fullscreenElement && !document.mozFullScreenElement &&
    !document.webkitFullscreenElement && !document.msFullscreenElement) {
    if (elem.requestFullscreen) {
      elem.requestFullscreen();
    } else if (elem.msRequestFullscreen) {
      elem.msRequestFullscreen();
    } else if (elem.mozRequestFullScreen) {
      elem.mozRequestFullScreen();
    } else if (elem.webkitRequestFullscreen) {
      elem.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
    }
  } else {
    if (document.exitFullscreen) {
      document.exitFullscreen();
    } else if (document.msExitFullscreen) {
      document.msExitFullscreen();
    } else if (document.mozCancelFullScreen) {
      document.mozCancelFullScreen();
    } else if (document.webkitExitFullscreen) {
      document.webkitExitFullscreen();
    }
  }
}

document.getElementById('photo').addEventListener('click', function() {
  toggleFullscreen(this);
});
