<!DOCTYPE html>
<html lang="en">
<?php

include './connection.php';
include './checkloggedin.php';
$postid = $_GET['postid'];
$sql = "SELECT post_id,caption,image FROM posts where post_id='$postid'";
$select  = mysqli_query($connection, $sql) or die(mysqli_error($connection));

$count = mysqli_num_rows($select);
if ($count != 1) {
    header("Location: ./home.php");
    return;
}
if (isset($_POST['updatepost'])) {
    $image = $_FILES['post-image']['name'];
    $image_tmp = $_FILES['post-image']['tmp_name'];
    $caption = $_POST['caption'];
    $directory = "uploads/";
    $postimage = $directory . basename($_FILES["post-image"]["name"]);
    $uploadStatus = 1;
    $imageFileType = strtolower(pathinfo($postimage, PATHINFO_EXTENSION));
    echo $postimage;
    if ($postimage === 'uploads/') {
        $updateQuery = "UPDATE posts SET caption='$caption' WHERE post_id='$postid'";
        $update =  mysqli_query($connection, $updateQuery) or die("Error occured in updating post" . mysqli_error($connection));
        if ($update) {
            header("Location: ./home.php");
        }
    } else {
        // echo "<br><br><br>br<br>br<br><br>br<br>";
        // echo "Hello";
        $check = getimagesize($_FILES["post-image"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image" . $check["mime"] . ".";
            $uploadStatus = 1;
        } else {
            echo "File is not an image";
            $uploadStatus = 0;
        }
        if ($uploadStatus == 0) {
            echo "Sorry, your image was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["post-image"]["tmp_name"], $postimage)) {
                echo "The image " . htmlspecialchars(basename($_FILES["post-image"]["name"])) . " has been uploaded";
            } else {
                echo "Sorry, there was an error was an error uploading your file.";
            }
        }
        $updateQuery = "UPDATE posts SET image='$postimage',caption='$caption' WHERE post_id='$postid'";
        $update =  mysqli_query($connection, $updateQuery) or die("Error occured in updating post" . mysqli_error($connection));
        if ($update) {
            header("Location: ./home.php");
        }
    }
}
while (list($post_id, $caption, $image) = mysqli_fetch_array($select)) {
?>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">



        <link type="text/css" href="global.css" rel="stylesheet">
        <link type="text/css" href="tailwind.css" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

        <title>Update Post by <?= $username ?></title>
        <link rel="shortcut icon" href="picpi.png" type="image/x-icon">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Kurale&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
        <script defer src="https://cdn.tailwindcss.com"></script>
    </head>

    <body class="flex flex-col items-center">
        <div class="navbar bg-white fixed z-10 shadow-2xl mb-8 p-2 w-full h-12  flex items-center justify-around">
            <div class="flex items-center justify-center">
                <img class="w-8 h-8" src="picpi.png" alt="">
                <a href='home.php' class="picpi">PicPi</a>
            </div>
            <div>
                <form method="POST" action="search.php" class="flex items-center justify-center">
                    <input required type="text" name='name' class="p-1 bg-[#ddd] rounded" placeholder="Search">
                    <button type="submit" name="search" class="btn btn-outline-primary material-icons text-md">search</button>
                </form>
            </div>
            <ul class="flex flex-row items-center justify-center list-none">
                <li class="mr-4 cursor-pointer"><a title="Home" class="bx bx-home-alt bx-sm" href="home.php"></a></li>

                <li class="mr-4 cursor-pointer"><a title="New post" class="bx bx-add-to-queue bx-sm" href="newpost.php"></a></li>
                <li class="mr-4 cursor-pointer"><a title="Notifications" class='bx bx-bell bx-sm' href="notifications.php"></a></li>
                <li class="mr-4 cursor-pointer">
                    <form action="logout.php" method="GET"><button title="Logout" class="material-icons" name="logout" type="submit">logout</button></form>
                </li>
                <li class="mr-4 cursor-pointer"><a href="account.php"><img src="<?= $profile ?>" class="object-cover w-10 h-10 rounded-full" alt=""></a></li>
            </ul>
        </div>
        <div class="m-auto mt-32 formupdate neumorphism flex flex-col w-4/12 p-4 box-border">
            <h2 class="heading-2">Update Post</h2>
            <form action="" class="w-full flex flex-col items-center justify-center" method="post" enctype='multipart/form-data'>
                <div class="w-full flex justify-between items-center mt-1">
                    <label for="post-image">Image</label>
                    <input class="rounded p-1 w-2/3" type="file" id="post-image" value="<?= $image; ?>" name="post-image">
                </div>
                <img class="object-cover" src="<?php echo $image; ?>" style='width:100px;height:100px;border-radius:50%;' alt="">
                <div class="w-full flex justify-between items-center mt-1">
                    <label for="username">Caption</label>
                    <textarea class="rounded p-1 w-2/3" type="text" name="caption"><?= $caption; ?></textarea>
                </div>
                <input class="p-1 text-white rounded w-32 bg-blue-500 neumorphism" value="Update" type="submit" name="updatepost">
            </form>

        </div>
    </body>

</html>
<?php
}
?>