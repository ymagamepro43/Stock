<?php
$hostname = "localhost";
$username = "monke13nccuser";
$password = "ncc1";
$datebase = "monke13ncc";
$connection = mysqli_connect($hostname, $username, $password);
if (!$connection) {
    die("Connection failed " . mysqli_connect_error());
}
// echo "Connection successful";
mysqli_select_db($connection, $datebase);
