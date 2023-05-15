<?php     
// Include database configuration file 
require_once 'dbConfig.php'; 

// include('../db.php');

// require __DIR__.'/vendor/autoload.php';

require_once '../vendor/autoload.php'; 

use Kreait\Firebase\Factory;

$factory = (new Factory)
    ->withServiceAccount('../artha-makmur-firebase-adminsdk-v0s3o-27887176be.json')
    ->withDatabaseUri('https://artha-makmur-default-rtdb.firebaseio.com/');
    
$database = $factory->createDatabase();
 
$postData = $statusMsg = $valErr = ''; 
$status = 'danger'; 
 
// If the form is submitted 
if(isset($_POST['submit'])){ 
     
    // Get event info 
    $_SESSION['postData'] = $_POST; 
    $title = !empty($_POST['title'])?trim($_POST['title']):''; 
    $description = !empty($_POST['description'])?trim($_POST['description']):''; 
    $location = !empty($_POST['location'])?trim($_POST['location']):''; 
    $date = !empty($_POST['date'])?trim($_POST['date']):''; 
    $time_from = !empty($_POST['time_from'])?trim($_POST['time_from']):''; 
    $time_to = !empty($_POST['time_to'])?trim($_POST['time_to']):''; 
     
    // Validate form input fields 
    if(empty($title)){ 
        $valErr .= 'Please enter event title.<br/>'; 
    } 
    if(empty($date)){ 
        $valErr .= 'Please enter event date.<br/>'; 
    } 
     
    // Check whether user inputs are empty 
    if(empty($valErr)){ 
        // // Insert data into the database 
        // $sqlQ = "INSERT INTO events (title,description,location,date,time_from,time_to,created) VALUES (?,?,?,?,?,?,NOW())"; 
        // $stmt = $db->prepare($sqlQ); 
        // $stmt->bind_param("ssssss", $db_title, $db_description, $db_location, $db_date, $db_time_from, $db_time_to); 
        // $db_title = $title; 
        // $db_description = $description; 
        // $db_location = $location; 
        // $db_date = $date; 
        // $db_time_from = $time_from; 
        // $db_time_to = $time_to; 
        // $insert = $stmt->execute();
        
        $properties = [
            'title' => $title,
            'description' => $description,
            'location' => $location,
            'date' => $date,
            'time_from' => $time_from,
            'time_to' => $time_to,
            'google_calendar_event_id' => "kosong",
            'created' => "kosong",
        ];

        $ref_table = "calendar";
        $postRef_result = $database->getReference($ref_table)->push($properties);

        $eventid = $postRef_result->getKey(); 
         
        if($eventid != ""){ 
            // $event_id = $stmt->insert_id; 
             
            unset($_SESSION['postData']); 
             
            // Store event ID in session 
            $_SESSION['last_event_id'] = $eventid; 
             
            header("Location: $googleOauthURL"); 
            exit(); 
        }else{ 
            $statusMsg = 'Something went wrong, please try again after some time.'; 
        } 
    }else{ 
        $statusMsg = '<p>Please fill all the mandatory fields:</p>'.trim($valErr, '<br/>'); 
    } 
}else{ 
    $statusMsg = 'Form submission failed!'; 
} 
 
$_SESSION['status_response'] = array('status' => $status, 'status_msg' => $statusMsg); 
 
header("Location: index.php"); 
exit(); 
?>