<?php 
  if(isset($_COOKIE['PICPI-USERID'])){
    header("location: ./home.php");
  }
  else{
    header("location: ./login.php");
  }
?>
