<?php
require '../vendor/autoload.php';
require 'openid_client.php';
$configs = require('config.php');
$base_url =$configs["BASE_URL"];
session_start();

$user = $_SESSION["user"];
if($user == NULL){
    header( "Location: https://keycloak.geniustree.io/realms/geniustree/protocol/openid-connect/auth?client_id=php_app&response_mode=query&response_type=code&scope=openid&redirect_uri=$base_url/src/auth.php" ) ;
}else{
    // Every time we access this page we also need to check if user ACTIVE. If not ACTIVE we need to clear local session too(Single Sign Out)
    $client = new \GuzzleHttp\Client();
    $user = getIntrospectData($client,$_SESSION["accessToken"] );
    if(!$user->active){
        //Make sure we logout in case of KeyCloak callback not get called
        $_SESSION["user"]=NULL;
        $_SESSION["accessToken"]=NULL;
        $_SESSION["refreshToken"]=NULL;
        header( "Location: https://keycloak.geniustree.io/realms/geniustree/protocol/openid-connect/auth?client_id=php_app&response_mode=query&response_type=code&scope=openid&redirect_uri=$base_url/src/auth.php" ) ;
    }
    echo "<h3>Login Successful</h3><br/>";
    echo "<h2><a href='logout.php'>Single Logout(logout from Keycloak and all other app too.)</a></h2>";
    echo "<h3><a href='https://keycloak.geniustree.io/realms/geniustree/account/'>Account Info page</a></h3>";
    echo "Name: $user->name<br/>";
    echo "Email: $user->email<br/>";
    echo "JSON details:<br/><pre>".json_encode($user,JSON_PRETTY_PRINT)."</pre>";
}


?>