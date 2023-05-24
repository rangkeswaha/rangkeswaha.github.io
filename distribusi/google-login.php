<?php
session_start();

require_once('google-calendar-api.php');
require_once('settings.php');

// Google passes a parameter 'code' in the Redirect Url
if(isset($_GET['code'])) {
	try {
		$capi = new GoogleCalendarApi();
		
		// Get the access token 
		$data = $capi->GetAccessToken(CLIENT_ID, CLIENT_REDIRECT_URL, CLIENT_SECRET, $_GET['code']);
		
		// Save the access token as a session variable
		$_SESSION['access_token'] = $data['access_token'];

		// Redirect to the page where user can create event
        // harus diganti //
		header('Location: /skripsi/apps/distribusi/catatanbarang.php');
		exit();
	}
	catch(Exception $e) {
		echo $e->getMessage();
		exit();
	}
}

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style type="text/css">

	#logo {
		text-align: center;
		width: 200px;
		display: block;
		margin: 100px auto;
		border: 2px solid #2980b9;
		padding: 10px;
		background: none;
		color: #2980b9;
		cursor: pointer;
		text-decoration: none;
	}

	body {
		background-image: url('https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png');
		background-repeat: no-repeat;
		background-position: center;
		background-size: 50%;
		animation: pulse 2s ease-in-out infinite;
	}

	@keyframes pulse {
		0% {
			transform: scale(1);
		}
		50% {
			transform: scale(1.1);
		}
		100% {
			transform: scale(1);
		}
	}

	.container {
		display: flex;
		justify-content: center;
		align-items: center;
		height: 100vh;
	}
	button {
		padding: 10px 20px;
		font-size: 18px;
		background-color: #4285f4;
		color: #fff;
		border: none;
		border-radius: 5px;
		cursor: pointer;
	}
	button:hover {
		background-color: #3367d6;
	}

</style>
</head>

<body>

<?php

$login_url = 'https://accounts.google.com/o/oauth2/auth?scope=' . urlencode('https://www.googleapis.com/auth/calendar') . '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID . '&access_type=online';

?>

<div class="container">
	<!-- <button onclick="login()">Login to Google</button> -->
	<a id="logo" href="<?= $login_url ?>">Login ke Google</a>
</div>

</body>
</html>