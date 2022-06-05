<?php
      include_once "connection.php";
    $outgoing_id = $_COOKIE['user_id'];
    $sql = "SELECT * FROM users WHERE NOT user_id = {$outgoing_id} ORDER BY user_id DESC";
    $query = mysqli_query($connection, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    echo $output;
?>