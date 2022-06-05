<?php
$server = "127.0.0.1";
$user = "root";
$password = "";
$dbname = "picpi";
$connection = mysqli_connect($server,$user,$password,$dbname);
if(!$connection){
    echo "Connection not successfull<br>" . mysqli_connect_error();
}
?>