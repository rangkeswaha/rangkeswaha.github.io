<?php

require_once '../vendor/autoload.php';

$client = new Google_Client();
$client->setApplicationName('My Calendar App');
$client->setScopes(Google_Service_Calendar::CALENDAR);
$client->setAuthConfig('client_secret.json');
$client->setAccessType('offline');

$id_token = $_POST['idtoken'];

try {
  $payload = $client->verifyIdToken($id_token);
  $userid = $payload['sub'];
  $service = new Google_Service_Calendar($client);
  $calendarList = $service->calendarList->listCalendarList();
  $calendarId = $calendarList->getItems()[0]->getId();
  $events = $service->events->listEvents($calendarId);
  $html = '<h2>Upcoming Events</h2>';
  foreach ($events->getItems() as $event) {
    $start = $event->start->dateTime;
    if (empty($start)) {
      $start = $event->start->date;
    }
    $html .= '<p>' . $event->getSummary() . ' (' . $start . ')</p>';
  }
  echo $html;
} catch (Exception $e) {
  echo 'Invalid ID token';
}

?>
