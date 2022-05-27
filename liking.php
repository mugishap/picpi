<?php
include './connection.php';
$userid = $_GET[ 'userid' ];
if ( !$userid || $userid == '' ) {
    ?>
    <script>
    window.location.replace( '/php-crud/login.html' )
    </script>
    <?php
    return;
}
$getIds = mysqli_query( $connection, "SELECT user_id FROM users WHERE user_id='$userid'" );
if ( mysqli_num_rows( $getIds ) != 1 ) {
    ?>
    <script>
    window.location.replace( '/php-crud/login.html' )
    </script>
    <?php
    return;
}
$today = date( 'Y-m-d H:i' );
$query = mysqli_query( $connection, 'SELECT * FROM posts ORDER BY post_id DESC' );
$getuser = mysqli_query( $connection, "SELECT * FROM users WHERE user_id='$userid'" );
list( $userid, $firstname, $lastname, $telephone, $profile, $gender, $nationality, $username, $email, , $role ) = mysqli_fetch_array( $getuser );

$post_id = $_POST[ 'post_id' ];
$status =  $_POST[ 'status' ];
echo $status;
if ( $status === 'liking' ) {
    $like = mysqli_query( $connection, "INSERT INTO likes(liker_id,post_id,liker_profile,likerusername) VALUES('$userid','$post_id','$profile','$username')" );
} else if ( $status === 'disliking' ) {
    $query1 =  "DELETE FROM likes WHERE (liker_id='$userid') AND (post_id='$post_id') AND (likerusername='$username')";
    echo $query1;
    $dislike = mysqli_query( $connection, $query1);
}

?>
