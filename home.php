<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link type="text/css" href="global.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    <title>Home | PicPi</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <link rel="shortcut icon" href="picpi.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kurale&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer>
        const liking = (e) => {
            const classes = e.classList
            classes.contains('bx-like') ?
                e.classList.replace('bx-like', 'bxs-like') :
                e.classList.replace('bxs-like', 'bx-like')
        }
    </script>
</head>

<body class="flex flex-col items-center">
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
    $today = date("Y-m-d");
    $query = mysqli_query($connection, 'SELECT * FROM posts ORDER BY post_id DESC');
    $getuser = mysqli_query($connection, "SELECT * FROM users WHERE user_id='$userid'");
    list($userid, $firstName, $lastName, $telephone, $profile, $gender, $nationality, $username, $email,, $role) = mysqli_fetch_array($getuser)
    ?>
    <div class="navbar bg-white fixed z-10 shadow-2xl mb-8 p-2 w-full h-12  flex items-center justify-around">
        <div class="flex items-center justify-center">
            <img class="w-8 h-8" src="picpi.png" alt="">
            <a href='home.php?userid=<?= $userid ?>' class="picpi">PicPi</a>
        </div>
        <div>
            <form method="POST" action="search.php?userid=<?= $userid ?>" class="flex items-center justify-center">
                <input type="text" name='name' class="p-1 bg-[#ddd] rounded" placeholder="Search">
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
    <a class="mt-24 mb-8" href="newpost.php?userid=<?= $userid ?>"><button class="text-white rounded bg-blue-500 p-2 w-48 hover:bg-blue-600">Create new post</button></a>
    <?php

    while (list($postid, $time, $posterusername, $posterprofile, $caption, $image) = mysqli_fetch_array($query)) {
        $getComments = mysqli_query($connection, "SELECT c.comment_id,c.time,c.commenterusername,c.comment,u.profile FROM comments c INNER JOIN users u ON u.username=c.commenterusername  WHERE post_id=$postid ORDER BY c.comment_id DESC");
        if ($today === $time) {
            $time = 'Today';
        }
    ?>

        <div id="post<?=$postid?>" key='<?= $postid ?>' class="neumorphism rounded-xl m-1 w-4/12 h-fit p-3">
            <div class="flex w-full items-center justify-start">
                <img class="object-cover m-2 w-10 h-10 rounded-full  " src='<?= $posterprofile ?>'>
                <a href="user.php?username=<?= $posterusername ?>&userid=<?=$userid?>"><?= $posterusername ?></a>
            </div>
            <img class=" object-cover rounded-xl mb-1 mt-1 h-[70vh] w-full" src='<?= $image ?>'>
            <p class="text-gray-500 mt-2"><?= $time ?></p>
            <p><?= $caption ?></p>
            <div class="w-full mt-3 mb-3 flex items-center justify-around">
                <i onclick="liking(this)" class='bx bx-sm bx-like w-1/2 h-full rounded hover:bg-blue-200 text-center box-border p-2 cursor-pointer'></i>
            </div>
            <form action="?postid=<?= $postid ?>&userid=<?= $userid ?>&username='<?= $username ?>'" method="POST" class="w-full">
                <input required type="text" name="comment-text" class="w-3/5 bg-gray-300 rounded p-2" placeholder="Comment here">
                <button type="submit" name='comment' class="2/5 rounded bg-blue-500 hover:bg-blue-600 text-white p-2 w-32">Send</button>
            </form>
            <div>
                <?php
                while (list($commentid,$commenttime, $commenterusername, $commenttext,$commenterprofile) = mysqli_fetch_array($getComments)) {
                ?>
                    <div class="w-10/12 relative flex items-center justify-around  rounded m-2 box-border" >
                        <div class="w-16 h-16 rounded-full neumorphism flex items-center justify-center">
                        <img class="w-12 h-12 rounded-full object-cover" src="<?=$commenterprofile?>" alt="">
                        </div>
                        <div class="w-2/3 neumorphism rounded text-sm flex flex-col items-start justify-center p-1">
                            <a href="user.php?username=<?=$commenterusername?>&userid=<?=$userid?>"><?= $commenterusername ?></a>
                            <p><?= $commenttext ?></p>
                            <p class="text-xs text-gray-600"><?= $commenttime ?></p>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
        <?php
    }
    if (isset($_POST['comment'])) {
        $comment = $_POST['comment-text'];
        if ($comment === '') {
        ?>
            <script>
                swal('Error', 'You should add a comment', 'error', {
                    buttons: false,
                    timer: 1500
                })
            </script>
    <?php
        }
        echo $postid;
        $postid = $_GET['postid'];
        $username = $_GET['username'];
        $commentQuery = "INSERT INTO comments(post_id,commenter_id,commenterusername,comment) VALUES($postid,$userid,$username,'$comment')";
        // echo $quf;
        $addComment = mysqli_query($connection, $commentQuery) or die(mysqli_error($connection));
        if($addComment){
            ?>
            <script>
                window.location.replace('/myapp/PHP-Crud/home.php?userid=<?=$userid?>#post<?=$postid?>' )
            </script>
            <?php
        }
    }

    ?>
</body>

</html>