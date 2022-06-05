<?php 
      if(isset($_COOKIE['user_id'])){
        include_once "connection.php";
        $outgoing_id = $_COOKIE['user_id'];
        $incoming_id = mysqli_real_escape_string($connection, $_POST['incoming_id']);
        $message = mysqli_real_escape_string($connection, $_POST['message']);
        if(!empty($message)){
            $sql = mysqli_query($connection, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')") or die();
        }
    }else{
        header("location: ../login.html");
    }


    
?>