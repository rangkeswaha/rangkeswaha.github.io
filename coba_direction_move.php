<!DOCTYPE html>
<html>
<head>
<title>Directions Map Example</title>
<style>
#map {
height: 400px;
width: 100%;
}
</style>
</head>
<body>
<div id="map"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5yreJhIC-v-FDNOf1RFZ1C46y7bgAwLw&callback=initMap"
    async defer></script>
<script>
var map;
var circle;
var userLocation;
var destination = 'Jalan Pantai Nusa Dua, Benoa, Badung Regency, Bali, Indonesia';
var marker;

function initMap() {
// Initialize the map
map = new google.maps.Map(document.getElementById('map'), {
zoom: 8,
center: {lat: -8.409518, lng: 115.188919}
});

// Use the Geolocation API to get the user's current location
if (navigator.geolocation) {
navigator.geolocation.getCurrentPosition(function(position) {
userLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

// Use the Google Maps Directions API to get the route from the user's location to the destination
var directionsService = new google.maps.DirectionsService();
var directionsRenderer = new google.maps.DirectionsRenderer();
directionsRenderer.setMap(map);

directionsService.route({
origin: userLocation,
destination: destination,
travelMode: 'DRIVING'
}, function(response, status) {
if (status === 'OK') {
directionsRenderer.setDirections(response);

// Add a circle around the destination with a radius of 500 meters
circle = new google.maps.Circle({
strokeColor: '#0000FF',
strokeOpacity: 0.8,
strokeWeight: 2,
fillColor: '#0000FF',
fillOpacity: 0.35,
map: map,
center: response.routes[0].legs[0].end_location,
radius: 500
});

// Check if the marker is within the circle
google.maps.event.addListener(marker, 'position_changed', function() {
var distance = google.maps.geometry.spherical.computeDistanceBetween(marker.getPosition(), circle.getCenter());
if (distance <= circle.getRadius()) {
alert('You have arrived at your destination!');
}
});
} else {
window.alert('Directions request failed due to ' + status);
}
});

// Add a marker for the user's location
var userMarker = new google.maps.Marker({
position: userLocation,
map: map,
title: 'Your Location'
});

// Add a marker for point A
marker = new google.maps.Marker({
position: userLocation,
map: map,
title: 'Point A',
draggable: true
});

// Add event listeners for the WASD keys
document.addEventListener('keydown', function(event) {
switch (event.keyCode) {
case 87: // W key
marker.setPosition(new google.maps.LatLng(marker.getPosition().lat() + 0.0005, marker.getPosition().lng()));
break;
case 65: // A key
marker.setPosition(new google.maps.LatLng(marker.getPosition().lat(), marker.getPosition().lng() - 0.0005));
break;
case 83: // S key
marker.setPosition(new google.maps.LatLng(marker.getPosition().lat() - 0.0005, marker.getPosition().lng()));
break;
case 68: // D key
marker.setPosition(new google.maps.LatLng(marker.getPosition().lat(), marker.getPosition().lng() + 0.0005));
break;
}
});
}, function() {
alert('Geolocation is not supported by this browser.');
});
} else {
alert('Geolocation is not supported by this browser.');
}
}
</script>
</body>
</html>


<!-- Google API -->
<!-- AIzaSyC5yreJhIC-v-FDNOf1RFZ1C46y7bgAwLw -->