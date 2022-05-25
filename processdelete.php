    <?php

    include './connection.php';
    $DB_name = "formdb";
    $userid = $_GET['userid'];
    $deleteQuery = "DELETE FROM users WHERE user_id=$userid";
    $delete = mysqli_query($connection, $deleteQuery) or die("Error occured in deleting user" . mysqli_error($connection));
    if ($delete) {
    ?>
        <script>
            window.location.replace('/PHP-Crud/myapp/signup.php')
        </script>
    <?php
    }
    ?>