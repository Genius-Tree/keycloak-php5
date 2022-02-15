<?php
require '../vendor/autoload.php';
require 'openid_client.php';
session_start();
$client = new \GuzzleHttp\Client();
$tokenData = getToken($client,$_GET['code']);
$userInfo = getIntrospectData($client,$tokenData->access_token);
$_SESSION["user"] = $userInfo;
$_SESSION["accessToken"] = $tokenData->access_token;
$_SESSION["refreshToken"] = $tokenData->refresh_token;
header( 'Location: http://localhost:8888/src/index.php' ) ;

?>
