<?php 

require_once 'vendor/autoload.php';

use Google_Client;
use Google_Service_Oauth2;

$client = new Google_Client(); 
$client->setClientId('YOUR_CLIENT_ID');
$client->setClientSecret('YOUR_CLIENT_SECRET');
$client->setRedirectUri('YOUR_REDIRECT_URI');
$client->addScope(Google_Service_Oauth2::USERINFO_EMAIL);
$client->addScope(Google_Service_Oauth2::USERINFO_PROFILE);


if (isset($_GET['code'])) { 
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);

    // Get User Info 
    $oauth2 = new Google_Service_Oauth2($client); 
    $userInfo = $oauth2->userinfo->get();

    echo 'User ID' . $userInfo->id; 
    echo '<br>'; 
    echo 'Full Name' . $userInfo->name; 
    echo '<br>'; 
    echo 'Given Name' . $userInfo->given_name; 
    echo '<br>'; 
    echo 'Family Name' . $userInfo->family_name; 
    echo '<br>'; 
    echo 'Email' . $userInfo->email; 
} else { 
    $authUrl = $client->createAuthUrl(); 
    echo '<a class="login" href="' . $authUrl . '">Login</a>'; 
}   