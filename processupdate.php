<?php
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$gender = $_POST['gender'];
$nationality = $_POST['nationality'];
$userName = $_POST['username'];
$userid = $_GET['userid'];
include './connection.php';

if (!$connection) {
  echo "Connection not successfull" . mysqli_connect_error();
} else {
  $directory = "uploads/";
  $profileimage = $directory . basename($_FILES["profile-image"]["name"]);
  $uploadStatus = 1;
  $imageFileType = strtolower(pathinfo($profileimage, PATHINFO_EXTENSION));
  if ($profileimage === 'uploads/') {
    $sql = "SELECT * FROM users;";
    $select = mysqli_query($connection, $sql) or die("Error occured" . mysqli_error($connection));
    $row = mysqli_fetch_assoc($select);

    // $encryptedPassword = hash("SHA512", $password);
    $updateQuery = "UPDATE users SET firstName='$firstName', lastName='$lastName',email='$email',telephone='$telephone',gender='$gender',nationality='$nationality',username='$userName' WHERE user_id=$userid";
    $update =  mysqli_query($connection, $updateQuery) or die("Error occured in updating user" . mysqli_error($connection));
    if ($update) {
?>
      <script>
        window.location.replace('/myapp/PHP-Crud/home.php?userid=<?= $userid ?>')
      </script>
    <?php
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
    $sql = "SELECT * FROM users;";
    $select = mysqli_query($connection, $sql) or die("Error occured" . mysqli_error($connection));
    $row = mysqli_fetch_assoc($select);

    // $encryptedPassword = hash("SHA512", $password);
    $updateQuery = "UPDATE users SET firstName='$firstName', lastName='$lastName',email='$email',profile='$profileimage',telephone='$telephone',gender='$telephone',nationality='$nationality',username='$userName',password = '$password' WHERE user_id=$userid";
    $insert =  mysqli_query($connection, $updateQuery) or die("Error occured in updating user" . mysqli_error($connection));
    if ($insert) {
    ?>
      <script>
        window.location.replace('/myapp/PHP-Crud/home.php?userid=<?= $userid ?>')
      </script>
<?php
    }
  }
}



?>