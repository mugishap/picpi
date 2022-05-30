    <?php

    include './connection.php';
    include './checkloggedin.php';
    $deleteQuery = "DELETE FROM users WHERE user_id='$userid'";
    $delete = mysqli_query($connection, $deleteQuery) or die("Error occured in deleting user" . mysqli_error($connection));
    if ($delete) {
        header("Location: ./signup.php");
    }
    ?>