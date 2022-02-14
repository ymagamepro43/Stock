<?php
include('config.php');
$client->revokeToken(array($_SESSION['access_token']));
session_destroy();
header('Location: index.php');
