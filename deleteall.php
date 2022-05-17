<div class="main">
<?php
include './connection.php';
if (!$connection) {
    echo "Connection not successfull" . mysqli_connect_error();
} else {
    $truncateQuery = "TRUNCATE TABLE users";
    $delete = mysqli_query($connection, $truncateQuery) or die("Error occured in truncating table" . mysqli_error($connection));
    echo "<h3 id='data_trucated'>Table truncated Succesfully😭😭😭</h3>";
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
    #data_trucated{
    font-size:1.5em;
    }
</style>
<a href="display.php">View</a>
</div>
