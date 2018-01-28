//Script JS pour la page recherche.html.twig + results.html.twig
var markers = [];
var resultArray = (function getGeoDataArray() {
  var $coords = $('#coordonnees').find('div');
  var resultsArray = [];
  for (var i = 0; i < $coords.length; i++) {
      var lat = $($coords[i]).data('latitude');
      var lng = $($coords[i]).data('longitude');
      var src = $($coords[i]).data('src').toString();
      var date = $($coords[i]).data('date');

      var content = '<div class="miniObs"><img class="miniPic" src="'+ src + '">'
      + '<div class="descriptionMini"><h4>' + $($coords[i]).data("espece") + '</h4>' + '<div class="col-md-6 col-xs-6"><h5>'
      + $($coords[i]).data("username") + '.' + '</h5></div><div class="col-md-6 col-xs-6"><h5 class="italic">'
      + date + '.' + '</h5></div></div></div>';

      var coord = [lat, lng, content];
      resultsArray.push(coord);
  }
  return resultsArray;
})();

var autorisation = $('#autorisation').find('div');
var auto = $(autorisation).data('user');

function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 5,
    center: { lat: 46.52863469527167, lng: 2.43896484375 }
  });

  setMarkers(map);
  var markerCluster = new MarkerClusterer(map, markers,
    {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
}


function setMarkers(map) {
  for (var i = 0; i < resultArray.length; i++) {
    var result = resultArray[i];
    if (auto == 'ALLOW') {
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
        // Reference to the DIV which receives the contents of the infowindow using jQuery
        var iwOuter = $('.gm-style-iw');

        /* The DIV we want to change is above the .gm-style-iw DIV.
         * So, we use jQuery and create a iwBackground variable,
         * and took advantage of the existing reference to .gm-style-iw for the previous DIV with .prev().
         */
        var iwBackground = iwOuter.prev();

        // Remove the background shadow DIV
        iwBackground.children(':nth-child(2)').css({'display' : 'none'});

        // Remove the white background DIV
        iwBackground.children(':nth-child(4)').css({'display' : 'none'});
        // Moves the infowindow 115px to the right.
        iwOuter.parent().parent().css({left: '15px'});

        // Moves the shadow of the arrow 76px to the left margin
        iwBackground.children(':nth-child(1)').attr('style', function(i,s){ return s + 'left: 176px !important;'});

        // Moves the arrow 76px to the left margin
        iwBackground.children(':nth-child(3)').attr('style', function(i,s){ return s + 'left: 176px !important;'});
        iwBackground.children(':nth-child(3)').children(':nth-child(2)').children(':nth-child(1)').css('background-color', '#ff5b00');
        iwBackground.children(':nth-child(3)').children(':nth-child(1)').children(':nth-child(1)').css('background-color', '#ff5b00');

        // Taking advantage of the already established reference to
        // div .gm-style-iw with iwOuter variable.
        // You must set a new variable iwCloseBtn.
        // Using the .next() method of JQuery you reference the following div to .gm-style-iw.
        // Is this div that groups the close button elements.
        var iwCloseBtn = iwOuter.next();
        var iwCloseImage = iwOuter.next().next();

        // Apply the desired effect to the close button
        if($(window).width()<=767) {
          iwCloseBtn.css({
            opacity: '0.7', // by default the close button has an opacity of 0.7
            right: '-15px', top: '20px', // button repositioning
            });
          iwBackground.children(':nth-child(1)').attr('style', function(i,s){ return s + 'left: 140px !important;'});
          iwBackground.children(':nth-child(3)').attr('style', function(i,s){ return s + 'left: 140px !important;'});
        } else {
          iwCloseBtn.css({
            opacity: '0.7', // by default the close button has an opacity of 0.7
            right: '60px', top: '20px', // button repositioning
            });
          iwCloseImage.css({
            right: '40px',
          })
        }



        // The API automatically applies 0.7 opacity to the button after the mouseout event.
        // This function reverses this event to the desired value.
        iwCloseBtn.mouseout(function(){
          $(this).css({opacity: '1'});
        });
      });
    }
    else if (auto == 'NOTALLOW') {
      var cityCircle = new google.maps.Circle({
        strokeColor: '#FF0000',
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: '#FF0000',
        fillOpacity: 0.35,
        map: map,
        center: {lat: result[0], lng: result[1]},
        radius: Math.sqrt(500) * 100
      });
    }
  }
}

function hideAllInfoWindows(map) {
   markers.forEach(function(marker) {
     marker.infowindow.close(map, marker);
  });
}
