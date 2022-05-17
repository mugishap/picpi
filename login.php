<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="form w-1/3 m-auto bg-gray-300 rounded p-4 mt-48">
        <form action="send.php" method="post" class="w-full flex flex-col">
            <div class="holders w-full flex flex-row items-center justify-between m-1">
                <label for="username">Username: </label>
                <input class="w-2/3 h-10 rounded p-1" type="text" placeholder="Enter username" name="username" id="username" required>
            </div>
            <div class="holders w-full flex flex-row items-center justify-between m-1">
                <label for="password">Password: </label>
                <input class="w-2/3 h-10 rounded p-1" type="password" placeholder="Enter password" name="password" id="password" required>
            </div>
            <button type="submit" name="login" class="p-2 w-24 text-white hover:bg-blue-700 rounded bg-blue-400">Submit</button>
        </form>
    </div>
</body>

</html>