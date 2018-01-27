//Script pour la page addObservation.html.twig

$('#observation_notsur').change(function() {
  if ($('#observation_notsur').is(":checked")) {
    $('#observation_picture_image').attr("required", true);
    $('.imageLabel').addClass('addEtoile');
  } else {
    $('#observation_picture_image').attr("required", false);
    $('.imageLabel').removeClass('addEtoile');
  }
});

$("#observation_picture_image").change(function(){
    readURL(this);
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
            $('.image').removeClass('hidden');
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$('#observation_dateObs').datepicker({
  format: "dd/mm/yyyy",
  endDate: '0',
  todayBtn: true,
  language: "fr",
  autoclose: true,
  todayHighlight: true,
});

var inputLatitude = document.getElementById("observation_latitude");
var inputLongitude = document.getElementById("observation_longitude");
inputLatitude.value = null;
inputLongitude.value = null;

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
  map.addListener('click', function(e) {
    geocodeLatLng(geocoder, map, e.latLng);
  });
}

var marker
function geocodeLatLng(geocoder, map, latLng) {
  var latlng = {lat: latLng.lat(), lng: latLng.lng()};
  geocoder.geocode({'location': latlng}, function(results, status) {
    if (status === 'OK') {
      if (results[1]) {
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
        $("#observation_ville").html("<p class='bold'>" + results[1].formatted_address +
        "</p><p class='italic'>" +
        "long: " + inputLongitude.value + ", lat: " + inputLatitude.value );
      } else {
        window.alert('No results found');
      }
    } else {
      window.alert('Geocoder failed due to: ' + status);
    }
  });
}
