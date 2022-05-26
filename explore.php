<?php
include './connection.php';
$userid = $_GET['userid'];
if (!$userid || $userid == '') {
?>
    <script>
        window.location.replace('/php-crud/login.html')
    </script>
<?php
    return;
}
$getIds = mysqli_query($connection, "SELECT user_id FROM users WHERE user_id='$userid'");
if (mysqli_num_rows($getIds) != 1) {
?>
    <script>
        window.location.replace('/php-crud/login.html')
    </script>
<?php
    return;
}
$getuser = mysqli_query($connection, "SELECT * FROM users WHERE user_id='$userid'");
list($userid, $firstname, $lastname, $telephone, $profile, $gender, $nationality, $username, $email,, $role) = mysqli_fetch_array($getuser)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link type="text/css" href="global.css" rel="stylesheet">
<link type="text/css" href="tailwind.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    <title>Explore | PicPi</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <link rel="shortcut icon" href="picpi.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kurale&family=Ubuntu:wght@300&display=swap" rel="stylesheet">

</head>

<body>
<div class="navbar shadow-2xl mb-8 p-2 w-full h-12  flex items-center justify-around">
        <div class="flex items-center justify-center">
            <img class="w-8 h-8" src="picpi.png" alt="">
            <a href='home.php?userid=<?= $userid ?>' class="picpi">PicPi</a>
        </div>
        <div>
            <form action="search.php?userid=<?= $userid ?>" method='POST' class="flex items-center justify-center">
                <input required type="text" name='name' class="p-1 bg-[#ddd] rounded" placeholder="Search">
                <button type="submit" name="search" class="btn btn-outline-primary material-icons text-md">search</button>
            </form>
        </div>
        <ul class="flex flex-row items-center justify-center list-none">
            <li class="mr-4 cursor-pointer"><a title="Home" class="bx bx-home-alt bx-sm" href="home.php?userid=<?= $userid ?>"></a></li>

            <li class="mr-4 cursor-pointer"><a title="Explore" class="bx bx-compass bx-sm" href="explore.php?userid=<?= $userid ?>"></a></li>
            <li class="mr-4 cursor-pointer"><a title="New post" class="bx bx-add-to-queue bx-sm" href="newpost.php?userid=<?= $userid ?>"></a></li>
            <li class="mr-4 cursor-pointer"><a title="Logout" class="material-icons" href="login.html">logout</a></li>
            <li class="mr-4 cursor-pointer"><a href="account.php?userid=<?= $userid ?>"><img src="<?= $profile ?>" class="object-cover w-10 h-10 rounded-full" alt=""></a></li>
        </ul>
    </div>
</body>
</html>