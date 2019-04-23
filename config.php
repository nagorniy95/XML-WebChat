<?php
	session_start();
	require_once "GoogleAPI/vendor/autoload.php";
	$gClient = new Google_Client();

	$gClient->setClientId("1089576764035-23tjjqs4ruab1ar1640chnoqpg4eban5.apps.googleusercontent.com");
	$gClient->setClientSecret("EYlXfrYqIeus2NhHlEY2tykU");

	$gClient->setApplicationName("Google login");
	$gClient->setRedirectUri("http://localhost:8080/google-callback.php");
	
	// https://developers.google.com/+/web/api/rest/oauth#authorization-scopes
	$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");

?>
