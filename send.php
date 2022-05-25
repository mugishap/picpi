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
    <script defer>
        const redirect = () => {
            window.history.go(-1)
        }
    </script>
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
                <div class="neumorphism home w-2/5 h-1  /3 rounded-xl flex flex-col items-center justify-center">
                    <p> Wrong email or password </p>
                    <button type="button" onclick="redirect()" class="bg-blue-500 hover:bg-blue-600 w-48 text-white rounded p-1 btn-outline-primary">Go back</button>
                </div>
                <?php
            } else {
                while (list($userid, $firstName, $lastName,, $profile,,, $username,,,) = mysqli_fetch_array($query)) {
                ?>
                    <div class="home w-2/5 h-2/3 rounded-xl neumorphism flex flex-col items-center justify-center">
                        <h1 class="font-bold text-xl">Is this you?</h1>
                        <div class="neumorphism rounded  w-2/3 flex flex-col items-center justify-center p-2">
                            <img src="<?= $profile ?>" class="w-32 h-32 rounded-full" alt="">
                            Welcome <?= $firstName . $lastName . '<br>' ?>
                            Jump right to home by clicking <a class="font-bold" href='home.php?userid=<?= $userid ?>'>here</a>
                        </div>
                        <!-- <a class="mt-10" href="changepassword.php?userid=<?= $userid ?>">Change Password</a> -->
                    </div>
    <?php
                }
            }
        }
    }
    ?>
</body>

</html>