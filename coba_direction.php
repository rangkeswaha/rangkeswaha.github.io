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
function initMap() {
// Initialize the map
var map = new google.maps.Map(document.getElementById('map'), {
zoom: 8,
center: {lat: -8.409518, lng: 115.188919}
});

// Use the Geolocation API to get the user's current location
if (navigator.geolocation) {
navigator.geolocation.getCurrentPosition(function(position) {
var userLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

// Use the Google Maps Directions API to get the route from the user's location to Jalan Pantai Nusa Dua
var directionsService = new google.maps.DirectionsService();
var directionsRenderer = new google.maps.DirectionsRenderer();
directionsRenderer.setMap(map);

var destination = 'Jalan Pantai Nusa Dua, Benoa, Badung Regency, Bali, Indonesia';

directionsService.route({
origin: userLocation,
destination: destination,
travelMode: 'DRIVING'
}, function(response, status) {
if (status === 'OK') {
directionsRenderer.setDirections(response);

// Add a circle around the destination with a radius of 500 meters
var circle = new google.maps.Circle({
strokeColor: '#0000FF',
strokeOpacity: 0.8,
strokeWeight: 2,
fillColor: '#0000FF',
fillOpacity: 0.35,
map: map,
center: response.routes[0].legs[0].end_location,
radius: 100
});

// Check if the user is within the circle
google.maps.event.addListener(map, 'idle', function() {
var distance = google.maps.geometry.spherical.computeDistanceBetween(userLocation, circle.getCenter());
if (distance <= circle.getRadius()) {
alert('You have arrived at your destination!');
}
});
} else {
window.alert('Directions request failed due to ' + status);
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