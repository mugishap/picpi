<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="global.css" rel="stylesheet">
    <title>Document</title>
    <link rel="shortcut icon" href="picpi.png" type="image/x-icon">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kurale&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="signup.css">
    <style>
        *{
        transition:ease all 0.5s;
    }
        @font-face {
            font-family: Source;
            src: url('css/fonts/SourceSansPro-Regular.ttf');
        }
        #truncate:hover,
        .addnew:hover {
            background-color: rgb(255 152 0);
        }
        #truncate {
            background-color: rgb(255 152 0 / 56%);;
            color: #fff;
            width: 100%;
            text-align: center;
            padding: 3px 0px;
            font-size: 1.2em;
            margin: 10px;
            height: 1.5em;
            border-radius: 5px;
            vertical-align: middle;
            border: none;
            box-shadow: 1px 5px 20px black;
        }
        body{
        background-color:white;
        display: flex;
        align-items: center;
        flex-direction: column;
        font-family: Source;
        }
        form{
            background-color: rgb(243, 243, 243);
        }
        a{
    text-decoration: none;
    }
    td a{
        background-color: rgba(0, 0, 0, 0.514);
        color: white;
        padding: 5px;
        border-radius: 5px;
        margin: 10px;
    }
    td a:hover{
        background-color: black;
    }


    table,
    td,
    th {
        border: 1px solid black;
        padding: 5px;
        
    }

    table {
        border-collapse: collapse;
    }
    .addnew {
            background-color: rgb(255 152 0 / 56%);;
            color: #fff;
            width: 20%;
            text-align: center;
            padding: 3px 0px;
            font-size: 1.2em;
            margin: 10px;
            height: 1.5em;
            border-radius: 5px;
            vertical-align: middle;
        }
        .profiles{
            border-radius:50%;
            object-fit: cover;
            object-position:center;
        }
        .table{
            background: #fff;
            border-radius:2em;
            padding:2em;
        }
    </style>
</head>

<body>
<a href="signup.php" class="addnew">Add user</a>
    <a href="viewuser.php" class="addnew">Search user</a>
    <a href="display.php" class="addnew">View other users</a>

    <div class="form">
        <h2 class="heading-2">SEARCH USER</h2>
        <form action="processread.php" method="post">
            <div class="labels">
                <label for="name">Enter username</label>
                <input placeholder="Enter username here" type="text" id="name" name="username">
            </div>
            <input value="Submit" type="submit" style='background-color: rgb(255 152 0);' name="submit">
        </form>
    </div>
    <div class="output">
        <?php
        include './connection.php';

        if (!$connection) {
            echo "Connection not successfull" . mysqli_connect_error();
        } else {
            if(!(isset($_POST['submit']))){
            }else{

            
                $username = $_GET['username'];
                $sql = "SELECT * FROM users WHERE username like '%$username%';";
                $read = mysqli_query($connection, $sql) or die("Error occured" . mysqli_error($connection));
            
        ?>
        <table>
        <thead>
                <tr>
                    <!-- <th>ID</th> -->
                    <th>Profile</th>
                    <th>FirstName</th>
                    <th>LastName</th>
                    <th>Gender</th>
                    <th>Username</th>
                    <th>email</th>
                    <th>Nationality</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
                <?php 
                    while($row = mysqli_fetch_assoc($read)){
                ?>

                <tr>
                    <!-- <td><?php echo $row['user_id'] ?></td> -->
                    <td><img src="<?php echo $row['profile'] ?>" width=50 height=50 class='profiles' alt=""></td>
                    <td><?php  echo  $row['firstName']; ?></td>
                    <td><?php  echo $row['lastName']; ?></td>
                    <td><?php  echo  $row['gender'];  ?></td>
                    <td><?php   echo $row['username']; ?></td>
                    <td><?php  echo $row['email']; ?></td>
                    <td><?php echo $row['nationality'];; ?></td>
                    <td><a href="edituser.php?id=<?php echo $row['user_id'];?>">Update</a></td>
                    <td><a href="processdelete.php?id=<?php echo $row['user_id'];?>">Delete</a></td>
                </tr>
             <?php 
                   }                   
                }  
            };
             ?>
        </table>
    </div>
</body>

</html>