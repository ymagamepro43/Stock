<?php
include("connect.php");


$symbol = $_GET['symbol'];
$amount = $_GET['amount'];
$price = $_GET['price'];
$id = $_GET['id'];

$query = "DELETE FROM company WHERE user_id='$id' AND Amount='$amount' AND Symbol='$symbol' AND Price LIKE '$price'";

$result = mysqli_query($connection, $query);

if (!$result) {
    echo "Delete error" . mysqli_error($connection);
}
