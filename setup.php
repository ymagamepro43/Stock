<?php
include("connect.php");

$query = "DROP TABLE Things";
$result = mysqli_query($connection, $query);

$query = "CREATE TABLE Company(Row_ID  int AUTO_INCREMENT PRIMARY KEY,user_id varchar(30), Date_Time DATE DEFAULT CURRENT_TIMESTAMP, Symbol varchar(10),Amount float, Price float)";
$result = mysqli_query($connection, $query);

if ($result) {
    echo "successful";
} else {
    echo mysqli_error($connection);
}
