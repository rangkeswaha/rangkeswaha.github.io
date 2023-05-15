<?php

require_once '../vendor/autoload.php'; 

use Kreait\Firebase\Factory;

$factory = (new Factory)
    ->withServiceAccount('../artha-makmur-firebase-adminsdk-v0s3o-27887176be.json')
    ->withDatabaseUri('https://artha-makmur-default-rtdb.firebaseio.com/');
    
$database = $factory->createDatabase();

$properties = [
    'title' => "aa",
    'description' => "aa",
    'location' => "aa",
    'date' => "aa",
    'time_from' => "aa",
    'time_to' => "aa",
    'google_calendar_event_id' => "kosong",
    'created' => "kosong",
];

$ref_table = "calendar";
$postRef_result = $database->getReference($ref_table)->push($properties);

$eventid = $postRef_result->getKey();

echo json_encode($eventid);

?>