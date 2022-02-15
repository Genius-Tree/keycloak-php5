<?php
require '../vendor/autoload.php';
require 'config.php';
require 'openid_client.php';
$configs = require('config.php');
$base_url =$configs["BASE_URL"];
session_start();
$client = new \GuzzleHttp\Client();
$tokenData = getToken($client,$_GET['code']);
$userInfo = getIntrospectData($client,$tokenData->access_token);
$_SESSION["user"] = $userInfo;
$_SESSION["accessToken"] = $tokenData->access_token;
$_SESSION["refreshToken"] = $tokenData->refresh_token;
header( "Location: $base_url/src/index.php" ) ;

?>
