<?php
include("connect.php");
$amount = $_GET['amount'];
$price = $_GET['price'];
$id = $_GET['id'];
$symbol = $_GET['symbol'];

$query = "INSERT INTO Company (Amount,Symbol,Price,user_id)value('$amount','$symbol','$price','$id')";
$result = mysqli_query($connection, $query);
