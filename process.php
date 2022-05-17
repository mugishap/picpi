<div class="main">
<?php

include './connection.php';


if(isset($_POST['submit'])){

  
  $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $gender = $_POST['gender'];
    $nationality = $_POST['nationality'];
    $userName = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    
    if (($firstName == "") || ($lastName == "") || ($email == "") || ($password !== $cpassword) || ($nationality === "" )) {
      echo "I don't have full details";
      echo "<a href='signup.html' style='width: 100%;'>Go back to form</a>";
    } else {

    $directory = "uploads/";
    $profileimage = $directory . basename($_FILES["profile-image"]["name"]);
    $uploadStatus = 1;
    $imageFileType = strtolower(pathinfo($profileimage,PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["profile-image"]["tmp_name"]);
    if($check !== false){
      echo "File is an image" . $check["mime"] . ".";
      $uploadStatus = 1;
    }
    else{
      echo "File is not an image";
      $uploadStatus = 0;
    }
      if($uploadStatus == 0){
        echo "Sorry, your image was not uploaded.";
      }
      else{
        if(move_uploaded_file($_FILES["profile-image"]["tmp_name"], $profileimage)){
          echo "The image " . htmlspecialchars(basename($_FILES["profile-image"]["name"])) . " has been uploaded";
        }
        else{
          echo "Sorry, there was an error was an error uploading your file.";
        }
      }
      $encryptedPassword = hash("SHA512", $password);
      $insertQuery = "INSERT INTO users(firstName,lastName,email,profile,telephone,gender,nationality,userName,password) VALUES('$firstName','$lastName','$email','$profileimage','$telephone','$gender','$nationality','$userName','$encryptedPassword');";
      $insert =  mysqli_query($connection, $insertQuery) or die("Error occured" . mysqli_error($connection));
      if ($insert) {
                echo "<h3 id='data_added'>Data added Succesfully👏👏👏</h3>";
            }
    }
    
}


?>
<style>
    body{
        background-color: whitesmoke;
        display:flex;
        align-items:center;
        justify-content:center;
        flex-direction:center;
        font-family: 'Microsoft Tai Le';
    }
    .main{
        background-color: rgba(212, 212, 212, 0.555);
        width: 50%;
        height: 40%;
        display:flex;
        justify-content:center;
        align-items: center;
        flex-direction:column;
        border-radius: 10px;
        box-shadow: 0px 5px 10px black;
    }
    .main a{
        text-decoration:none;
        background-color: rgba(13, 46, 138, 0.555);
    color: #fff;
    width: 20%;
    text-align: center;
    padding: 3px 0px;
    font-size: 1.2em;
    margin: 10px;
    height: 1.5em;
    border-radius: 5px;
    vertical-align: middle;
    }
    .main a:hover{
        background-color: rgb(0, 0, 255);
    }
    #data_added{
    font-size:1.5em;
    }
</style>
<a href="display.php" title="display Data"> Display</a>
</div>