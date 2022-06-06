<?php
if (isset($_COOKIE['PICPI-USERID'])) {
    include_once "./../connection.php";
    $outgoing_id = $_COOKIE['PICPI-USERID'];
    $incoming_id =  $_POST['incoming_id'];
    $message = $_POST['message'];
    if (!empty($message)) {
        $insert = "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg) VALUES ('$incoming_id', '$outgoing_id', '$message')";
        $sql = mysqli_query($connection, $insert) or die(mysqli_error($connection));
        echo "What word here";
    }
} else {
    header("location: ../login.php");
}