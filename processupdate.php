<?php
include './connection.php';
include './checkloggedin.php';
$newfirstname = $_POST['firstname'];
$newlastname = $_POST['lastname'];
$newemail = $_POST['email'];
$newtelephone = $_POST['telephone'];
$newgender = trim($_POST['gender']);
$newnationality = $_POST['nationality'];
$newusername = trim($_POST['username']);


echo $gender . "<br>";

$directory = "uploads/";
$profileimage = $directory . basename($_FILES["profile-image"]["name"]);
$uploadStatus = 1;
$imageFileType = strtolower(pathinfo($profileimage, PATHINFO_EXTENSION));
if ($profileimage === 'uploads/') {
  $sql = "SELECT * FROM users;";
  $select = mysqli_query($connection, $sql) or die("Error occured" . mysqli_error($connection));
  $row = mysqli_fetch_assoc($select);

  // $encryptedPassword = hash("SHA512", $password);

  $updateQuery = "UPDATE users SET firstname='$newfirstname', lastname='$newlastname',email='$newemail',telephone='$newtelephone',gender='$newgender',nationality='$newnationality',username='$newusername' WHERE user_id='$userid'";
  $updateFollowersTable = mysqli_query($connection, "ALTER TABLE followers_" . $username . " RENAME TO followers_" . $newusername);
  $updateFollowingTable = mysqli_query($connection, "ALTER TABLE following_" . $username . " RENAME TO following_" . $newusername);
  $updateActivityTable = mysqli_query($connection, "ALTER TABLE activity_" . $username . " RENAME TO activity_" . $newusername);
  $updateLikes = mysqli_query($connection, "UPDATE likes SET likerusername='$newusername' AND likerprofile='$newprofileimage' WHERE liker_id='$userid'");
  $updateComments = mysqli_query($connection, "UPDATE comments SET commenter_username='$newusername' AND WHERE commenter_id='$userid'");
  $updatePosts = mysqli_query($connection, "UPDATE posts SET posterusername='$newusername' AND profile='$newprofileimage' WHERE poster_id='$userid'");

  $update =  mysqli_query($connection, $updateQuery) or die("Error occured in updating user" . mysqli_error($connection));
  if ($update && $updateFollowersTable && $updateFollowingTable && $updateActivityTable) {
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
    if (move_uploaded_file($_FILES["profile-image"]["tmp_name"], $profileimage)) {
      echo "The image " . htmlspecialchars(basename($_FILES["profile-image"]["name"])) . " has been uploaded";
    } else {
      echo "Sorry, there was an error was an error uploading your file.";
    }
  }
  $sql = "SELECT * FROM users";
  $select = mysqli_query($connection, $sql) or die("Error occured" . mysqli_error($connection));
  $row = mysqli_fetch_assoc($select);

  // $encryptedPassword = hash("SHA512", $password);
  $updateQuery = "UPDATE users SET firstname='$newfirstname', lastname='$newlastname',email='$newemail',profile='$newprofileimage',telephone='$newtelephone',gender='$newgender',nationality='$newnationality',username='$newusername' WHERE user_id='$userid'";
  $update =  mysqli_query($connection, $updateQuery) or die("Error occured in updating user" . mysqli_error($connection));

  $updateQuery = "UPDATE users SET firstname='$newfirstname', lastname='$newlastname',email='$newemail',telephone='$newtelephone',gender='$newgender',nationality='$newnationality',username='$newusername' WHERE user_id='$userid'";
  $updateFollowersTable = mysqli_query($connection, "ALTER TABLE followers_" . $username . " RENAME TO followers_" . $newusername);
  $updateFollowingTable = mysqli_query($connection, "ALTER TABLE following_" . $username . " RENAME TO following_" . $newusername);
  $updateActivityTable = mysqli_query($connection, "ALTER TABLE activity_" . $username . " RENAME TO activity_" . $newusername);
  $updateLikes = mysqli_query($connection, "UPDATE likes SET likerusername='$newusername' AND likerprofile='$newprofileimage' WHERE liker_id='$userid'");
  $updateComments = mysqli_query($connection, "UPDATE comments SET commenter_username='$newusername' AND WHERE commenter_id='$userid'");
  $updatePosts = mysqli_query($connection, "UPDATE posts SET posterusername='$newusername' AND profile='$newprofileimage' WHERE poster_id='$userid'");

  if ($update && $updateFollowersTable && $updateFollowingTable && $updateActivityTable) {
    header("Location: ./home.php");
  }
}
