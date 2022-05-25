<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">



    <link type="text/css" href="global.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    <title>Authentication</title>
    <link rel="shortcut icon" href="picpi.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kurale&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="w-screen h-screen flex items-center justify-center">
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
    ?>
                <div class="neumorphism home w-2/5 h-2/3 rounded-xl flex flex-col items-center justify-center">
                  <p> Wrong email or password </p>
                </div>
                <?php
            } else {
                while (list($userid, $firstName, $lastName,, $profile,,, $username,,,) = mysqli_fetch_array($query)) {
                ?>
                    <div class="home w-2/5 h-2/3 rounded-xl bg-gray-200 flex flex-col items-center justify-center">
                        <img src="<?= $profile ?>" class="w-48 h-48 rounded-full" alt="">
                        Welcome <?= $firstName . $lastName . '<br>' ?>
                        Jump right to home by clicking <a href='home.php?userid=<?= $userid ?>'>here</a>
                        <a class="mt-10" href="changepassword.php?userid=<?= $userid ?>">Change Password</a>
                    </div>
    <?php
                }
            }
        }
    }
    ?>
</body>

</html>