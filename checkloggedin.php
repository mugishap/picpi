<?php
include './connection.php';
if (!isset($_COOKIE['PICPI-USERID'])) {
?>
    <script>
        window.location.replace('/php-crud/login.html')
    </script>
<?php
    return;
}
$userid = $_COOKIE['PICPI-USERID'];
$getUser = mysqli_query($connection, "SELECT * FROM users WHERE user_id='$userid'");
if (!$getUser) {
?>
    <script>
        window.location.replace('/php-crud/login.html')
    </script>
<?php
    return;
}
list($userid, $firstname, $lastname, $telephone, $profile, $gender, $nationality, $username, $email,, $role) = mysqli_fetch_array($getUser)



?>