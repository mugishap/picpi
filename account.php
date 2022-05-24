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
    <title><?= $username ?> | PicPi</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="w-screen h-[80vh] flex flex-col items-center">
    <div class="navbar w-full h-10 flex items-center justify-around mb-12">
        <ul class="flex flex-row items-center justify-center list-none">
            <li class="mr-4 cursor-pointer"><a href="home.php?userid=<?= $userid ?>"> Home</a></li>
            <li class="mr-4 cursor-pointer"><a href="account.php?userid=<?= $userid ?>"> Account</a></li>
            <li class="mr-4 cursor-pointer"><a href="newpost.php?userid=<?= $userid ?>"> New post</a></li>
            <li class="mr-4 cursor-pointer"><a href="login.html"> <button>Logout</button></a></li>
        </ul>
        <ul class="flex flex-row items-center justify-center list-none">
            <li class="mr-4 cursor-pointer"><a href="account.php?userid=<?= $userid ?>"><?= $firstName . " " . $lastName ?></a></li>
            <li class="mr-4 cursor-pointer"><a href="account.php?userid=<?= $userid ?>"><img src="<?= $profile ?>" class="w-10 h-10 rounded-full" alt=""></a></li>
        </ul>
    </div>
    <div class="flex border-box p-2 items-center bg-gray-200 rounded-xl w-2/3 justify-center h-1/2">
        <div class="w-2/3 flex items-center justify-center">
            <img class="w-48 h-48 rounded-full" src="<?= $profile ?>" alt="">
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
</body>

</html>