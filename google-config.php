<?php
 
//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';
 
//Make object of Google API Client for call Google API
$google_client = new Google_Client();
 
//Set the OAuth 2.0 Client ID
$google_client->setClientId('807069921897-hl5dolsu1dep8mgpi2evgcvc3k65ke2v.apps.googleusercontent.com');
 
//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');
 
//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost:8888/sites/inlamning-todo/google-login.php');
 
//
$google_client->addScope('email');
 
// $google_client->addScope('profile');
 
//start session on web page
session_start();
