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


    <title>All users</title>
    <link rel="shortcut icon" href="picpi.png" type="image/x-icon">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- <link rel="stylesheet" href="\css\display.css"> -->
    <style>
            *{
        transition:ease all 0.5s;
    }
        @font-face {
            font-family: Source;
            src: url('css/fonts/SourceSansPro-Regular.ttf');
        }
        body {
            background-color: #dbdbdb;
            display: flex;
            align-items: center;
            flex-direction: column;
            font-family: Source;
        }
        a {
            text-decoration: none;
        }

        table,
        td,
        th {
            /* border: 1px solid rgb(255 152 0); */
            padding: 15px;
        }
        
        table {
            border-collapse: collapse;

        }
        .table{
            background: #fff;
            border-radius:2em;
            padding:2em;
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
        }
        form {
            width: 20%;
            vertical-align: middle;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0px;
        }
        .profiles{
            border-radius:50%;
            object-fit: cover;
            object-position:top;
        }

</style>
</head>

<body>
    <?php

include './connection.php';
    if (!$connection) {
        echo "Connection not successfull" . mysqli_connect_error();
    } else {
        $sql = "SELECT * FROM users;";
        $select = mysqli_query($connection, $sql) or die("Error occured" . mysqli_error($connection));

    ?>
    <a href="signup.php" class="addnew">Add user</a>
    <a href="viewuser.php" class="addnew">Search user</a>
     <a href="login.php" class="addnew">Logout</a>
    <form action="deleteall.php"><input type="submit" value="Delete all users" id="truncate"></form>
    <div class="table">
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

            while ($row = mysqli_fetch_assoc($select)) {

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
                    <td><a href="edituser.php?id=<?php echo $row['user_id'];?>"><i style='color:blue;' class="material-icons">note_alt</i></a></td>
                    <td><a href="processdelete.php?id=<?php echo $row['user_id'];?>"><i style='color:red;' class="material-icons">delete_outline</i></a></td>
                </tr>
        
<?php
        };
    };
?>
</table>
</div>
</body>

</html>