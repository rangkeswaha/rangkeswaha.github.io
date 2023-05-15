<!-- API Key -->
<!-- AIzaSyC5yreJhIC-v-FDNOf1RFZ1C46y7bgAwLw -->

<!-- Client ID -->
<!-- 143778673708-8itpfmq078q11u3oph2eok4f22nmd0si.apps.googleusercontent.com -->

<!-- Client Secret -->
<!-- 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 -->

<!-- Access Token -->
<!-- ya29.a0AWY7Ckk40ueoOkssakoq0AK2vMOMGcW9OyfOUjOAIZaU-0noA3_l8wKlQXlLulwvpNZqTVrAb8XIStpjejAQIkgmRBtV-XQ4nGEOOPUGJ7XSHKY9wn4ElkWkDD4zx-yO265t7WpP1NPWqvRbXNTEV3XjqM4PaCgYKAc4SARASFQG1tDrp7gbg0bn0AG1lW301m25R7w0163 -->


<!DOCTYPE html>
<html>
<head>
  <title>Google Calendar API Example</title>
  <meta name="google-signin-client_id" content="143778673708-8itpfmq078q11u3oph2eok4f22nmd0si.apps.googleusercontent.com">
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <script src="https://apis.google.com/js/api.js"></script>
  <script>
    // Load the Google API client library
    gapi.load('client:auth2', function() {
      // Initialize the client with your OAuth 2.0 credentials
      gapi.client.init({
        apiKey: 'AIzaSyC5yreJhIC-v-FDNOf1RFZ1C46y7bgAwLw',
        clientId: '143778673708-8itpfmq078q11u3oph2eok4f22nmd0si.apps.googleusercontent.com',
        discoveryDocs: ['https://www.googleapis.com/discovery/v1/apis/calendar/v3/rest'],
        scope: 'https://www.googleapis.com/auth/calendar.events'
      }).then(function() {
        // Enable the insert button
        document.getElementById('insert-button').disabled = false;
      });

      // Sign in the user
      function onSignIn(googleUser) {
        // Set the user's access token
        var accessToken = googleUser.getAuthResponse().access_token;
        gapi.client.setToken({
          access_token: accessToken
        });

        console.log('User signed in.');
      }

      // Insert an event into the user's calendar
      document.getElementById('insert-button').addEventListener('click', function() {
        gapi.client.calendar.events.insert({
          calendarId: 'primary',
          resource: {
            summary: 'My Event',
            start: {
              dateTime: '2023-05-15T09:00:00-07:00'
            },
            end: {
              dateTime: '2023-05-15T10:00:00-:00'
            }
          }
        }).then(function(response) {
          console.log('Event created: ' + response.result.htmlLink);
        }, function(error) {
          console.error(error);
        });
      });
    });
  </script>
</head>
<body>
  <h1>Google Calendar API Example</h1>
  <div id="signin-button" class="g-signin2" data-onsuccess="onSignIn"></div>
  <button id="insert-button" disabled>Insert Event</button>
</body>
</html>