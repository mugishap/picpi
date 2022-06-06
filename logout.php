<?php
      if(isset($_COOKIE['PICPI-USERID'])){
        include_once "connection.php";
        $logout_id = mysqli_real_escape_string($connection, $_COOKIE['PICPI-USERID']);
        if(isset($logout_id)){
            $status = "Offline now";
            $sql = mysqli_query($connection, "UPDATE users SET status = '{$status}' WHERE user_id='$logout_id'");
            setcookie("PICPI-USERID", "", time() - 3600,'/');
            if($sql){

                header("location: ./login.php");
            }
        }else{
            header("location: ../users.php");
        }
    }else{  
        header("location: ../login.php");
    }
?>