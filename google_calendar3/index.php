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
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script>
    function addEvent() {
      var event = {
        'summary': 'Test Event',
        'location': 'Somewhere',
        'description': 'A test event',
        'start': {
          'dateTime': '2023-05-15T09:00:00-07:00',
          'timeZone': 'Asia/Jakarta'
        },
        'end': {
          'dateTime': '2023-05-15T17:00:00-07:00',
          'timeZone': 'Asia/Jakarta'
        },
        'reminders': {
          'useDefault': true
        }
      };

      var accessToken = 'ya29.a0AWY7CknNMMZF5P9Zm9pEyEcnCHLEbJeVAWvSF5pt1QazAQ5YFV1s-B0GgM-rCVjOjuH1EvSowQAPPlelp0d91ljmVmXCTOzMDoUKi94btCEMrFrtYUWAEHIv4qHwiobodG7y7NAdXKkow4jDQryf0l_Fs3WPaCgYKAQISARASFQG1tDrpgPmUSfmqGohbNu0D8OyfiQ0163';

      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'https://www.googleapis.com/calendar/v3/calendars/primary/events');
      xhr.setRequestHeader('Authorization', 'Bearer ' + accessToken);
      xhr.setRequestHeader('Content-Type', 'application/json');
      xhr.onload = function() {
        if (xhr.status === 200) {
          console.log('Event created: ' + xhr.responseText);
        } else {
          console.log('Error creating event: ' + xhr.responseText);
        }
      };
      xhr.send(JSON.stringify(event));
    }
  </script>
</head>
<body>
  <h1>Google Calendar API Example</h1>
  <p>
    <button onclick="addEvent()">Add Event</button>
  </p>
</body>
</html>