<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | PicPi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <?php
    include './connection.php';
    $userid = $_GET['userid'];

    $query = mysqli_query($connection, 'SELECT * FROM posts');
    ?>
    <a href="newpost.php?userid=<?= $userid ?>">Create new post</a>
    <?php
    while (list($time, $username, $profile, $caption, $image) = mysqli_fetch_array($query)) {
    ?>
        <div>
            <p><?= $time ?></p>
            <p><?= $username ?></p>
            <img class="w-10 h-10" src='<?= $profile ?>'>
            <img src='<?= $image ?>'>
            <p><?= $caption ?></p>
        </div>
    <?php
    }
    ?>
</body>

</html>