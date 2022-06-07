<?php
include_once "./connection.php";
include './checkloggedin.php';
if (!isset($_COOKIE['PICPI-USERID'])) {
  header("location: ./../login.php");
}
?>
<?php include_once "header.php"; ?>

<body class="flex items-start justify-center">
  <div class="navbar bg-white fixed z-10 shadow-2xl mb-12 p-2 w-full h-12  flex items-center justify-around">
    <div class="flex items-center justify-center">
      <img class="w-8 h-8" src="picpi.png" alt="">
      <a href='home.php' class="picpi">PicPi</a>
    </div>
    <div>
      <form method="POST" action="search.php" class="flex items-center justify-center">
        <input required type="text" name='name' class="p-1 bg-[#ddd] rounded" placeholder="Search">
        <button type="submit" name="search" class="btn btn-outline-primary material-icons text-md">search</button>
      </form>
    </div>
    <ul class="flex flex-row items-center justify-center list-none">
      <li class="mr-4 cursor-pointer"><a title="Home" class="bx bx-home-alt bx-sm" href="home.php"></a></li>
      
      <li class="mr-4 cursor-pointer"><a title="New post" class="bx bx-add-to-queue bx-sm" href="newpost.php"></a></li>
      <li class="mr-4 cursor-pointer"><a href='activity.php' class='bx bx-bell bx-sm'></a></li>
      <li class="mr-4 cursor-pointer"><a title="Messages" href="users.php" class="material-icons">sms</a></li>
      <li class="mr-4 cursor-pointer">
        <form action="logout.php" method="GET"><button title="Logout" class="material-icons" name="logout" type="submit">logout</button></form>
      </li>
      <li class="mr-4 cursor-pointer"><a href="account.php"><img src="<?= $profile ?>" class="object-cover w-10 h-10 rounded-full" alt=""></a></li>
    </ul>
  </div>
  <div class="wrapper mt-32">
    <section class="chat-area">
      <header>
        <?php
        $user_id = $_GET['user_id'];
        $sql = mysqli_query($connection, "SELECT * FROM users WHERE user_id ='$user_id'");
        if (mysqli_num_rows($sql) > 0) {
          $row = mysqli_fetch_assoc($sql);
        } else {
          header("location: users.php");
        }
        ?>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="<?php echo $row['profile']; ?>" alt="">
        <div class="details">
          <a class="font-semibold text-xl" href="user.php?username=<?=$row['username']?>"><?php echo $row['firstname'] . " " . $row['lastname'] ?></a>
          <p><?php echo $row['status']; ?></p>
        </div>
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="javascript/chat.js"></script>

</body>

</html>