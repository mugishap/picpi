<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">



    <link type="text/css" href="global.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>


    <title>Welcome to PicPi</title>
    <link rel="shortcut icon" href="picpi.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link type="text/css" rel="stylesheet" href="global.css">
</head>

<body>
    <div class="m-auto form w-1/3 flex flex-col items-center justify-center">
        <h2 class="heading-2">Welcome to PicPi</h2>
        <img class="w-24 h-24 " src="picpi.png" alt="">
        <form action="process.php" class="signupform" method="POST" enctype="multipart/form-data">
            <div class="labels">
                <label for="">First Name</label>
                <input placeholder="Enter First Name" type="text" id="firstName" name="firstName">
            </div>
            <div class="labels">
                <label for="">Last Name</label>
                <input placeholder="Enter Last Name" type="text" name="lastName">
            </div>
            <div class="labels">
                <label for="">Email</label>
                <input placeholder="Enter email" type="email" name="email">
            </div>
            <div class="labels">
                <label for="profile-image">Profile</label>
                <input type="file" id="profile-image" name="profile-image">
            </div>
            <div class="labels">
                <label for="telephone">Telephone</label>
                <input placeholder="Enter telephone number" pattern="[0-9]{10,12}" type="text" name="telephone">
            </div>
            <div class="labels" id="gender">
                <label for="">Gender</label>
                <div class="radio">
                    <div class="mr-16 flex items-center">
                        <input id="gender1" type="radio" name="gender" value="Male">Male
                    </div>
                    <div class=" flex items-center">
                        <input id="gender2" type="radio" name="gender" value="Female">Female
                    </div>
                </div>

            </div>
            <div class="labels">
                <label for="Nationality">Nationality</label>
                <select name="nationality">
                    <option value="">--Select--</option>
                    <option value="Rwanda">Rwanda</option>
                    <option value="Kenya">Kenya</option>
                    <option value="South Africa">South Africa</option>
                    <option value="Nigeria">Nigeria</option>
                    <option value="Canada">Canada</option>
                    <option value="Algeria">Algeria</option>
                    <option value="USA">USA</option>
                    <option value="Uganda">Uganda</option>
                    <option value="Liberia">Liberia</option>
                    <option value="Senegal">Senegal</option>
                </select>
            </div>
            <div class="labels">
                <label for="username">Username</label>
                <input placeholder="Enter Username" type="text" name="username">
            </div>
            <div class="labels">
                <label for="password">Password</label>
                <input placeholder="Enter Password" type="password" name="password">
            </div>
            <div class="labels">
                <label for="confpass">Confirm Password</label>
                <input placeholder="Confirm password" type="password" name="cpassword">
            </div>
            <input class="bg-blue-500 font-bold text-white w-1/3 cursor-pointer" value="Submit" type="submit" name="submit">
        </form>

    </div>
</body>

</html>