<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">



    <link type="text/css" href="global.css" rel="stylesheet">
    <link type="text/css" href="tailwind.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>


    <title>Login</title>
    <link rel="shortcut icon" href="picpi.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kurale&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
</head>

<body class="flex items-center justify-center flex-col">
    <?php
    if (isset($_COOKIE['PICPI-USERID'])) {
        header("location: home.php");
    }
    ?>

    <div class="neumorphism flex flex-col items-center justify-center form w-1/3 m-auto rounded p-4 mt-48">
        <img src="picpi.png" class="w-32 h-32 m-4" alt="">
        <h2 class="text-2xl m-4">Welcome Back</h2>
        <form action="send.php" method="post" class="w-full flex flex-col items-center">
            <div class="holders w-full flex flex-row items-center justify-between m-1">
                <label for="username">Username: </label>
                <input pattern="[a-z].*" type="text" placeholder="Enter username" name="username" id="username" required>
            </div>
            <div class="holders w-full flex flex-row items-center justify-between m-1">
                <label for="password">Password: </label>
                <input type="password" placeholder="Enter password" name="password" id="password" required>
            </div>
            <button type="submit" name="login" class="p-2 mt-4 w-24 hover:bg-blue-600 text-white rounded bg-blue-400">Submit</button>
            <p class="whitespace-nowrap mt-2">Not a member yet? <a class="hover:text-blue-600" href="signup.php">Signup</a></p>
        </form>
    </div>
    <script type="text/javascript">
        window.addEventListener('beforeunload',()=>{
            alert("Finishing the page will log you out");
        })
    </script>
</body>

</html>