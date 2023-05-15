<?php 
 
// Database configuration    
// define('DB_HOST', 'MySQL_Database_Host'); 
// define('DB_USERNAME', 'MySQL_Database_Username'); 
// define('DB_PASSWORD', 'MySQL_Database_Password'); 
// define('DB_NAME', 'MySQL_Database_Name'); 
 
// Google API configuration 
define('GOOGLE_CLIENT_ID', '143778673708-8itpfmq078q11u3oph2eok4f22nmd0si.apps.googleusercontent.com'); 
define('GOOGLE_CLIENT_SECRET', 'Google_Project_Client_Secret'); 
define('GOOGLE_OAUTH_SCOPE', 'https://www.googleapis.com/auth/calendar'); 
define('REDIRECT_URI', 'http://localhost/skripsi/apps/google_calendar2/google_calendar_event_sync.php'); 

 
// Google OAuth URL 
$googleOauthURL = 'https://accounts.google.com/o/oauth2/auth?scope=' . urlencode(GOOGLE_OAUTH_SCOPE) . '&redirect_uri=' . REDIRECT_URI . '&response_type=code&client_id=' . GOOGLE_CLIENT_ID . '&access_type=online'; 
 

// Start session 
if(!session_id()) session_start(); 
?>