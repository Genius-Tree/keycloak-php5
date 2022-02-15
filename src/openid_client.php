<?php
$configs = require('config.php');
$base_url = $configs["BASE_URL"];

function getToken($client,$code){
    global $base_url;
    $response = $client->request('POST','https://keycloak.geniustree.io/realms/geniustree/protocol/openid-connect/token',
                ['form_params'=>[
                    'client_id'=>'php_app',
                    'client_secret'=>'5Hi7Q6BHmCB5xSB9fDdowGwzJ2wiyN6M',
                    'grant_type'=>'authorization_code',
                    'redirect_uri'=>"$base_url/src/auth.php",/** must use same value as when redirect to login page */
                    'code'=>$code
                ],
                'verify'=>false]);
    return json_decode($response->getBody());
}
function getIntrospectData($client,$accessToken){
    $response = $client->request('POST','https://keycloak.geniustree.io/realms/geniustree/protocol/openid-connect/token/introspect',
                ['form_params'=>[
                    'client_id'=>'php_app',
                    'client_secret'=>'5Hi7Q6BHmCB5xSB9fDdowGwzJ2wiyN6M',
                    'token'=>$accessToken
                ],
                'verify'=>false]);
    return json_decode($response->getBody());

}
//Why need refresh token -> https://keycloak.discourse.group/t/conceptual-question-why-does-logout-require-a-refresh-token/6292/2
function keyCloakLogout($client,$accessToken,$refreshToken){
    $client->request('POST','https://keycloak.geniustree.io/realms/geniustree/protocol/openid-connect/logout',
                ['headers'=>[
                    'Authorization'=>"Bearer $accessToken"
                ],
                "form_params"=>[
                    'client_id'=>'php_app',
                    'client_secret'=>'5Hi7Q6BHmCB5xSB9fDdowGwzJ2wiyN6M',
                    'token'=>$accessToken,
                    'refresh_token'=>$refreshToken
                ]
                ,
                'verify'=>false]);
}

?>