<?php
    include_once "./../connection.php";
    include './../checkloggedin.php';
    $outgoing_id = $_COOKIE['PICPI-USERID'];
    $sql = "SELECT * FROM users WHERE NOT user_id='$userid'";
    $query = mysqli_query($connection, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    echo $output;
?>