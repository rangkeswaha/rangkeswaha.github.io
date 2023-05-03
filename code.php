<!DOCTYPE html>
<html>
  <head>
    <title>Map Example</title>
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

        // Use the Google Maps Geocoder to find the latitude and longitude of the location
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({'address': 'Perumahan Wisma Nusa Permai Blok E No. 40 Kelurahan Benua, Benoa, South Kuta, Badung Regency, Bali 80361, Indonesia'}, function(results, status) {
          if (status === 'OK') {
            // Set the map center to the location
            map.setCenter(results[0].geometry.location);

            // Add a marker at the location
            var marker = new google.maps.Marker({
              map: map,
              position: results[0].geometry.location
            });
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
      }
    </script>
  </body>
</html>

<!-- Google Api -->
<!-- AIzaSyC5yreJhIC-v-FDNOf1RFZ1C46y7bgAwLw -->