<?php
include './connection.php';
include './checkloggedin.php';
$getFollowersCount  = mysqli_query($connection, "SELECT COUNT(follow_id) from followers_$username");
$getFollowingCount = mysqli_query($connection, "SELECT COUNT(follow_id) from following_$username");
if (!$getFollowersCount || $getFollowingCount) {
    $followercount = "Error";
    $followingcount = "Error";
    // return;
}
list($followercount) = mysqli_fetch_array($getFollowersCount);
list($followingcount) = mysqli_fetch_array($getFollowingCount);

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

    <title><?= $username ?> | PicPi</title>
    <link rel="shortcut icon" href="picpi.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kurale&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <script>
        console.log("%cLOADED THE ACCOUNT PAGE", "font-size:3em;color:green;")
        const popup = (src, postid, type) => {
            const overlay = document.querySelector('.theoverlay')
            overlay.style.display = 'flex'
            if (type === 'image') {
                const post = document.querySelector('.post')
                overlay.innerHTML = `<i class="material-icons cursor-pointer" style="font-size:2em;" onclick="removepopup()">close</i>
                <div class="flex flex-col items-center h-5/12 justify-center p-2 bg-white rounded w-5/12">
                <a class="w-full flex items-center justify-center" href="home.php#${postid}">
                <button type="button" class="text-white bg-blue-500 rounded p-1 w-10/12 m-2 hover:bg-blue-600">
                View full post
                </button>
                </a>
                <form method='POST' action="?postid=${postid}" class='w-full flex items-center justify-center'>
                <button type="submit" name='deletepost' class="text-white bg-red-500 rounded p-1 w-10/12 m-2 hover:bg-red-600">
                Delete post
                    </button>
                </form>            
                <img class="w-full h-10/12" src="${src}" alt="" />
                </div>`
            } else if (type === 'video') {
                const post = document.querySelector('.post')
                overlay.innerHTML = `<i class="material-icons cursor-pointer" style="font-size:2em;" onclick="removepopup()">close</i>
                <div class="flex flex-col items-center h-5/12 justify-center p-2 bg-white rounded w-5/12">
                <a class="w-full flex items-center justify-center" href="home.php#${postid}">
                <button type="button" class="text-white bg-blue-500 rounded p-1 w-10/12 m-2 hover:bg-blue-600">
                View full post
                </button>
                </a>
                <form method='POST' action="?postid=${postid}" class='w-full flex items-center justify-center'>
                <button type="submit" name='deletepost' class="text-white bg-red-500 rounded p-1 w-10/12 m-2 hover:bg-red-600">
                Delete post
                    </button>
                </form>            
                <video loop autoplay controls class="w-full h-10/12" src="${src}"></video>
                </div>`
            }
        }
        const removepopup = () => {
            const overlay = document.querySelector('.theoverlay')
            overlay.innerHTML = ''
            overlay.style.display = 'none'
        }
        const toggleList = () => {
            if (document.documentElement.clientWidth < 654) {
                const navel = `
`
            }
        }
    </script>
</head>

