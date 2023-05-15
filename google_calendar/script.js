function initClient() {
    gapi.client.init({
      apiKey: 'AIzaSyC5yreJhIC-v-FDNOf1RFZ1C46y7bgAwLw',
      clientId: '143778673708-8itpfmq078q11u3oph2eok4f22nmd0si.apps.googleusercontent.com',
      discoveryDocs: ['https://www.googleapis.com/discovery/v1/apis/calendar/v3/rest'],
      scope: 'https://www.googleapis.com/auth/calendar'
    }).then(function() {
      var auth2 = gapi.auth2.getAuthInstance();
      if (auth2.isSignedIn.get()) {
        var calendar = document.getElementById('calendar');
        var form = document.getElementById('event-form');
        form.addEventListener('submit', function(event) {
          event.preventDefault();
          createEvent(auth2.currentUser.get().getAuthResponse().id_token);
        });
        listUpcomingEvents();
      } else {
        auth2.signIn().then(function() {
          var calendar = document.getElementById('calendar');
          var form = document.getElementById('event-form');
          form.addEventListener('submit', function(event) {
            event.preventDefault();
            createEvent(auth2.currentUser.get().getAuthResponse().id_token);
          });
          listUpcomingEvents();
        });
      }
    });
  }
  
  function listUpcomingEvents() {
    gapi.client.calendar.events.list({
      'calendarId': 'primary',
      'timeMin': (new Date()).toISOString(),
      'showDeleted': false,
      'singleEvents': true,
      'maxResults': 10,
      'orderBy': 'startTime'
    }).then(function(response) {
      var events = response.result.items;
      var calendar = document.getElementById('calendar');
      var html = '<h2>Upcoming Events</h2>';
      if (events.length > 0) {
        for (var i = 0; i < events.length; i++) {
          var event = events[i];
          var start = event.start.dateTime || event.start.date;
          html += '<p>' + event.summary + ' (' + start + ')</p>';
        }
      } else {
        html += '<p>No upcoming events found.</p>';
      }
      calendar.innerHTML = html;
    });
  }
  
  function createEvent(id_token) {
    var title = document.getElementById('title').value;
    var start_time = document.getElementById('start-time').value;
    var end_time = document.getElementById('end-time').value;
    var location = document.getElementById('location').value;
    var description = document.getElementById('description').value;
    gapi.client.calendar.events.insert({
      'calendarId': 'primary',
      'resource': {
        'summary': title,
        'location': location,
        'description': description,
        'start': {
          'dateTime': start_time,
          'timeZone': 'Asia/Jakarta'
        },
        'end': {
          'dateTime': end_time,
          'timeZone': 'Asia/Jakarta'
        }
      }
    }).then(function(response) {
      alert('Event created!');
    });
  }
  