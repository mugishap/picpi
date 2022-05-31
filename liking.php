<?php
include './connection.php';
include './checkloggedin.php';
$today = date( 'Y-m-d H:i' );
$query = mysqli_query( $connection, 'SELECT * FROM posts ORDER BY post_id DESC' );
$getuser = mysqli_query( $connection, "SELECT * FROM users WHERE user_id='$userid'" );
list( $userid, $firstname, $lastname, $telephone, $profile, $gender, $nationality, $username, $email, , $role ) = mysqli_fetch_array( $getuser );

$post_id = $_POST[ 'post_id' ];
$status =  $_POST[ 'status' ];
echo $status;
if ( $status === 'liking' ) {
    $like = mysqli_query( $connection, "INSERT INTO likes(liker_id,post_id,liker_profile,likerusername) VALUES('$userid','$post_id','$profile','$username')" );
    // $addToPosterActivity = mysqli_query($connection,"INSERT INTO activity_$posterusername()");
} else if ( $status === 'disliking' ) {
    $query1 =  "DELETE FROM likes WHERE (liker_id='$userid') AND (post_id='$post_id') AND (likerusername='$username')";
    echo $query1;
    $dislike = mysqli_query( $connection, $query1);
}
