<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Picpi | Home</title>
</head>

<body>
    <a href="newpost">Create new post</a>
    <?php
    include './connection.php';
    $query = mysqli_query($connection, 'SELECT * FROM posts');
    while ($list($time, $username, $profile, $caption, $image)) {
    ?>
        <div>
            <p><?= $time ?></p>
            <p><?= $username ?></p>
            <img src='<?= $profile ?>'>
            <img src='<?= $image ?>'>
            <p><?= $caption ?></p>
        </div>
    <?php
    }
    ?>
</body>

</html>