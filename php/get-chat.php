<?php 
      if(isset($_COOKIE['PICPI-USERID'])){
        include_once "./../connection.php";
        $outgoing_id = $_COOKIE['PICPI-USERID'];
        $incoming_id = $_POST['incoming_id'];
        $output = "";
        $sql = "SELECT * FROM messages LEFT JOIN users ON users.user_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = '$outgoing_id' AND incoming_msg_id = $incoming_id)
                OR (outgoing_msg_id = $incoming_id AND incoming_msg_id = '$outgoing_id') ORDER BY msg_id";
        $query = mysqli_query($connection, $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                if($row['outgoing_msg_id'] === $outgoing_id){
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }else{
                    $output .= '<div class="chat incoming">
                                <img src="'.$row['profile'].'" alt="">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }
            }
        }else{
            $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        }
        echo $output;
    }else{
        header("location: ../login.php");
    }

?>