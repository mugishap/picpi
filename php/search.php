<?php
      include_once "./../connection.php";
include './../checkloggedin.php';
    $outgoing_id = $_COOKIE['PICPI-USERID'];
    $searchTerm = mysqli_real_escape_string($connection, $_POST['searchTerm']);

    $sql = "SELECT * FROM users WHERE NOT user_id = '$outgoing_id' AND (firstname LIKE '%$searchTerm%' OR lastname LIKE '%$searchTerm%' OR username LIKE '%$searchTerm%')";
    $output = "";
    $query = mysqli_query($connection, $sql);
    if(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }else{
        $output .= 'No user found related to your search term';
    }
    echo $output;
