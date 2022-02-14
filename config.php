<?php
require_once 'vendor/autoload.php';
$client = new Google_Client();
$client->setAuthConfig('client_secret.json');
$client->addScope('email');
$client->addScope('profile');
session_start();
