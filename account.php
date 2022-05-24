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

    <title><?= $username ?> | PicPi</title>
    <link rel="shortcut icon" href="picpi.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kurale&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        const popup = (src) => {
            const overlay = document.querySelector('.theoverlay')
            overlay.style.display = 'flex'
            overlay.innerHTML = '<i class="material-icons cursor-pointer" onclick="removepopup()">close</i>'

            const div = document.createElement('div')
            div.classList.add('white')

            const image = document.createElement('img')
            image.classList.add('image')
            image.src = src

            div.appendChild(image)
            overlay.appendChild(div)
            const username = document.createTextNode('<?=$username?>')
            div.appendChild(username)
        }
        const removepopup = () => {
            const overlay = document.querySelector('.theoverlay')
            overlay.innerHTML = ''
            overlay.style.display = 'none'
        }
    </script>
</head>

<body class="w-screen h-[80vh] flex flex-col items-center overflow-hidden">
    <div class="navbar shadow-2xl mb-8 p-2 w-full h-12  flex items-center justify-around">
        <div class="flex items-center justify-center">
            <img class="w-8 h-8" src="picpi.png" alt="">
            <a href='home.php?userid=<?= $userid ?>' class="picpi">PicPi</a>
        </div>
        <div>
            <form action="search.php" class="flex items-center justify-center">
                <input type="text" name='name' class="p-1 bg-[#ddd] rounded" placeholder="Search">
                <button type="submit" name="submit" class="btn btn-outline-primary material-icons text-md">search</button>
            </form>
        </div>
        <ul class="flex flex-row items-center justify-center list-none">
            <li class="mr-4 cursor-pointer"><a title="Home" class="bx bx-home-alt bx-sm" href="home.php?userid=<?= $userid ?>"></a></li>
            <li class="mr-4 cursor-pointer"><a title="New post" class="bx bx-add-to-queue bx-sm" href="newpost.php?userid=<?= $userid ?>"></a></li>
            <li class="mr-4 cursor-pointer"><a title="Logout" class="material-icons" href="login.html">logout</a></li>
            <li class="mr-4 cursor-pointer"><a href="account.php?userid=<?= $userid ?>"><img src="<?= $profile ?>" class="object-cover w-10 h-10 rounded-full" alt=""></a></li>
        </ul>
    </div>
    <div class="theoverlay flex-col w-screen absolute items-center z-100 bg-[#00000057] h-screen items-center justify-center " style="display: none;">

    </div>
    <div class="flex flex-col border-box p-2 items-center bg-gray-200 rounded-xl mt-4 w-2/3 justify-center h-1/2">
        <div class="flex items-center w-full justify-center h-full">
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
        <a href="edituser.php?userid=<?= $userid ?>"><button class="w-48 h-8 text-white bg-blue-500 hover:bg-blue-600 rounded">Update Profile</button></a>
    </div>
    <h2>Your posts</h2>
    <div class="grid border-box  p-4 grid-cols-3 bg-gray-200 mt-2 rounded-xl w-7/12 h-fit overflow-y-scroll">
        <?php
        $getUserPosts = mysqli_query($connection, "SELECT u.user_id,u.username,p.post_id,p.image,p.caption FROM users u INNER JOIN posts p ON u.username=p.username WHERE u.user_id='$userid'");
        if (mysqli_num_rows($getUserPosts) < 1) {
        ?>
            <div class="flex h-full w-full flex-col items-center justify-center">
                <p class="mb-2">Add a post</p>
                <a title="Add a post" href="newpost.php?userid=<?= $userid ?>" class='w-16 h-16 flex items-center justify-center text-blue-500 p-10 rounded-full border-2 border-blue-500'>
                    <i class='bx bxs-camera-plus bx-md'></i>
                </a>
            </div>
            <?php
        } else {
            while (list($posterid,, $postid, $image, $caption) = mysqli_fetch_array($getUserPosts)) {
            ?>
                <img key='<?= $postid ?>' onclick="popup('<?= $image ?>','flex')" class="m-1 cursor-pointer object-cover rounded w-48 h-32" src="<?= $image ?>">

        <?php
            }
        }
        ?>
    </div>
</body>

</html>