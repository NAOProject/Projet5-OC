//Script pour la page addObservation.html.twig

$('#observation_notsur').change(function() {
  if ($('#observation_notsur').is(":checked")) {
    $('#observation_picture_image').attr("required", true);
  } else {
    $('#observation_picture_image').attr("required", false);
  }
})


var inputLatitude = document.getElementById("observation_latitude");
var inputLongitude = document.getElementById("observation_longitude");
var ville = document.getElementById("observation_ville");
inputLatitude.value = null;
inputLongitude.value = null;
ville.value = null;

function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 5,
    center: { lat: 46.52863469527167, lng: 2.43896484375 }
  });
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        map.setCenter(pos);
        map.setZoom(14);
      })
    }
  var geocoder = new google.maps.Geocoder;
  var infowindow = new google.maps.InfoWindow;
  map.addListener('click', function(e) {
    geocodeLatLng(geocoder, map, infowindow, e.latLng);
  });
}

var marker
function geocodeLatLng(geocoder, map, infowindow, latLng) {
  var latlng = {lat: latLng.lat(), lng: latLng.lng()};
  geocoder.geocode({'location': latlng}, function(results, status) {
    if (status === 'OK') {
      if (results[1]) {
        map.setZoom(11);
        if(marker) {
          marker.setPosition(latLng);
        }else{
           marker = new google.maps.Marker({
            position: latLng,
            map: map
          });
        }
        map.panTo(latLng);
        inputLatitude.value = latLng.lat();
        inputLongitude.value = latLng.lng();
        ville.value = results[1].formatted_address;
        infowindow.setContent(results[1].formatted_address);
        infowindow.open(map, marker);
      } else {
        window.alert('No results found');
      }
    } else {
      window.alert('Geocoder failed due to: ' + status);
    }
  });
}
