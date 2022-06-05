<?php
      if(isset($_COOKIE['user_id'])){
        include_once "connection.php";
        $logout_id = mysqli_real_escape_string($connection, $_GET['logout_id']);
        if(isset($logout_id)){
            $status = "Offline now";
            $sql = mysqli_query($connection, "UPDATE users SET status = '{$status}' WHERE user_id={$_GET['logout_id']}");
            if($sql){

                header("location: ../login.html");
            }
        }else{
            header("location: ../users.php");
        }
    }else{  
        header("location: ../login.html");
    }
?>