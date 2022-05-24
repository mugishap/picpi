<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | PicPi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col items-center">
    <?php
    include './connection.php';
    $userid = $_GET['userid'];
    $today = date("Y-m-d");
    $query = mysqli_query($connection, 'SELECT * FROM posts');
    $getuser = mysqli_query($connection, "SELECT * FROM users WHERE user_id='$userid'");
    list($userid, $firstName, $lastName, $telephone, $profile, $gender, $nationality, $username, $email,, $role) = mysqli_fetch_array($getuser)
    ?>
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
    <a href="newpost.php?userid=<?= $userid ?>">Create new post</a>
    <?php
    while (list($postid, $time, $username, $profile, $caption, $image) = mysqli_fetch_array($query)) {
        if ($today === $time) {
            $time = 'Today';
        }
    ?>

        <div class="bg-gray-300 rounded-xl m-1 w-4/12 h-[90vh] p-3">
            <div class="flex w-full items-center justify-start">
                <img class=" w-10 h-10 rounded-full  " src='<?= $profile ?>'>
                <p><?= $username ?></p>
            </div>
            <img class="rounded-xl mb-1 mt-1 h-4/5 w-full" src='<?= $image ?>'>
            <p class="text-gray-500 mt-2"><?= $time ?></p>
            <p><?= $caption ?></p>
        </div>
    <?php
    }
    ?>
</body>

</html>