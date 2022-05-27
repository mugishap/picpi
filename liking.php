<?php
$like = mysqli_query( $connection, "INSERT INTO likes(liker_id,post_id,liker_profile,likerusername) VALUES('$userid','','$profile','$username')" );
if ( !$like ) {
    ?>
    e.classList.replace( 'bxs-like', 'bx-like' )
    <?php
}
$dislike = mysqli_query( $connection, "DELETE FROM likes WHERE liker_id='$userid')" );
if ( !$dislike ) {
    ?>
    e.classList.replace( 'bxs-like', 'bx-like' )
    <?php
}

?>
