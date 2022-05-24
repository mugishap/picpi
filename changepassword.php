<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">



    <link type="text/css" href="global.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css'>

    <title>Login</title>
    <link rel="shortcut icon" href="picpi.png" type="image/x-icon">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kurale&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="form w-1/3 m-auto bg-[#eeeeee] rounded p-4 mt-48">
        <form action="" method="post" class="w-full flex flex-col">
            <div class="holders w-full flex flex-row items-center justify-between m-1">
                <label for="username">Previous password: </label>
                <input class="w-2/3 h-10 rounded p-1" type="text" placeholder="Enter previous password" name="prevpassword" id="username" required>
            </div>
            <div class="holders w-full flex flex-row items-center justify-between m-1">
                <label for="password">New password: </label>
                <input class="w-2/3 h-10 rounded p-1" type="password" placeholder="Enter new password" name="newpassword" id="password" required>
            </div>
            <button type="submit" name="changepass" class="p-2 w-24 text-white hover:bg-blue-700 rounded bg-blue-400">Submit</button>
        </form>

        <?php

        include './connection.php';
        if (isset($_POST['changepass'])) {
            $prevpassword = $_POST['prevpassword'];
            $newpassword = $_POST['newpassword'];
            $id = $_GET['userid'];

            if (trim($prevpassword) === '' || trim($newpassword) === "") {
                echo "Invalid credentials";
                return;
            } else if ($prevpassword === $newpassword) {
                echo "You didn't change anything";
                return;
            } else {
                $encrypt = hash("SHA512", $newpassword);
                $prevEncrypt = hash("SHA512", $prevpassword);

                $query = mysqli_query($connection, "SELECT * FROM users WHERE user_id='$id' AND password='$prevEncrypt'");
                if (mysqli_num_rows($query) === 0) {
                    echo "Wrong credentials";
                    return;
                } else {
                    $updatequery = mysqli_query($connection, "UPDATE users SET password='$encrypt'  WHERE user_id='$id' AND password='$prevEncrypt'");
                    echo "$updatequery";
                    while (list($userid, $firstName, $lastName, $telephone, $profile, $gender, $nationality, $username, $email, $password, $role) = mysqli_fetch_array($query)) {
        ?>
                        <div class=”home”>
                            Dear <?= $firstName . " " . $lastName ?>, Your password has been changed successfuly
                            <a href="login.php">Go back to home</a>
                        </div>
        <?php
                    }
                }
            }
        }
        ?>

</body>

</html>