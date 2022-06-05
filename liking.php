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
    $addToPosterActivity = mysqli_query($connection,"INSERT INTO activity_$posterusername(activity_comment,related) VALUES('$username liked your post','$post_id')");
    $addToLikerActivity = mysqli_query($connection,"INSERT INTO activity_$username(activity_comment,related) VALUES('You liked a post from $posterusername','$post_id')");
} else if ( $status === 'disliking' ) {
    $query1 =  "DELETE FROM likes WHERE (liker_id='$userid') AND (post_id='$post_id') AND (likerusername='$username')";
    $removeFromPosterActivity = mysqli_query($connection,"DELETE FROM activity_$posterusername WHERE (activity_comment='$username liked your post') AND (related='$post_id')");
    $removeFromLikerActivity = mysqli_query($connection,"DELETE FROM activity_$username WHERE (activity_comment='You liked a post from $posterusername') AND (related='$post_id')");
    $dislike = mysqli_query( $connection, $query1);
}
