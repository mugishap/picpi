<?php

include './connection.php';
if (!$connection) {
    echo "Connection not successfull" . mysqli_connect_error();
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users where user_id=$id;";
    $select  = mysqli_query($connection,$sql) or die(mysqli_error($connection));

    if($select == TRUE){
        $count = mysqli_num_rows($select);
        if($count > 0){
            while($rows=mysqli_fetch_assoc($select)){
?>
 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update account</title>
    <link rel="stylesheet" href="signup.css">
</head>

<body>
    <div class="form">
        <h2 class="heading-2">Update account</h2>
        <form action="processupdate.php?id=<?php echo $rows['user_id'] ?>" method="post" enctype='multipart/form-data'>
            <div class="labels">
                <label for="">First Name</label>
                <input type="text" id="firstName" value="<?php echo $rows['firstName'];?>" name="firstName">
            </div>
            <div class="labels">
                <label for="">Last Name</label>
                <input type="text" name="lastName" value="<?php echo $rows['lastName'];?>">
            </div>
            <div class="labels">
                <label for="">Email</label>
                <input type="email" name="email" value="<?php echo $rows['email'];?>">
            </div>
            <div class="labels">
                <label for="profile-image">Profile</label>
                <input type="file" id="profile-image" value="<?php echo $rows['profile'];?>" name="profile-image">
            </div>
            <img src="<?php echo $rows['profile'];?>" class='profile' style='width:100px;height:100px;border-radius:50%;' alt="">
            <div class="labels">
                <label for="telephone">Telephone</label>
                <input pattern="[0-9]{10,12}" type="text" name="telephone" value="<?php echo $rows['telephone'];?>">
            </div>
            <?php if ($rows['gender'] == "Male") {?>
            <div class="labels" id="gender">
                <label for="">Gender</label>
                <div class="radio">
                    <input type="radio" name="gender" value="Male" checked>Male
                    <input type="radio" name="gender" value="Female">Female
                </div>
            </div>
           <?php }
           else{?>
            <div class="labels" id="gender">
                <label for="">Gender</label>
                <div class="radio">
                    <input type="radio" name="gender" value="Male" checked>Male
                    <input type="radio" name="gender" value="Female">Female
                </div>
            </div>

          <?php } ?>
      
            <div class="labels">
                <label for="Nationality">Nationality</label>
                <select name="nationality">
                    <option>--Select--</option>
                    <?php 
                    $nationalities = ["Rwanda","Kenya","South Africa","Nigeria","Canada","Algeria","USA","Uganda","Liberia","Senegal"];
                    for($i = 0;$i < count($nationalities);$i++){ ?>
                    <option value="<?= $nationalities[$i] ?>" <?= ($rows['nationality'] == $nationalities[$i])? "selected" : "" ?>><?=$nationalities[$i] ?></option>
                    <?php } ?>
                </select>
            </div>

    
            <div class="labels">
                <label for="username">Username</label>
                <input  type="text" name="username" value="<?php echo $rows['username'];?>">
            </div>
            <input value="Update" type="submit" name="submit">
        </form>

    </div>
</body>

</html>
<?php
}
}

}

}

?>