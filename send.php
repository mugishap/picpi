<?php
include './connection.php';
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (trim($username) === '' || trim($password) === "") {
        echo "Invalid credentials";
    } else {
        $encrypt = hash("SHA512", $password);
        echo "Credentials are valid";
        $query = mysqli_query($connection, "SELECT * FROM users WHERE username='$username'");
        if (mysqli_num_rows($query) === 0) {
            echo "Wrong credentials";
        } else {
            while (list($userid, $firstName, $lastName, $telephone, $profile, $gender, $nationality, $username, $email, $password) = mysqli_fetch_array($query)) {
?>
                <div class=”home”>
                    Welcome <?= $firstName . $lastName ?>
                    <a href="changepassword.php?userid=<?= $userid ?>">Change Password</a>
                </div>
<?php
            }
        }
    }
}
?>