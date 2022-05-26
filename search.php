<?php
include './connection.php';
$userid = $_GET['userid'];
    if (!$userid || $userid == '') {
    ?>
        <script>
            window.location.replace('/myapp/PHP-Crud/login.html')
        </script>
    <?php
        return;
    }
    $getIds = mysqli_query($connection, "SELECT user_id FROM users WHERE user_id='$userid'");
    if (mysqli_num_rows($getIds) != 1) {
    ?>
        <script>
            window.location.replace('/myapp/PHP-Crud/login.html')
        </script>
        <?php
        return;
    }
$getuser = mysqli_query($connection, "SELECT * FROM users WHERE user_id='$userid'");
if (mysqli_num_rows($getuser) === 0) {
    echo "Error in getting your credentials...";
    return;
} else {
    list($userid, $firstName, $lastName, $telephone, $profile, $gender, $nationality, $username, $email,, $role) = mysqli_fetch_array($getuser);
}
if (isset($_POST['search'])) {
    $name = $_POST['name'];
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Search | <?= $name ?></title>
        <link rel="shortcut icon" href="picpi.png" type="image/x-icon">

        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link type="text/css" href="global.css" rel="stylesheet">
<link type="text/css" href="tailwind.css" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Kurale&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
         <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    </head>

    <body class="flex flex-col items-center justify-center">
        <div class="navbar shadow-2xl mb-8 p-2 w-full h-12  flex items-center justify-around">
            <div class="flex items-center justify-center">
                <img class="w-8 h-8" src="picpi.png" alt="">
                <a href='home.php?userid=<?= $userid ?>' class="picpi">PicPi</a>
            </div>
            <div>
                <form method="POST" action="search.php?userid=<?= $userid ?>" class="flex items-center justify-center">
                    <input required type="text" name='name' class="p-1 bg-[#ddd] rounded" placeholder="Search">
                    <button type="submit" name="search" class="btn btn-outline-primary material-icons text-md">search</button>
                </form>
            </div>
            <ul class="flex flex-row items-center justify-center list-none">
                <li class="mr-4 cursor-pointer"><a title="Home" class="bx bx-home-alt bx-sm" href="home.php?userid=<?= $userid ?>"></a></li>
                <li class="mr-4 cursor-pointer"><a title="New post" class="bx bx-add-to-queue bx-sm" href="newpost.php?userid=<?= $userid ?>"></a></li>
                <li class="mr-4 cursor-pointer"><a title="Logout" class="material-icons" href="login.html">logout</a></li>
                <li class="mr-4 cursor-pointer"><a href="account.php?userid=<?= $userid ?>"><img src="<?= $profile ?>" class="object-cover w-10 h-10 rounded-full" alt=""></a></li>
            </ul>
        </div>
        <?php
        $getUsers = mysqli_query($connection, "SELECT user_id,username,profile,nationality,email,telephone FROM users WHERE username like '%$name%' OR firstname like '%$name%' OR lastname='%$name%'");
        if (mysqli_num_rows($getUsers) == 0) {
        ?>
            <div class="overflow-y-scroll">No users found with that username or name</div>
            <?php
        } else {
            echo "Found " .  mysqli_num_rows($getUsers) . " users with $name";
            while (list($searcheduser_id, $searchedusername, $searchedprofile, $searchednationality, $searchedemail, $searchedtelephone) = mysqli_fetch_array($getUsers)) {
            ?><a class="w-2/5 h-32 m-4" href='user.php?username=<?= $username ?>'>
                    <div class="w-full rounded neumorphism items-center box-border p-3 flex h-full">
                        <div class="neumorphism bg-[#ddd] rounded-full p-2 ml-4 mr-24">
                        <img class="object-cover rounded-full w-24 h-24 searched-image" src="<?= $searchedprofile ?>" alt="<?= $username ?>'s image">
                        </div>
                        <div class="block">
                        <p><?= $searchedusername ?></p>
                        <p class="text-gray-500"><?= $searchedemail ?></p>
                        </div>
                    </div>
                </a>
    <?php
            }
        }
    }
    ?>
    </body>

    </html>
    <div class="main">