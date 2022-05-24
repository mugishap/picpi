<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


    <link type="text/css" href="global.css" rel="stylesheet">
    <title>Home | PicPi</title>
    <link rel="shortcut icon" href="picpi.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kurale&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col items-center">
    <?php
    include './connection.php';
    $userid = $_GET['userid'];
    $today = date("Y-m-d");
    $query = mysqli_query($connection, 'SELECT * FROM posts ORDER BY post_id DESC');
    $getuser = mysqli_query($connection, "SELECT * FROM users WHERE user_id='$userid'");
    list($userid, $firstName, $lastName, $telephone, $profile, $gender, $nationality, $username, $email,, $role) = mysqli_fetch_array($getuser)
    ?>
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
    <a href="newpost.php?userid=<?= $userid ?>">Create new post</a>
    <?php
    while (list($postid, $time, $username, $profile, $caption, $image) = mysqli_fetch_array($query)) {
        if ($today === $time) {
            $time = 'Today';
        }
    ?>

        <div class="bg-[#eeeeee] rounded-xl m-1 w-4/12 h-[90vh] p-3">
            <div class="flex w-full items-center justify-start">
                <img class="object-cover m-2 w-10 h-10 rounded-full  " src='<?= $profile ?>'>
                <a href="user.php?username=<?= $username ?>"><?= $username ?></a>
            </div>
            <img class=" object-cover rounded-xl mb-1 mt-1 h-4/5 w-full" src='<?= $image ?>'>
            <p class="text-gray-500 mt-2"><?= $time ?></p>
            <p><?= $caption ?></p>
        </div>
    <?php
    }
    ?>
</body>

</html>