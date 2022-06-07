<?php
  include './connection.php';
  include './checkloggedin.php';
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

  <title>Account update</title>
  <link rel="shortcut icon" href="picpi.png" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Kurale&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
  <!-- <script src="https://cdn.tailwindcss.com"></script> -->
  <script defer>
    const redirect = () => {
      window.history.go(-1)
    }
  </script>
</head>

<body class="flex flex-col h-screen items-center justify-start">
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
      <li class="mr-4 cursor-pointer"><a href='activity.php' class='bx bx-bell bx-sm'></a></li>
      <li class="mr-4 cursor-pointer"><a title="Messages" href="users.php" class="material-icons">send</a></li>
      <li class="mr-4 cursor-pointer">
        <form action="logout.php" method="GET"><button title="Logout" class="material-icons" name="logout" type="submit">logout</button></form>
      </li>
      <li class="mr-4 cursor-pointer"><a href="account.php"><img src="<?= $profile ?>" class="object-cover w-10 h-10 rounded-full" alt=""></a></li>
    </ul>
  </div>

  <?php
  $newfirstname = $_POST['firstname'];
  $newlastname = $_POST['lastname'];
  $newemail = $_POST['email'];
  $newtelephone = $_POST['telephone'];
  $newgender = trim($_POST['gender']);
  $newnationality = $_POST['nationality'];
  $newusername = trim(mysqli_real_escape_string($connection,$_POST['username']));

  $checkOtherUsername = mysqli_query($connection, "SELECT username FROM users WHERE NOT user_id='$userid' AND username='$newusername'");
  $checkOtherEmail = mysqli_query($connection, "SELECT email FROM users WHERE NOT user_id='$userid' AND email='$newemail'");
  if (mysqli_num_rows($checkOtherUsername) != 0) {
  ?>
    <div class="neumorphism home w-2/5 mt-32 h-1/3 rounded-xl flex flex-col items-center justify-center">
      <p> Username already exists </p>
      <button type="button" onclick="redirect()" class="bg-blue-500 hover:bg-blue-600 w-48 text-white rounded p-1 btn-outline-primary">Go back</button>
    </div>
  <?php
    return;
  } else if (mysqli_num_rows($checkOtherEmail) != 0) {
  ?>
    <div class="neumorphism home mt-32 w-2/5 h-1/3 rounded-xl flex flex-col items-center justify-center">
      <p> Email already exists </p>
      <button type="button" onclick="redirect()" class="bg-blue-500 hover:bg-blue-600 w-48 text-white rounded p-1 btn-outline-primary">Go back</button>
    </div>
  <?php
    return;
  }
  $directory = "uploads/";
  $newprofileimage = $directory . basename($_FILES["profile-image"]["name"]);
  $uploadStatus = 1;
  $imageFileType = strtolower(pathinfo($newprofileimage, PATHINFO_EXTENSION));

  if ($newprofileimage === 'uploads/') {
    $sql = "SELECT * FROM users;";
    $select = mysqli_query($connection, $sql) or die("Error occured" . mysqli_error($connection));
    $row = mysqli_fetch_assoc($select);

    echo $username;

    $updateFollowersTable = mysqli_query($connection, "ALTER TABLE followers_" . $username . " RENAME TO followers_" . $newusername);

    $updateFollowingTable = mysqli_query($connection, "ALTER TABLE following_" . $username . " RENAME TO following_" . $newusername);
    $updateActivityTable = mysqli_query($connection, "ALTER TABLE activity_" . $username . " RENAME TO activity_" . $newusername);

    $updateLikesQuery = "UPDATE likes SET likerusername='$newusername' WHERE liker_id='$userid'";
    $updateLikes = mysqli_query($connection, $updateLikesQuery);

    $updateCommentsQuery = "UPDATE comments SET commenter_username='$newusername' WHERE commenter_id='$userid'";
    $updateComments = mysqli_query($connection, $updateCommentsQuery);

    $updatePostsQuery = "UPDATE posts SET username='$newusername' WHERE poster_id='$userid'";
    $updatePosts = mysqli_query($connection, $updatePostsQuery);
    $updateQuery = "UPDATE users SET firstname='$newfirstname', lastname='$newlastname',email='$newemail',telephone='$newtelephone',gender='$newgender',nationality='$newnationality',username='$newusername' WHERE user_id='$userid'";

    echo $updatePosts;
    // echo $updateComments, $updatePosts, $updateLikes;

    $update =  mysqli_query($connection, $updateQuery) or die("Error occured in updating user" . mysqli_error($connection));
    if ($update && $updateFollowersTable && $updateFollowingTable && $updateActivityTable && $updateLikes) {
      header("Location: ./home.php");
    }
  } else {
    $check = getimagesize($_FILES["profile-image"]["tmp_name"]);
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
      if (move_uploaded_file($_FILES["profile-image"]["tmp_name"], $newprofileimage)) {
        echo "The image " . htmlspecialchars(basename($_FILES["profile-image"]["name"])) . " has been uploaded";
      } else {
        echo "Sorry, there was an error was an error uploading your file.";
      }
    }
    $sql = "SELECT * FROM users";
    $select = mysqli_query($connection, $sql) or die("Error occured" . mysqli_error($connection));
    $row = mysqli_fetch_assoc($select);

    $updateQuery = "UPDATE users SET firstname='$newfirstname', lastname='$newlastname',email='$newemail',profile='$newprofileimage',telephone='$newtelephone',gender='$newgender',nationality='$newnationality',username='$newusername' WHERE user_id='$userid'";


    $updateFollowersTable = mysqli_query($connection, "ALTER TABLE followers_" . $username . " RENAME TO followers_" . $newusername) or die(mysqli_error($connection));

    $updateFollowingTable = mysqli_query($connection, "ALTER TABLE following_" . $username . " RENAME TO following_" . $newusername) or die(mysqli_error($connection));

    $updateActivityTable = mysqli_query($connection, "ALTER TABLE activity_" . $username . " RENAME TO activity_" . $newusername) or die(mysqli_error($connection));

    $updateLikes = mysqli_query($connection, "UPDATE likes SET likerusername='$newusername', liker_profile='$newprofileimage' WHERE liker_id='$userid'") or die(mysqli_error($connection));

    $updateComments = mysqli_query($connection, "UPDATE comments SET commenter_username='$newusername' WHERE commenter_id='$userid'") or die(mysqli_error($connection));

    $updatePosts = mysqli_query($connection, "UPDATE posts SET username='$newusername', profile='$newprofileimage' WHERE poster_id='$userid'") or die(mysqli_error($connection));

    $update =  mysqli_query($connection, $updateQuery) or die("Error occured in updating user" . mysqli_error($connection));
    if ($update && $updateFollowersTable && $updateFollowingTable && $updateActivityTable) {
      header("Location: ./home.php");
    }
  }
  ?>
</body>

</html>