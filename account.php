<?php
include './connection.php';
$userid = $_GET['userid'];
$getuser = mysqli_query($connection, "SELECT * FROM users WHERE user_id='$userid'");
list($userid, $firstName, $lastName, $telephone, $profile, $gender, $nationality, $username, $email,, $role) = mysqli_fetch_array($getuser)
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link type="text/css" href="global.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <script src="global.js" defer></script>
    <title><?= $username ?> | PicPi</title>
    <link rel="shortcut icon" href="picpi.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kurale&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="w-screen h-[80vh] flex flex-col items-center overflow-hidden">
    <div class="navbar shadow-2xl p-2 w-full h-12  flex items-center justify-around">
        <div class="flex items-center justify-center">
            <img class="w-8 h-8" src="picpi.png" alt="">
            <p class="picpi">PicPi</p>
        </div>
        <ul class="flex flex-row items-center justify-center list-none">
            <li class="mr-4 cursor-pointer"><a href="home.php?userid=<?= $userid ?>"> Home</a></li>
            <li class="mr-4 cursor-pointer"><a href="account.php?userid=<?= $userid ?>"> Account</a></li>
            <li class="mr-4 cursor-pointer"><a href="newpost.php?userid=<?= $userid ?>"> New post</a></li>
            <li class="mr-4 cursor-pointer"><a href="login.html"> <button class="hover:bg-red-600 p-1 hover:text-white rounded-sm">Logout</button></a></li>
        </ul>
        <ul class="flex flex-row items-center justify-center list-none">
            <li class="mr-4 cursor-pointer"><a href="account.php?userid=<?= $userid ?>"><?= $firstName . " " . $lastName ?></a></li>
            <li class="mr-4 cursor-pointer"><a href="account.php?userid=<?= $userid ?>"><img src="<?= $profile ?>" class="object-cover w-10 h-10 rounded-full" alt=""></a></li>
        </ul>
    </div>
    <div class="flex border-box p-2 items-center bg-gray-200 rounded-xl mt-4 w-2/3 justify-center h-1/2">
        <div class="w-2/3 flex items-center justify-center">
            <img class="object-cover w-48 h-48 rounded-full" src="<?= $profile ?>" alt="">
        </div>
        <form class="flex flex-col items-center justify-center w-3/5">
            <div class="flex w-10/12 items-center justify-between">
                <label>Names: </label>
                <input type="text" disabled class="bg-transparent" value='<?= $firstName . " " . $lastName ?>'>
            </div>
            <div class="flex w-10/12 items-center justify-between">
                <label>Username: </label>
                <input type="text" disabled class="bg-transparent" value='<?= $username ?>'>
            </div>
            <div class="flex w-10/12 items-center justify-between ">
                <label>Country: </label>
                <input type="text" disabled class="bg-transparent" value='<?= $nationality ?>'>
            </div>
            <div class="flex w-10/12 items-center justify-between ">
                <label>Telephone: </label>
                <input type="text" disabled class="bg-transparent" value='<?= $telephone ?>'>
            </div>
            <div class="flex w-10/12 items-center justify-between ">
                <label>Gender: </label>
                <input type="text" disabled class="bg-transparent" value='<?= $gender ?>'>
            </div>
            <div class="flex w-10/12 items-center justify-between ">
                <label>Email: </label>
                <input type="text" disabled class="bg-transparent" value='<?= $email ?>'>
            </div>
        </form>
    </div>
    <h2>Your posts</h2>
    <div class="grid border-box  p-4 grid-cols-3 bg-gray-200 mt-2 rounded-xl w-7/12 h-fit overflow-y-scroll">
        <?php
        $getUserPosts = mysqli_query($connection, "SELECT u.user_id,u.username,p.post_id,p.image,p.caption FROM users u INNER JOIN posts p ON u.username=p.username WHERE u.user_id='$userid'");
        while (list($posterid,, $postid, $image, $caption) = mysqli_fetch_array($getUserPosts)) {
        ?>
            <a class="m-2 h-auto" href="post.php?postid=<?= $postid ?>?posterid=<?= $posterid ?>?userid=?<?= $userid ?>"><img key='<?= $postid ?>' class="object-cover rounded w-48 h-32" src="<?= $image ?>"></a>

        <?php
        }
        ?>
    </div>
</body>

</html>
