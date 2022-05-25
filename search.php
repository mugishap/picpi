<?php
include './connection.php';
if (isset($_GET['search'])) {
    $name = $_GET['name'];
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Search | <?= $name ?></title>
        <link rel="shortcut icon" href="picpi.png" type="image/x-icon">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Kurale&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body>
        <div class="navbar shadow-2xl mb-8 p-2 w-full h-12  flex items-center justify-around">
            <div class="flex items-center justify-center">
                <img class="w-8 h-8" src="picpi.png" alt="">
                <a href='home.php?userid=<?= $userid ?>' class="picpi">PicPi</a>
            </div>
            <div>
                <form method="POST" action="search.php" class="flex items-center justify-center">
                    <input type="text" name='name' class="p-1 bg-[#f0f0f0] rounded" placeholder="Search">
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
        echo "Welcome";
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