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

    <title>Update account</title>
    <link rel="shortcut icon" href="picpi.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kurale&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <script defer src="https://cdn.tailwindcss.com"></script>
</head>
<?php

include './connection.php';
include './checkloggedin.php';
$sql = "SELECT * FROM users where user_id='$userid'";
$select  = mysqli_query($connection, $sql) or die(mysqli_error($connection));

if ($select == TRUE) {
    $count = mysqli_num_rows($select);
    if ($count > 0) {
        while ($rows = mysqli_fetch_assoc($select)) {
    ?>

            <body>
                <div class="neumorphism navbar shadow-2xl mb-8 p-2 w-full h-12  flex items-center justify-around">
                    <div class="flex items-center justify-center">
                        <img class="w-8 h-8" src="picpi.png" alt="">
                        <a href='home.php' class="picpi">PicPi</a>
                    </div>
                    <div>
                        <form action="search.php" method='POST' class="flex items-center justify-center">
                            <input required type="text" name='name' class="p-1 bg-[#ddd] rounded" placeholder="Search">
                            <button type="submit" name="search" class="btn btn-outline-primary material-icons text-md">search</button>
                        </form>
                    </div>
                    <ul class="flex flex-row items-center justify-center list-none">
                        <li class="mr-4 cursor-pointer"><a title="Home" class="bx bx-home-alt bx-sm" href="home.php"></a></li>

                        <li class="mr-4 cursor-pointer"><a title="Explore" class="bx bx-compass bx-sm" href="explore.php"></a></li>
                        <li class="mr-4 cursor-pointer"><a title="New post" class="bx bx-add-to-queue bx-sm" href="newpost.php"></a></li>
                        <li class="mr-4 cursor-pointer"><i class='bx bx-bell bx-sm'></i></li>
                        <li class="mr-4 cursor-pointer"><a title="Messages" href="users.php" class="material-icons">send</a></li>

                        <li class="mr-4 cursor-pointer">
                            <form action="logout.php" method="GET"><button title="Logout" class="material-icons" name="logout" type="submit">logout</button></form>
                        </li>
                        <li class="mr-4 cursor-pointer"><a href="account.php"><img src="<?= $rows['profile'] ?>" class="object-cover w-10 h-10 rounded-full" alt=""></a></li>
                    </ul>
                </div>
                <div class="m-auto mt-32 formupdate neumorphism flex flex-col w-4/12 p-4 box-border">
                    <h2 class="heading-2">Update PicPi account</h2>
                    <form action="processupdate.php" class="w-full flex flex-col items-center justify-center" method="post" enctype='multipart/form-data'>
                        <div class="w-full flex justify-between items-center mt-1">
                            <label for="">First Name</label>
                            <input class="rounded p-1 w-2/3" type="text" id="firstname" value="<?php echo $rows['firstname']; ?>" name="firstname">
                        </div>
                        <div class="w-full flex justify-between items-center mt-1">
                            <label for="">Last Name</label>
                            <input class="rounded p-1 w-2/3" type="text" name="lastname" value="<?php echo $rows['lastname']; ?>">
                        </div>
                        <div class="w-full flex justify-between items-center mt-1">
                            <label for="">Email</label>
                            <input class="rounded p-1 w-2/3" type="email" name="email" value="<?php echo $rows['email']; ?>">
                        </div>
                        <div class="w-full flex justify-between items-center mt-1">
                            <label for="profile-image">Profile</label>
                            <input class="rounded p-1 w-2/3" type="file" id="profile-image" value="<?php echo $rows['profile']; ?>" name="profile-image">
                        </div>
                        <img class="object-cover" src="<?php echo $rows['profile']; ?>" class='profile' style='width:100px;height:100px;border-radius:50%;' alt="">
                        <div class="w-full flex justify-between items-center mt-1">
                            <label for="telephone">Telephone</label>
                            <input pattern="[0-9]{9,12}" type="text" name="telephone" value="<?php echo $rows['telephone']; ?>">
                        </div>
                        <?php if ($rows['gender'] == "Male") { ?>
                            <div class="labels flex justify-between items-center w-full" id="gender">
                                <label for="">Gender</label>
                                <div class="radio">
                                    <input id="gender1" class="rounded p-1 w-2/3" type="radio" name="gender" value="Male" checked>Male
                                    <input id="gender2" class="rounded p-1 w-2/3" type="radio" name="gender" value="Female">Female
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="labels flex justify-between items-center w-full" id="gender">
                                <label for="">Gender</label>
                                <div class="radio">
                                    <input id="gender1" class="rounded p-1 w-2/3" type="radio" name="gender" value="Male" checked>Male
                                    <input id="gender2" class="rounded p-1 w-2/3" type="radio" name="gender" value="Female">Female
                                </div>
                            </div>

                        <?php } ?>

                        <div class="w-full flex justify-between items-center mt-1">
                            <label for="Nationality">Nationality</label>
                            <select name="nationality">
                                <option>--Select--</option>
                                <?php
                                $nationalities = ["Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Anguilla", "Antigua &amp; Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia &amp; Herzegovina", "Botswana", "Brazil", "British Virgin Islands", "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Cape Verde", "Cayman Islands", "Chad", "Chile", "China", "Colombia", "Congo", "Cook Islands", "Costa Rica", "Cote D Ivoire", "Croatia", "Cruise Ship", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Estonia", "Ethiopia", "Falkland Islands", "Faroe Islands", "Fiji", "Finland", "France", "French Polynesia", "French West Indies", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guam", "Guatemala", "Guernsey", "Guinea", "Guinea Bissau", "Guyana", "Haiti", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Isle of Man", "Israel", "Italy", "Jamaica", "Japan", "Jersey", "Jordan", "Kazakhstan", "Kenya", "Kuwait", "Kyrgyz Republic", "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Mauritania", "Mauritius", "Mexico", "Moldova", "Monaco", "Mongolia", "Montenegro", "Montserrat", "Morocco", "Mozambique", "Namibia", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Norway", "Oman", "Pakistan", "Palestine", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russia", "Rwanda", "Saint Pierre &amp; Miquelon", "Samoa", "San Marino", "Satellite", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "South Africa", "South Korea", "Spain", "Sri Lanka", "St Kitts &amp; Nevis", "St Lucia", "St Vincent", "St. Lucia", "Sudan", "Suriname", "Swaziland", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Timor L'Este", "Togo", "Tonga", "Trinidad &amp; Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks &amp; Caicos", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "Uruguay", "Uzbekistan", "Venezuela", "Vietnam", "Virgin Islands (US)", "Yemen", "Zambia", "Zimbabwe"];
                                for ($i = 0; $i < count($nationalities); $i++) { ?>
                                    <option value="<?= $nationalities[$i] ?>" <?= ($rows['nationality'] == $nationalities[$i]) ? "selected" : "" ?>><?= $nationalities[$i] ?></option>
                                <?php } ?>
                            </select>
                        </div>


                        <div class="w-full flex justify-between items-center mt-1">
                            <label for="username">Username</label>
                            <input class="rounded p-1 w-2/3" type="text" name="username" value="<?php echo $rows['username']; ?>">
                        </div>
                        <input class="p-1 text-white rounded w-32 bg-blue-500 neumorphism" value="Update" type="submit" name="submit">
                    </form>

                </div>
            </body>

</html>
<?php
        }
    }
}
?>