<body class="w-screen h-[80vh] flex flex-col items-center overflow-hidden">
    <div class="navbar shadow-2xl mb-8 p-4 w-full h-12  flex items-center justify-around">
        <div class="flex items-center justify-center">
            <img class="w-8 h-8" src="picpi.png" alt="">
            <a href='home.php' class="picpi">PicPi</a>
        </div>
        <div>
            <form action="search.php" method='POST' class="flex items-center justify-center">
                <input required type="text" name='name' class="p-1 bg-[#ddd] rounded" placeholder="Search">
                <button type="submit" name="search" class="btn btn-outline-primary material-icons text-md">search</button>
            </form>
        </div>
        <ul class="flex flex-row items-center justify-center list-none">
            <li class="mr-4 cursor-pointer"><a title="Home" class="bx bx-home-alt bx-sm" href="home.php"></a></li>

            <li class="mr-4 cursor-pointer"><a title="Explore" class="bx bx-compass bx-sm" href="explore.php"></a></li>
            <li class="mr-4 cursor-pointer"><a title="New post" class="bx bx-add-to-queue bx-sm" href="newpost.php"></a></li>
            <li class="mr-4 cursor-pointer"><i class='bx bx-bell bx-sm'></i></li>
            <li class="mr-4 cursor-pointer">
                <form action="" method="GET"><button title="Logout" class="material-icons" name="logout" type="submit">logout</button></form>
            </li>
            <li class="mr-4 cursor-pointer"><a href="account.php"><img src="<?= $profile ?>" class="object-cover w-10 h-10 rounded-full" alt=""></a></li>
        </ul>
    </div>
    <div class="theoverlay flex-col w-screen absolute z-100 bg-[#00000057] h-screen items-center justify-center " style="display: none;">

    </div>
    <div class="neumorphism flex flex-col border-box p-2 items-center nuemorphism rounded-xl mb-4 mt-4 w-2/3 justify-center h-1/2">
        <div class="acc-holder md:flex-row flex items-center w-full flex-col justify-around h-full">
            <img class="object-cover w-32 h-32 rounded-full" src="<?= $profile ?>" alt="">
            <form class="flex flex-col items-center justify-center w-full md:w-3/5">
                <div class="flex w-full items-center justify-between">
                    <label class="w-2/5">Names: </label>
                    <input type="text" disabled class="w-3/5 bg-transparent" value='<?= $firstname . " " . $lastname ?>'>
                </div>
                <div class="flex w-full items-center justify-between">
                    <label class="w-2/5">Username: </label>
                    <input type="text" disabled class="w-3/5 bg-transparent" value='<?= $username ?>'>
                </div>
                <div class="flex w-full items-center justify-between ">
                    <label class="w-2/5">Country: </label>
                    <input type="text" disabled class="w-3/5 bg-transparent" value='<?= $nationality ?>'>
                </div>
                <div class="flex w-full items-center justify-between ">
                    <label class="w-2/5">Telephone: </label>
                    <input type="text" disabled class="w-3/5 bg-transparent" value='<?= $telephone ?>'>
                </div>
                <div class="flex w-full items-center justify-between ">
                    <label class="w-2/5">Gender: </label>
                    <input type="text" disabled class="w-3/5 bg-transparent" value='<?= $gender ?>'>
                </div>
                <div class="flex w-full items-center justify-between ">
                    <label class="w-2/5">Email: </label>
                    <input type="text" disabled class="w-3/5 bg-transparent" value='<?= $email ?>'>
                </div>
            </form>
        </div>
        <div class="follow-data flex items-center justify-around w-2/5 m-2">
            <div class="w-1/2 flex items-center flex-col justify-center">
                <a class="font-bold text-xl" href="followdata.php?username=<?= $username ?>">Followers</a>
                <p class="text-xl"><?= $followercount ?></p>
            </div>
            <div class="w-1/2 flex items-center flex-col justify-center">
                <a class="font-bold text-xl" href="followdata.php?username=<?= $username ?>">Following</a>
                <p class="text-xl"><?= $followingcount ?></p>
            </div>
        </div>
        <div>
            <a href="edituser.php"><button class="w-48 h-8 m-1 text-white bg-blue-500 hover:bg-blue-600 rounded">Update Profile</button></a>
            <a href="changepassword.php"><button class=" m-1 change-password-btn w-48 h-8 text-white hover:bg-orange-400 rounded">Change Password</button></a>
            <a href="processdelete.php"><button class="m-1 w-48 h-8 text-white bg-red-400 hover:bg-red-600 rounded">Delete Account</button></a>
        </div>
    </div>
    <h2>Your posts</h2>
    <a class="" href="newpost.php"><button class="text-white rounded bg-blue-500 p-2 w-48 hover:bg-blue-600">Create a post</button></a>
    <div class="grid border-box  p-4 grid-cols-2 md:grid-cols-3 neumorphism mt-2 rounded-xl w-7/12 h-fit overflow-y-scroll">
        <?php
        $getUserPosts = mysqli_query($connection, "SELECT u.user_id,u.username,p.post_id,p.time,p.image,p.caption,p.type FROM users u INNER JOIN posts p ON u.username=p.username WHERE u.user_id='$userid' ORDER BY p.post_id DESC");
        if (mysqli_num_rows($getUserPosts) < 1) {
        ?>
            <p>You have no posts</p>
            <?php
        } else {
            while (list($posterid,, $postid, $posttime, $media, $caption, $type) = mysqli_fetch_array($getUserPosts)) {
                if ($type == "image") {
            ?>
                    <img key='<?= $postid ?>' onclick="popup('<?= $media ?>','<?= $postid ?>','<?= $type ?>')" class="selector m-1 cursor-pointer object-cover rounded w-48 h-32" src="<?= $media ?>" alt="<?= $username ?>'s post on <?= $posttime ?>">

                <?php
                } else if ($type == "video") {
                ?>
                    <video key='<?= $postid ?>' onclick="popup('<?= $media ?>','<?= $postid ?>','<?= $type ?>')" class="selector m-1 cursor-pointer object-cover rounded w-48 h-32" src="<?= $media ?>" alt="<?= $username ?>'s post on <?= $posttime ?>">
                    </video>
            <?php
                }
            }
        }
        if (isset($_GET['logout'])) {
            setcookie("PICPI-USERID", "", time() - 3600);
            ?>
            <script>
                window.location.replace('/php-crud/login.html')
            </script>
            <?php
        }
        if (isset($_POST['deletepost'])) {
            $postid = $_GET['postid'];
            $deletePostQuery = "DELETE FROM posts WHERE post_id='$postid'";
            $performDeleteQuery = mysqli_query($connection, $deletePostQuery);
            if ($performDeleteQuery) {
            ?>
                <script>
                    window.location.replace('/php-crud/home.php')
                </script>

        <?php
            } else {
                return;
            }
        }
        ?>
    </div>
</body>

</html>