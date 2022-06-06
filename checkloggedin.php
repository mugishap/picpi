<?php
include './connection.php';
if (!isset($_COOKIE['PICPI-USERID'])) {
    header("Location: ./login.php");
    return;
}
$userid = $_COOKIE['PICPI-USERID'];
$getUser = mysqli_query($connection, "SELECT * FROM users WHERE user_id='$userid'");
if (!$getUser || mysqli_num_rows($getUser) !== 1) {
header("location: ./login.php");
    return;
}
$setStatus = mysqli_query($connection, "UPDATE users SET status = 'Active now' WHERE user_id='$userid'");
list($userid, $firstname, $lastname, $telephone, $profile, $gender, $nationality, $username, $email,, $role) = mysqli_fetch_array($getUser);
