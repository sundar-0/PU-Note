<?php
include('../config.php');
// //Reset OAuth access token
$google_client->revokeToken();

//Destroy entire session data.
session_destroy();
header('Location:../index.php');
?>
