<?php
include("connect.php");
header("Content-Type: text/xml; charset=utf-8");
$user_id = $_GET['id'];

$query = "SELECT * From Company WHERE user_id='$user_id'";
$result = mysqli_query($connection, $query);
$num_result = mysqli_num_rows($result);
$doc = new DOMDocument();
$doc->formatOutput = true;
$root = $doc->createElement("all_stocks");
$doc->appendChild($root);
for ($i = 0; $i < $num_result; $i++) {
    $row = mysqli_fetch_assoc($result);
    $company = $doc->createElement("stock");
    $root->appendChild($company);

    $symbol = $doc->createElement("Symbol");
    $symbol->appendChild($doc->createTextNode($row['Symbol']));
    $company->appendChild($symbol);

    $amount = $doc->createElement("Amount");
    $amount->appendChild($doc->createTextNode($row['Amount']));
    $company->appendChild($amount);

    $price = $doc->createElement("Price");
    $price->appendChild($doc->createTextNode($row['Price']));
    $company->appendChild($price);

    $date_time = $doc->createElement("Date_Time");
    $date_time->appendChild($doc->createTextNode($row['Date_Time']));
    $company->appendChild($date_time);
}
echo $doc->saveXML();
