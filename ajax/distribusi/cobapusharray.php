<?php

session_start();
include('../../db.php');

// push array data to database //

// $dataArray = array(
//     array('name' => 'Morty', 'age' => 14),
//     array('name' => 'Summer', 'age' => 17),
//     array('name' => 'Rick', 'age' => 70),
//     array('name' => 'Rangke', 'age' => 23)
//   );

// $dataRef = $database->getReference('tryarraypush');
// $dataRef->push($dataArray);
  

// get array data from database //

// Get a reference to the data
$dataRef = $database->getReference('tryarraypush');

// Sort the data by their keys
$dataRef = $dataRef->orderByKey();

// Get the data as a snapshot
$dataSnapshot = $dataRef->getSnapshot();

// Initialize an array to hold the data
$dataArray = array();

// Loop through the snapshot and push the data into the array
foreach ($dataSnapshot->getValue() as $key => $value) {
  $dataArray[] = array(
    'key' => $key,
    'value' => $value
  );
}

// Echo the data from the array
// foreach ($dataArray as $data) {
//   echo "Key: " . $data['key'] . "\n";
//   echo "Value: ";
//   print_r($data['value']);
//   echo "\n";
// }

// Echo specific data from the array
echo "First key, first data: ";
print_r($dataArray[0]['value'][0]);
echo "\n";
echo "Second key, fourth data: ";
print_r($dataArray[1]['value'][3]);
echo "\n";

// Echo specific data from the array with it's specific attribute
echo "First key, first data: ";
print_r($dataArray[0]['value'][0]['name']);
echo "\n";
echo "Second key, fourth data: ";
print_r($dataArray[1]['value'][3]['name']);
echo "\n";
?>