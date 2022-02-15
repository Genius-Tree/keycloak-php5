<?php
require '../vendor/autoload.php';
require 'openid_client.php';
$configs = require('config.php');
$base_url =$configs["BASE_URL"];
session_start();
$client = new \GuzzleHttp\Client();
keyCloakLogout($client,$_SESSION["accessToken"],$_SESSION["refreshToken"]);
header( "Location: $base_url" ) ;

?>