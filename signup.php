<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="shortcut icon" href="picpi.png" type="image/x-icon">

    <link rel="stylesheet" href="signup.css">
</head>

<body>
    <div class="form">
        <h2 class="heading-2">Create account</h2>
        <form action="process.php" method="POST" enctype="multipart/form-data">
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
                <!-- [a-z]lower case -->
                <!-- [A-Z]uppercase case -->
                <!-- [A-Za-z0-9]alphanumeric -->
            </div>
            <div class="labels" id="gender">
                <label for="">Gender</label>
                <div class="radio">
                    <input type="radio" name="gender" value="Male">Male
                    <input type="radio" name="gender" value="Female">Female
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
            <input value="Submit" type="submit" name="submit">
        </form>

    </div>
</body>

</html>