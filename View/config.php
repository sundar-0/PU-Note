<?php
session_start();
require_once 'vendor/autoload.php';
$google_client = new Google_Client();
$google_client->setClientId('492297983520-sv605jnarftsvn0v394pct22sbv4fdds.apps.googleusercontent.com');
$google_client->setClientSecret('YY0Jpb5eayYg6L0ughqcmiyC');
$google_client->setRedirectUri('http://localhost/PUNotes/View/index.php');
$google_client->addScope('email');
$google_client->addScope('profile');
?> 