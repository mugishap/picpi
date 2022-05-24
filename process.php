<div class="main">
  <?php

  include './connection.php';


  if (isset($_POST['submit'])) {


    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $gender = $_POST['gender'];
    $nationality = $_POST['nationality'];
    $userName = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];


    if (($firstName == "") || ($lastName == "") || ($email == "") || ($password !== $cpassword) || ($nationality === "")) {
      echo "I don't have full details";
  ?>
      <script>
        console.log("Not full")
        window.location.replace('/myapp/PHP-Crud/signup.php')
      </script>
      <?php
    } else {

      $directory = "uploads/";
      $profileimage = $directory . basename($_FILES["profile-image"]["name"]);
      $uploadStatus = 1;
      $imageFileType = strtolower(pathinfo($profileimage, PATHINFO_EXTENSION));

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
        }
        $encryptedPassword = hash("SHA512", $password);
        $insertQuery = "INSERT INTO users(firstName,lastName,email,profile,telephone,gender,nationality,userName,password) VALUES('$firstName','$lastName','$email','$profileimage','$telephone','$gender','$nationality','$userName','$encryptedPassword');";
        $insert =  mysqli_query($connection, $insertQuery) or die("Error occured" . mysqli_error($connection));
        if ($insert) {
          $getloggeduser = mysqli_query($connection, "SELECT * FROM users WHERE username='$userName' AND firstname='$firstName' AND lastName='$lastName'");
          list($userid) = mysqli_fetch_array($getloggeduser);
      ?>
          <script>
            window.location.replace("/myapp/PHP-Crud/home.php?userid=<?= $userid ?>")
          </script>
  <?php
        } else {
          echo "Sorry, there was an error was an error uploading your file.";
        }
      }
    }
  }
  ?>