<?php
require __DIR__ . '/../vendor/autoload.php';


session_start();

$client = new Google_Client();
$client->setClientId('751354737095-fo46srd7fqr7k7qke5ok496rbekuv84k.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost:83/public/googlecallback.php'); 
$client->addScope('email');
$client->addScope('profile');

$login_url = $client->createAuthUrl();
?>