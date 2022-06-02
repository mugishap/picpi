<?php

$server = 'localhost';
$dbname = 'rwanda';
$dbuser = 'root';
$dbpass = '';
$connect = mysqli_connect($server, $dbuser, $dbpass , $dbname);
if(!$connect){
    echo mysqli_connect_error();
}else{
    echo "Connected";
}

?>