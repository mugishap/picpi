<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New post</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="form">
        <h2 class="heading-2">Create new post</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="labels">
                <label for="post-image">Image</label>
                <input type="file" id="post-image" name="post-image">
            </div>
            <div class="labels">
                <label for="caption">Caption</label>
                <input placeholder="Enter Caption" type="textarea" name="caption">
            </div>

            <input value="Submit" type="submit" name="submit">
        </form>
    </div>
    <?php
    include './connection.php';
    $userid = $_GET['userid'];
    $getuser = mysqli_query($connection, "SELECT * FROM user WHERE user_id='$userid'");
    if (mysqli_num_rows($getuser)) {
        echo "Error in getting your credentials...";
        return;
    } else {
        list($username, $country, $profile) = mysqli_fetch_array($getuser);
    }
    if (isset($_POST['submit'])) {
        $caption = $_POST['caption'];
        if ($caption === '') {
            echo "<script>setTimeout(()=>{
window.alert('You should add a caption')
        })<script>";
            return;
        } else {
            $directory = 'uploads';
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
            $savePost = mysqli_query($connection,"INSERT INTO posts(username,profile,caption,image) VALUES('$username','$profile','$caption','$postimage')");
            if($savePost){
                echo "Post added succesfuly <a href='home.php?<?=$id?>'>View</a>";
            }
            else{
                echo "Error in uploading your post";
            }
        }
    }
    ?>
</body>

</html>