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
    <a class="mb-8" href="newpost.php?userid=<?= $userid ?>"><button class="text-white rounded bg-blue-500 p-2 w-48 hover:bg-blue-600">Create new post</button></a>
    <?php
    while (list($postid, $time, $username, $profile, $caption, $image) = mysqli_fetch_array($query)) {
        if ($today === $time) {
            $time = 'Today';
        }
    ?>

        <div class="neumorphism rounded-xl m-1 w-4/12 h-fit p-3">
            <div class="flex w-full items-center justify-start">
                <img class="object-cover m-2 w-10 h-10 rounded-full  " src='<?= $profile ?>'>
                <a href="user.php?username=<?= $username ?>"><?= $username ?></a>
            </div>
            <img class=" object-cover rounded-xl mb-1 mt-1 h-[70vh] w-full" src='<?= $image ?>'>
            <p class="text-gray-500 mt-2"><?= $time ?></p>
            <p><?= $caption ?></p>
            <div class="w-full mt-3 mb-3 flex items-center justify-around">
                <i class='bx bx-sm bx-like w-1/2 h-full rounded hover:bg-blue-200 text-center box-border p-2 cursor-pointer'></i>
                <i class='bx bx-sm bx-dislike w-1/2 h-full rounded hover:bg-red-200 text-center box-border p-2 cursor-pointer'></i>
            </div>
            <form action="" method="POST" class="w-full">
                <input type="text" name="comment-text" class="w-3/5 bg-gray-300 rounded p-2" placeholder="Comment here">
                <button type="submit" name='comment' class="2/5 rounded bg-blue-500 hover:bg-blue-600 text-white p-2 w-32">Send</button>
            </form>
        </div>
    <?php
    }
    if (isset($_POST['comment'])) {
        $comment = $_POST['comment-text'];
        $getComments = mysqli_query($connection, "SELECT COUNT(c.comment_id) FROM comments c WHERE post_id=$postid");
        list($commentcount) = mysqli_fetch_array($getComments);
        $addComment = mysqli_query($connection, "INSERT INTO comments(post_id,commenter_id,commenterusername,comment) VALUES($postid,$userid,'$username,'$comment')");
    }
    if (isset($_POST['like'])) {
        $like = $_POST['like'];
        $addLike = mysqli_query($connection, "INSERT INTO comments(post_id,commenter_id,commenterusername,comment) VALUES($postid,$userid,'$username,'$comment')");
        $getLikes = mysqli_query($connection, "SELECT * FROM comments");
    }
    if (isset($_POST['dislike'])) {
        $dislike = $_POST['dislike'];
        $addComment = mysqli_query($connection, "INSERT INTO comments(post_id,commenter_id,commenterusername,comment) VALUES($postid,$userid,'$username,'$comment')");
        $getComments = mysqli_query($connection, "SELECT * FROM comments");
    }
    ?>
</body>

</html>