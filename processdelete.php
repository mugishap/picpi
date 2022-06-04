    <?php

    include './connection.php';
    include './checkloggedin.php';
    $deleteQuery = "DELETE FROM users WHERE user_id='$userid'";
    
    $dropFollowersQuery = "DROP TABLE followers_".$username;
    $dropFollowersTable = mysqli_query($connection, $dropFollowersQuery) or die(mysqli_error($connection));

    $dropFollowingQuery = "DROP TABLE following_".$username;
    $dropFollowingTable = mysqli_query($connection, $dropFollowingQuery) or die(mysqli_error($connection));

    $dropActivityQuery = "DROP TABLE activity_".$username;
    $dropActivityTable = mysqli_query($connection, $dropActivityQuery) or die(mysqli_error($connection));

    $delete = mysqli_query($connection, $deleteQuery) or die("Error occured in deleting user" . mysqli_error($connection));
    if ($delete) {
        header("Location: ./signup.php");
    }
    ?>