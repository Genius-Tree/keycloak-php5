<?php
require '../vendor/autoload.php';
require 'openid_client.php';
session_start();
$client = new \GuzzleHttp\Client();
keyCloakLogout($client,$_SESSION["accessToken"],$_SESSION["refreshToken"]);
header( 'Location: http://localhost:8888' ) ;

?>