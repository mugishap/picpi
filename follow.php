<?php
include './connection.php';
include './checkloggedin.php';
$today = date('Y-m-d H:i');
$query = mysqli_query($connection, 'SELECT * FROM posts ORDER BY post_id DESC');

$toFollowUsername = $_POST['toFollowUsername'];
$getToFollow = mysqli_query($connection, "SELECT user_id,profile FROM users WHERE username='$toFollowUsername'");
if (!$getToFollow) return;
list($toFollowId, $toFollowProfile) = mysqli_fetch_array($getToFollow);
$status =  $_POST['status'];
echo $status;
if ($status === 'follow') {
    $addToFollowing = mysqli_query($connection, "INSERT INTO following_$username(following_id,following_username,following_profile) values('$toFollowId','$toFollowUsername','$toFollowProfile');");
    $addToFollowers = mysqli_query($connection, "INSERT INTO followers_$toFollowUsername(follower_id,follower_username,follower_profile) values('$userid','$username','$profile');");
} else if ($status === 'unfollow') {
    $removeFromFollowing = mysqli_query($connection, "DELETE FROM following_$username WHERE following_id='$toFollowId' AND following_username='$toFollowUsername' AND following_profile='$toFollowProfile'");
    $removeFromFollowers = mysqli_query($connection, "DELETE FROM followers_$toFollowUsername WHERE follower_id='$userid' AND follower_username='$username' AND follower_profile='$profile'");
}

?>