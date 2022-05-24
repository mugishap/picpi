<?php
include './connection.php';
if (isset($_POST['submit'])) {
echo "Hello";
    $name = $_POST['name'];
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Search | <?= $name ?></title>
    </head>

    <body>
        <?php

        $getUsers = mysqli_query($connection, "SELECT u.user_id,u.username,u.nationality,u.email,u.telephone FROM users u WHERE u.username like '%$name%' OR u.firstname like '%$name%' OR u.lastname='%$name%'") or die("Error occured in deleting user" . mysqli_error($connection));

        if (mysqli_num_rows($getUsers) < 1) {
        ?>
            <div>No users found with that username or name</div>
        <?php
        } else {
            while (list($user_id, $username, $nationality, $email, $telephone) = mysqli_fetch_array($getUsers))
        ?><a href='user.php?username="<?= $username ?>"'>
                <div>
                    <?= $username ?>
                </div>
            </a>
    <?php
        }
    }
    ?>
    </body>

    </html>
    <div class="main">