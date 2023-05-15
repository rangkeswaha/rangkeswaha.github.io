<?php

require_once '../vendor/autoload.php';

$client = new Google_Client();
$client->setApplicationName('My Calendar App');
$client->setScopes(Google_Service_Calendar::CALENDAR);
$client->setAuthConfig('client_secret.json');
$client->setAccessType('offline');

$id_token = $_POST['idtoken'];
$title = $_POST['title'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$location = $_POST['location'];
$description = $_POST['description'];

try {
  $payload = $client->verifyIdToken($id_token);
  $userid = $payload['sub'];
  $service = new Google_Service_Calendar($client);
  $calendarList = $service->calendarList->listCalendarList();
  $calendarId = $calendarList->getItems()[0]->getId();
  $event = new Google_Service_Calendar_Event(array(
    'summary' => $title,
    'location' => $location,
    'description' => $description,
    'start' => array(
      'dateTime' => $start_time,
      'timeZone' => 'Asia/Jakarta',
    ),
    'end' => array(
      'dateTime' => $end_time,
      'timeZone' => 'Asia/Jakarta',
    ),
  ));
  $event = $service->events->insert($calendarId, $event);
  echo 'Event created!';
} catch (Exception $e) {
  echo 'Invalid ID token';
}

?>
