<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


    <link type="text/css" href="global.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>


    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    <title>New post | PicPi</title>
    <link rel="shortcut icon" href="picpi.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kurale&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>


<body class="flex items-center justify-center flex-col">
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
    if (isset($_POST['submit'])) {
        $caption = $_POST['caption'];
        if ($caption === '') {
            echo "You should add a caption";;
            return;
        } else {
            $directory = 'uploads/';
            $postimage = $directory . basename($_FILES['post-image']['name']);
            $uploadStatus = 1;
            $imageFileType = strtolower(pathinfo($postimage, PATHINFO_EXTENSION));
            $check = getimagesize($_FILES['post-image']['tmp_name']);
            if ($check !== false) {
                echo "File is an image" . $check['mime'] . ".";
                $uploadStatus = 1;
            } else {
                echo "File is not an image";
                $uploadStatus = 0;
            }
            if ($uploadStatus === 0) {
                echo "Sorry, your image was not uploaded.";
            } else {
                if (move_uploaded_file($_FILES['post-image']['tmp_name'], $postimage)) {
                    echo "The image " . htmlspecialchars(basename($_FILES['post-image']['name'])) . " has been uploaded";
                } else {
                    echo "
                    Sorry, there was an error uploading your file.";
                }
            }
            $savePost = mysqli_query($connection, "INSERT INTO posts(username,profile,caption,image) VALUES('$username','$profile','$caption','$postimage')");
            if ($savePost) {
        ?>
                <script>
                    window.location.replace('/myapp/PHP-Crud/home.php?userid=<?= $userid ?>')
                </script>
    <?php

            } else {
                echo "Error in uploading your post";
            }
        }
    }
    ?>
    <div class="navbar shadow-2xl mb-8 p-2 w-full h-12  flex items-center justify-around">
        <div class="flex items-center justify-center">
            <img class="w-8 h-8" src="picpi.png" alt="">
            <a href='home.php?userid=<?= $userid ?>' class="picpi">PicPi</a>
        </div>
        <div>
            <form action="search.php?userid=<?= $userid ?>" method='POST' class="flex items-center justify-center">
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
    <div class="form neumorphism mt-24 w-4/12 h-[40vh] rounded-xl p-4 flex items-center justify-center flex-col">
        <h2 class="heading-2 mb-4">Create new post</h2>
        <form class="w-full flex flex-col items-center justify-center" action="" method="POST" enctype="multipart/form-data">
            <div class="labels flex justify-between w-full mb-4 items-center">
                <label for="post-image">Image</label>
                <input class="w-2/3" required type="file" id="post-image" name="post-image">
            </div>
            <div class="labels flex justify-between w-full mb-4 items-start">
                <label for="caption">Caption</label>
                <textarea required style="resize: none;" class="p-2 rounded border-box w-2/3 h-24" placeholder="Enter Caption" type="textarea" name="caption"></textarea>
            </div>

            <input class="p-2 text-white bg-blue-500 rounded-xl w-24 cursor-pointer" value="Submit" type="submit" name="submit">
        </form>
    </div>

</body>

</html>