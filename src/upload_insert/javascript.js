$(document).ready(function() 
{
	$("#navigation_bar").load("/navigation_bar/navigation_bar.html");
	
});

var geocoder = new google.maps.Geocoder();

function geocodePosition(pos) {
  geocoder.geocode({
    latLng: pos
  }, function(responses) {
    if (responses && responses.length > 0) {
      updateMarkerAddress(responses[0].formatted_address);
    } else {
      updateMarkerAddress('Cannot determine address at this location.');
    }
  });
}

/*
function updateMarkerStatus(str) {
  document.getElementById('markerStatus').innerHTML = str;
}
*/

function updateMarkerPosition(latLng) {
  document.getElementById('latitude').value = latLng.lat();
  document.getElementById('longitude').value = latLng.lng();
}

function updateMarkerAddress(str) {
  document.getElementById('address').innerHTML = str;
}

function initialize() {
  var latLng = new google.maps.LatLng(38.25169851618419, 21.737480384655782);
  //var latlng2 = new google.maps.LatLng(38.25169851018419, 21.737480384600782);
  var map = new google.maps.Map(document.getElementById('insert_map'), {
    zoom: 18,
    center: latLng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  var marker = new google.maps.Marker({
    position: latLng,
    title: 'Point A',
    map: map,
    draggable: true
  });
  
  /*var marker2 = new google.maps.Marker({
    position: latLng2,
    title: 'Point B',
    map: map,
    draggable: true
  });
*/
  // Update current position info.
  updateMarkerPosition(latLng);
  geocodePosition(latLng);

  // Add dragging event listeners.
  google.maps.event.addListener(marker, 'dragstart', function() {
    updateMarkerAddress('Dragging...');
  });

  google.maps.event.addListener(marker, 'drag', function() {
    //updateMarkerStatus('Dragging...');
    updateMarkerPosition(marker.getPosition());
  });

  google.maps.event.addListener(marker, 'dragend', function() {
    //updateMarkerStatus('Drag ended');
    geocodePosition(marker.getPosition());
  });
}

// Onload handler to fire off the app.
google.maps.event.addDomListener(window, 'load', initialize);
