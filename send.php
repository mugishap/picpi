<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include './connection.php';
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if (trim($username) === '' || trim($password) === "") {
            echo "Invalid credentials";
        } else {
            $encrypt = hash("SHA512", $password);
            // echo "Credentials are valid";
            $query = mysqli_query($connection, "SELECT * FROM users WHERE username='$username' AND password='$encrypt'");
            if (mysqli_num_rows($query) === 0) {
                echo "Wrong credentials";
            } else {
                while (list($userid, $firstName, $lastName, $telephone, $profile, $gender, $nationality, $username, $email, $password, $role) = mysqli_fetch_array($query)) {
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
</body>

</html>