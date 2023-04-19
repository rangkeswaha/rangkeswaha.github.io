<?php

require __DIR__.'/vendor/autoload.php';

use Kreait\Firebase\Factory;

$factory = (new Factory)
    ->withServiceAccount('../../artha-makmur-firebase-adminsdk-v0s3o-27887176be.json')
    ->withDatabaseUri('https://artha-makmur-default-rtdb.firebaseio.com/');
    
$database = $factory->createDatabase();
$auth = $factory->createAuth();


?>