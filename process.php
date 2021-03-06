<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup process</title>
  <link rel="shortcut icon" href="picpi.png" type="image/x-icon">
  <link type="text/css" rel="stylesheet" href="global.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link type="text/css" href="global.css" rel="stylesheet">
  <link type="text/css" href="tailwind.css" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

</head>

<body class="flex flex-col items-center justify-center">
  <div class="main w-full flex flex-col items-center justify-center ">
    <script defer>
      const redirect = () => {
        window.history.go(-1)
      }
    </script>
    <?php

    include './connection.php';


    if (isset($_POST['submit'])) {


      $firstname = $_POST['firstname'];
      $lastname = $_POST['lastname'];
      $email = $_POST['email'];
      $telephone = $_POST['telephone'];
      $gender = $_POST['gender'];
      $nationality = $_POST['nationality'];
      $username = $_POST['username'];
      $password = $_POST['password'];
      $cpassword = $_POST['cpassword'];


      if (($firstname == "") || ($lastname == "") || $username == "" || ($email == "") || ($password !== $cpassword) || ($nationality === "")) {
        echo "You don't have full details";
    ?>
        <div class="home w-2/5 h-2/3 rounded-xl neumorphism flex flex-col items-center justify-center p-2 mt-48">
          <h1 class="font-bold text-xl">Error!!!</h1>
          <p> You must fill all credentials.</p>
          <button type="button" onclick="redirect()" class="bg-blue-500 hover:bg-blue-600 w-48 text-white rounded p-1 btn-outline-primary">Go back</button>
        </div>
        <?php
      } else {
        $anotherUsername = mysqli_query($connection, "SELECT username from users WHERE username='$username'");
        if (mysqli_num_rows($anotherUsername) > 0) {
        ?>
          <div class="home w-2/5 h-2/3 rounded-xl neumorphism flex flex-col items-center justify-center p-2 mt-48">
            <h1 class="font-bold text-xl">Sorry!!!</h1>
            <p> Username already exists </p>
            <button type="button" onclick="redirect()" class="bg-blue-500 hover:bg-blue-600 w-48 text-white rounded p-1 btn-outline-primary">Go back</button>
          </div>
        <?php
          return;
        }

        $anotherEMail = mysqli_query($connection, "SELECT email from users WHERE email='$email'");
        if (mysqli_num_rows($anotherEMail) > 0) {
        ?>
          <div class="home w-2/5 h-2/3 rounded-xl neumorphism flex flex-col items-center justify-center">
            <h1 class="font-bold text-xl">Sorry!!!</h1>
            <p> Email already exists </p>
            <button type="button" onclick="redirect()" class="bg-blue-500 hover:bg-blue-600 w-48 text-white rounded p-1 btn-outline-primary">Go back</button>
          </div>
        <?php
          return;
        }

        $directory = "uploads/";
        $profileimage = $directory . basename($_FILES["profile-image"]["name"]);
        $uploadStatus = 1;
        $imageFileType = strtolower(pathinfo($profileimage, PATHINFO_EXTENSION));
        if ($profileimage === "uploads/") {
        ?>
          <div class="home w-2/5 h-3/3 rounded-xl neumorphism flex flex-col items-center justify-center p-2 mt-48">
            <script>
              document.querySelector('title').innerHTML = 'Error | Profile'
            </script>
            <h1 class="font-bold text-xl">Error!!!</h1>
            <p> You must add a profile picture please.</p>
            <button type="button" onclick="redirect()" class="bg-blue-500 hover:bg-blue-600 w-48 text-white rounded p-1 btn-outline-primary">Go back</button>
          </div>
          <?php
          return;
        };
        $check = getimagesize($_FILES["profile-image"]["tmp_name"]);
        if ($check !== false) {
          echo "File is an image" . $check["mime"] . ".";
          $uploadStatus = 1;
        } else {
          // echo "File is not an image";
          $uploadStatus = 0;
        }
        if ($uploadStatus == 0) {
          echo "Upload an image please  ";
        } else {
          if (move_uploaded_file($_FILES["profile-image"]["tmp_name"], $profileimage)) {
            echo "The image " . htmlspecialchars(basename($_FILES["profile-image"]["name"])) . " has been uploaded";
          }
          
          $encryptedPassword = hash("SHA512", $password);
          $insertQuery = "INSERT INTO users(firstname,lastname,email,profile,telephone,gender,nationality,username,password) VALUES('$firstname','$lastname','$email','$profileimage','$telephone','$gender','$nationality','$username','$encryptedPassword')";
          
          $createFollowersQuery = "CREATE TABLE followers_".$username."(follow_id varchar(255) not null DEFAULT UUID() PRIMARY KEY,follower_id varchar(255) not null,follower_username varchar(32) not null,follower_profile varchar(255) not null)";
          echo $createFollowersQuery;
          $createFollowersTable = mysqli_query($connection, $createFollowersQuery)  or die($connection);
          
          $createFollowingQuery = "CREATE TABLE following_".$username."(follow_id varchar(255) not null DEFAULT UUID() PRIMARY KEY,following_id varchar(255) not null,following_username varchar(32) not null,following_profile varchar(255) not null)";
          $createFollowingTable = mysqli_query($connection, $createFollowingQuery)  or die($connection);
          
          $createActivityQuery = "CREATE TABLE activity_".$username."(activity_id varchar(255) DEFAULT uuid(),count int auto_increment PRIMARY KEY not null,activity_time datetime default current_timestamp() not null,activity_comment varchar(255) not null,related varchar(100) not null,status varchar(50) default 'UNREAD' not null)";
          $createActivityTable = mysqli_query($connection,$createActivityQuery) or die($connection);
          $insert =  mysqli_query($connection, $insertQuery) or die($connection);
          if ($insert) {
            $getloggeduser = mysqli_query($connection, "SELECT * FROM users WHERE username='$username' AND firstname='$firstname' AND lastname='$lastname'");
            list($userid) = mysqli_fetch_array($getloggeduser);
            setcookie('PICPI-USERID', $userid, time() + (86400 * 30), "/");
            header("Location: ./home.php");
          } else {
            echo "Sorry, there was an error was in creating your account.";
          }
        }
      }
    }
    ?>
</body>

</html>