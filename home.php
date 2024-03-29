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

    <title>Home | PicPi</title>

    <link rel="shortcut icon" href="picpi.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kurale&family=Ubuntu:wght@300&display=swap" rel="stylesheet">

</head>

<body class="flex flex-col items-center">

    <?php
    include './connection.php';
    include './checkloggedin.php';
    $today = date("Y-m-d H:M:S");

    $query = mysqli_query($connection, 'SELECT * FROM posts ORDER BY count DESC');
    ?>
    <div class="navbar bg-white fixed z-10 shadow-2xl mb-8 p-2 w-full h-12  flex items-center justify-around">
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
            <li class="mr-4 cursor-pointer"><a title="Explore" class="bx bx-compass bx-sm" href="explore.php"></a></li>
            <li class="mr-4 cursor-pointer"><a title="New post" class="bx bx-add-to-queue bx-sm" href="newpost.php"></a></li>
            <li class="mr-4 cursor-pointer"><a href='activity.php' class='bx bx-bell bx-sm'></a></li>
            <li class="mr-4 cursor-pointer"><a title="Messages" href="users.php" class="material-icons">send</a></li>
            <li class="mr-4 cursor-pointer">
                <form action="logout.php" method="GET"><button title="Logout" class="material-icons" name="logout" type="submit">logout</button></form>
            </li>
            <li class="mr-4 cursor-pointer"><a href="account.php"><img src="<?= $profile ?>" class="object-cover w-10 h-10 rounded-full" alt=""></a></li>
        </ul>
    </div>

    <div class="mt-24 neumorphism overflow-x-scroll flex rounded-xl m-1 sm:w-6/12 w-10/12 md:w-4/12 h-36 p-2">
        <a href="newstory.php">
            <div class="flex items-end justify-center addstory h-32 w-24 p-1 m-1 rounded">
                <i title="Create a new story" class='bg-blue-400 p-1 rounded text-white w-full flex items-center justify-center text-center bx bx-tada-hover bx-sm bxs-image-add'></i>
            </div>
        </a>
        <?php
        $getStories = mysqli_query($connection, "SELECT * FROM stories ORDER BY count DESC");
        while (list($storyid, $storyPosterID, $postdate, $storyPosterUsername, $storyPosterProfile, $storyText, $media, $storyType, $removedate) = mysqli_fetch_array($getStories)) {
        ?>
            <div class="flex items-end justify-center addstory h-32 w-24 p-1 m-1 rounded">
                <?php
                if ($storyType == 'video') {
                ?>
                    <video onclick="popup('<?= $storyPosterProfile ?>','<?= $storyPosterUsername ?>','<?= $media ?>', '<?= $storyText ?>','<?= $storyid ?>', '<?= $storyType ?>')" class="w-full h-full object-cover rounded" src="<?= $media ?>" alt=""></video>
                <?php
                } else if ($storyType == 'image') {
                ?>
                    <img onclick="popup('<?= $storyPosterProfile ?>','<?= $storyPosterUsername ?>','<?= $media ?>','<?= $storyText ?>','<?= $storyid ?>', '<?= $storyType ?>')" class="w-full h-full object-cover rounded" src="<?= $media ?>" alt="">

                <?php
                }
                ?>
            </div>
        <?php
        }
        // $dateTimestamp1 = strtotime($postdate);
        // $dateTimestamp2 = strtotime($removedate);
        // $today = date('Y:m:d');
        // if ($today != $dateTimestamp1) {
        //     echo "$today is older than $postdate";
        //     // $deleteStoryQuery = mysqli_query($connection,"DELETE FROM stories()");
        // } else
        //     echo "$postdate is older than $removedate";

        ?>

    </div>
    <a class="mt-2 mb-8" href="newpost.php"><button class="text-white rounded bg-blue-500 p-2 w-48 hover:bg-blue-600">Create new post</button></a>
    <?php

    while (list($postid,$posterID, $count, $time, $posterusername, $posterprofile, $caption, $image, $type) = mysqli_fetch_array($query)) {
        $getLikes = mysqli_query($connection, "SELECT likerusername,liker_profile FROM likes WHERE post_id='$postid' LIMIT 1");
        list($likerusername, $liker_profile) = mysqli_fetch_array($getLikes);
        $newComm = "SELECT c.comment_id,c.comment_time,c.commenter_username,c.comment,u.profile FROM comments c INNER JOIN users u ON u.username=c.commenter_username  WHERE post_id='$postid' ORDER BY c.comment_id DESC";
        $getComments = mysqli_query($connection, $newComm) or die(mysqli_error($connection));
        if ($today === $time) {
            $time = 'Today';
        }
        $getCommentCount = mysqli_query($connection, "SELECT COUNT(c.comment_id) FROM comments c WHERE post_id='$postid'");
        list($commentCount) = mysqli_fetch_array($getCommentCount);

    ?>

        <div id="post<?= $postid ?>" key='<?= $postid ?>' class="neumorphism rounded-xl m-1 sm:w-6/12 w-10/12 md:w-4/12 h-64 p-3">
            <div class="flex w-full items-center justify-start">
                <div class="flex w-2/5 items-center justify-start">
                    <img class="object-cover m-2 w-10 h-10 rounded-full  " src='<?= $posterprofile ?>'>
                    <a href="user.php?username=<?= $posterusername ?>"><?= $posterusername ?></a>
                </div>
                <div class="w-3/5 flex items-center justify-end">
                    <?php
                    if ($username === $posterusername) {
                    ?>
                        <a href="editpost.php?postid=<?= $postid ?>" class="bx bx-edit p-2 bg-blue-400 m-1 bx-tada-hover rounded-full cursor-pointer"></a>
                        <form method="POST" action="?postid=<?= $postid ?>"><button type="submit" name="deletepostfromhome" class="material-icons p-1  m-1 shadow-2xl shadow-black bx-tada-hover bg-red-400 rounded-full cursor-pointer">delete</button></form>
                        <?php
                    } else {
                        $knowIfFollowing = mysqli_query($connection, "SELECT following_username from following_$username");
                        $followingArray = [];
                        $following = false;
                        while ($arr = mysqli_fetch_assoc($knowIfFollowing)) {
                            array_push($followingArray, $arr['following_username']);
                        }
                        for ($i = 0; $i < count($followingArray); $i++) {
                            if ($followingArray[$i] === $posterusername) {
                                $following = true;
                            }
                        }
                        if ($following) {
                        ?>
                            <button onclick="follow(this,'<?= $posterusername ?>')" class="bg-blue-500 rounded p-1 w-32 text-white m-1">Unfollow</button>
                        <?php
                        } else {
                        ?>
                            <button onclick="follow(this,'<?= $posterusername ?>')" class="bg-blue-500 rounded p-1 w-32 text-white m-1">Follow</button>
                        <?php
                        }
                        ?>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <?php
            if ($type == 'image') {
            ?>
                <img class=" object-cover rounded-xl mb-1 mt-1 h-[50vh] w-full" src='<?= $image ?>'>
            <?php
            } else if ($type == 'video') {
            ?>
                <video loop controls class=" object-cover rounded-xl mb-1 mt-1 h-[70vh] w-full" src='<?= $image ?>'></video>
            <?php
            } else if ($type == 'audio') {
            ?>
                <audio src=""></audio>
            <?php

            }
            ?>
            <p class="text-gray-500 mt-2"><?= $time ?></p>
            <p><?= $caption ?></p>
            <?php
            if (mysqli_num_rows($getLikes) !== 0) {
            ?>
                <div class="w-full flex items-center justify-start m-2">
                    <?php
                    if ($likerusername === $username) {
                    ?>
                        <img class="object-cover w-8 h-8 rounded-full" src="<?= $liker_profile ?>" alt="">
                        <p class="mt-4 text-xs text-gray-500">Liked by you</p>
                    <?php
                    } else {
                    ?>
                        <img class="object-cover w-8 h-8 rounded-full" src="<?= $liker_profile ?>" alt="">
                        <p class="mt-4 text-xs text-gray-500">Liked by <?= $likerusername ?></p>
                    <?php
                    }
                    ?>

                </div>
            <?php
            }
            ?>
            <div class="w-full mt-3 mb-3 flex items-center justify-around">
                <?php

                $getIfLiked = mysqli_query($connection, "SELECT liker_id from likes WHERE post_id='$postid' AND likerusername='$username'");
                list($fetchedIdOfLiker) = mysqli_fetch_array($getIfLiked);
                if ($userid === $fetchedIdOfLiker) {
                ?>
                    <i onclick="liking(this,'<?= $postid ?>')" class='bx bx-sm bxs-like w-1/2 h-full rounded hover:bg-blue-200 text-center box-border p-2 cursor-pointer'></i>
                <?php
                } else {
                ?>
                    <i onclick="liking(this,'<?= $postid ?>')" class='bx bx-sm bx-like w-1/2 h-full rounded hover:bg-blue-200 text-center box-border p-2 cursor-pointer'></i>
                <?php
                }
                ?>
                <div class='w-1/2 flex items-center justify-center'>
                    <i onclick='focuscomment("comment<?= $postid ?>")' class='bx bx-sm bx-comment w-fit h-full rounded hover:bg-blue-200 text-center box-border p-2 cursor-pointer'></i>
                    <p class=''><?= $commentCount ?></p>
                </div>

            </div>
            <form action="?postid=<?= $postid ?>&userid=<?= $userid ?>&username='<?= $username ?>'" method="POST" class="w-full">
                <!-- <div class="emojis-home w-8">
                    <div class="w-48 emoji-holder-home grid-cols-7 h-48 overflow-y-scroll neumorphism p-1 fixed  rounded">
                        <?php
                        $emojis = ["😀", "😁", "😂", "😃", "😄", "😅", "😆", "😇", "😈", "👿", "😉", "😊", "😋", "😌", "😍", "😎", "😏", "😐", "😑", "😒", "😓", "😔", "😕", "😖", "😗", "😘", "😙", "😚", "😛", "😜", "😝", "😞", "😟", "😠", "😡", "😢", "😣", "😤", "😥", "😦", "😧", "😨", "😩", "😪", "😫", "😬", "😭", "😮", "😯", "😰", "😱", "😲", "😳", "😴", "😵", "😶", "😷", "😸", "😹", "😺", "😻", "😼", "😽", "😾", "😿", "🙀", "👣", "👤", "👥", "👶", "👶🏻", "👶🏼", "👶🏽", "👶🏾", "👶🏿", "👦", "👦🏻", "👦🏼", "👦🏽", "👦🏾", "👦🏿", "👧", "👧🏻", "👧🏼", "👧🏽", "👧🏾", "👧🏿", "👨", "👨🏻", "👨🏼", "👨🏽", "👨🏾", "👨🏿", "👩", "👩🏻", "👩🏼", "👩🏽", "👩🏾", "👩🏿", "👪", "👨‍👩‍👧", "👨‍👩‍👧‍👦", "👨‍👩‍👦‍👦", "👨‍👩‍👧‍👧", "👩‍👩‍👦", "👩‍👩‍👧", "👩‍👩‍👧‍👦", "👩‍👩‍👦‍👦", "👩‍👩‍👧‍👧", "👨‍👨‍👦", "👨‍👨‍👧", "👨‍👨‍👧‍👦", "👨‍👨‍👦‍👦", "👨‍👨‍👧‍👧", "👫", "👬", "👭", "👯", "👰", "👰🏻", "👰🏼", "👰🏽", "👰🏾", "👰🏿", "👱", "👱🏻", "👱🏼", "👱🏽", "👱🏾", "👱🏿", "👲", "👲🏻", "👲🏼", "👲🏽", "👲🏾", "👲🏿", "👳", "👳🏻", "👳🏼", "👳🏽", "👳🏾", "👳🏿", "👴", "👴🏻", "👴🏼", "👴🏽", "👴🏾", "👴🏿", "👵", "👵🏻", "👵🏼", "👵🏽", "👵🏾", "👵🏿", "👮", "👮🏻", "👮🏼", "👮🏽", "👮🏾", "👮🏿", "👷", "👷🏻", "👷🏼", "👷🏽", "👷🏾", "👷🏿", "👸", "👸🏻", "👸🏼", "👸🏽", "👸🏾", "👸🏿", "💂", "💂🏻", "💂🏼", "💂🏽", "💂🏾", "💂🏿", "👼", "👼🏻", "👼🏼", "👼🏽", "👼🏾", "👼🏿", "🎅", "🎅🏻", "🎅🏼", "🎅🏽", "🎅🏾", "🎅🏿", "👻", "👹", "👺", "💩", "💀", "👽", "👾", "🙇", "🙇🏻", "🙇🏼", "🙇🏽", "🙇🏾", "🙇🏿", "💁", "💁🏻", "💁🏼", "💁🏽", "💁🏾", "💁🏿", "🙅", "🙅🏻", "🙅🏼", "🙅🏽", "🙅🏾", "🙅🏿", "🙆", "🙆🏻", "🙆🏼", "🙆🏽", "🙆🏾", "🙆🏿", "🙋", "🙋🏻", "🙋🏼", "🙋🏽", "🙋🏾", "🙋🏿", "🙎", "🙎🏻", "🙎🏼", "🙎🏽", "🙎🏾", "🙎🏿", "🙍", "🙍🏻", "🙍🏼", "🙍🏽", "🙍🏾", "🙍🏿", "💆", "💆🏻", "💆🏼", "💆🏽", "💆🏾", "💆🏿", "💇", "💇🏻", "💇🏼", "💇🏽", "💇🏾", "💇🏿", "💑", "👩‍❤️‍👩", "👨‍❤️‍👨", "💏", "👩‍❤️‍💋‍👩", "👨‍❤️‍💋‍👨", "🙌", "🙌🏻", "🙌🏼", "🙌🏽", "🙌🏾", "🙌🏿", "👏", "👏🏻", "👏🏼", "👏🏽", "👏🏾", "👏🏿", "👂", "👂🏻", "👂🏼", "👂🏽", "👂🏾", "👂🏿", "👀", "👃", "👃🏻", "👃🏼", "👃🏽", "👃🏾", "👃🏿", "👄", "💋", "👅", "💅", "💅🏻", "💅🏼", "💅🏽", "💅🏾", "💅🏿", "👋", "👋🏻", "👋🏼", "👋🏽", "👋🏾", "👋🏿", "👍", "👍🏻", "👍🏼", "👍🏽", "👍🏾", "👍🏿", "👎", "👎🏻", "👎🏼", "👎🏽", "👎🏾", "👎🏿", "☝", "☝🏻", "☝🏼", "☝🏽", "☝🏾", "☝🏿", "👆", "👆🏻", "👆🏼", "👆🏽", "👆🏾", "👆🏿", "👇", "👇🏻", "👇🏼", "👇🏽", "👇🏾", "👇🏿", "👈", "👈🏻", "👈🏼", "👈🏽", "👈🏾", "👈🏿", "👉", "👉🏻", "👉🏼", "👉🏽", "👉🏾", "👉🏿", "👌", "👌🏻", "👌🏼", "👌🏽", "👌🏾", "👌🏿", "✌", "✌🏻", "✌🏼", "✌🏽", "✌🏾", "✌🏿", "👊", "👊🏻", "👊🏼", "👊🏽", "👊🏾", "👊🏿", "✊", "✊🏻", "✊🏼", "✊🏽", "✊🏾", "✊🏿", "✋", "✋🏻", "✋🏼", "✋🏽", "✋🏾", "✋🏿", "💪", "💪🏻", "💪🏼", "💪🏽", "💪🏾", "💪🏿", "👐", "👐🏻", "👐🏼", "👐🏽", "👐🏾", "👐🏿", "🙏", "🙏🏻", "🙏🏼", "🙏🏽", "🙏🏾", "🙏🏿", "🌱", "🌲", "🌳", "🌴", "🌵", "🌷", "🌸", "🌹", "🌺", "🌻", "🌼", "💐", "🌾", "🌿", "🍀", "🍁", "🍂", "🍃", "🍄", "🌰", "🐀", "🐁", "🐭", "🐹", "🐂", "🐃", "🐄", "🐮", "🐅", "🐆", "🐯", "🐇", "🐰", "🐈", "🐱", "🐎", "🐴", "🐏", "🐑", "🐐", "🐓", "🐔", "🐤", "🐣", "🐥", "🐦", "🐧", "🐘", "🐪", "🐫", "🐗", "🐖", "🐷", "🐽", "🐕", "🐩", "🐶", "🐺", "🐻", "🐨", "🐼", "🐵", "🙈", "🙉", "🙊", "🐒", "🐉", "🐲", "🐊", "🐍", "🐢", "🐸", "🐋", "🐳", "🐬", "🐙", "🐟", "🐠", "🐡", "🐚", "🐌", "🐛", "🐜", "🐝", "🐞", "🐾", "⚡️", "🔥", "🌙", "☀️", "⛅️", "☁️", "💧", "💦", "☔️", "💨", "❄️", "🌟", "⭐️", "🌠", "🌄", "🌅", "🌈", "🌊", "🌋", "🌌", "🗻", "🗾", "🌐", "🌍", "🌎", "🌏", "🌑", "🌒", "🌓", "🌔", "🌕", "🌖", "🌗", "🌘", "🌚", "🌝", "🌛", "🌜", "🌞", "🍅", "🍆", "🌽", "🍠", "🍇", "🍈", "🍉", "🍊", "🍋", "🍌", "🍍", "🍎", "🍏", "🍐", "🍑", "🍒", "🍓", "🍔", "🍕", "🍖", "🍗", "🍘", "🍙", "🍚", "🍛", "🍜", "🍝", "🍞", "🍟", "🍡", "🍢", "🍣", "🍤", "🍥", "🍦", "🍧", "🍨", "🍩", "🍪", "🍫", "🍬", "🍭", "🍮", "🍯", "🍰", "🍱", "🍲", "🍳", "🍴", "🍵", "☕️", "🍶", "🍷", "🍸", "🍹", "🍺", "🍻", "🍼", "🎀", "🎁", "🎂", "🎃", "🎄", "🎋", "🎍", "🎑", "🎆", "🎇", "🎉", "🎊", "🎈", "💫", "✨", "💥", "🎓", "👑", "🎎", "🎏", "🎐", "🎌", "🏮", "💍", "❤️", "💔", "💌", "💕", "💞", "💓", "💗", "💖", "💘", "💝", "💟", "💜", "💛", "💚", "💙", "🏃", "🏃🏻", "🏃🏼", "🏃🏽", "🏃🏾", "🏃🏿", "🚶", "🚶🏻", "🚶🏼", "🚶🏽", "🚶🏾", "🚶🏿", "💃", "💃🏻", "💃🏼", "💃🏽", "💃🏾", "💃🏿", "🚣", "🚣🏻", "🚣🏼", "🚣🏽", "🚣🏾", "🚣🏿", "🏊", "🏊🏻", "🏊🏼", "🏊🏽", "🏊🏾", "🏊🏿", "🏄", "🏄🏻", "🏄🏼", "🏄🏽", "🏄🏾", "🏄🏿", "🛀", "🛀🏻", "🛀🏼", "🛀🏽", "🛀🏾", "🛀🏿", "🏂", "🎿", "⛄️", "🚴", "🚴🏻", "🚴🏼", "🚴🏽", "🚴🏾", "🚴🏿", "🚵", "🚵🏻", "🚵🏼", "🚵🏽", "🚵🏾", "🚵🏿", "🏇", "🏇🏻", "🏇🏼", "🏇🏽", "🏇🏾", "🏇🏿", "⛺️", "🎣", "⚽️", "🏀", "🏈", "⚾️", "🎾", "🏉", "⛳️", "🏆", "🎽", "🏁", "🎹", "🎸", "🎻", "🎷", "🎺", "🎵", "🎶", "🎼", "🎧", "🎤", "🎭", "🎫", "🎩", "🎪", "🎬", "🎨", "🎯", "🎱", "🎳", "🎰", "🎲", "🎮", "🎴", "🃏", "🀄️", "🎠", "🎡", "🎢", "🚃", "🚞", "🚂", "🚋", "🚝", "🚄", "🚅", "🚆", "🚇", "🚈", "🚉", "🚊", "🚌", "🚍", "🚎", "🚐", "🚑", "🚒", "🚓", "🚔", "🚨", "🚕", "🚖", "🚗", "🚘", "🚙", "🚚", "🚛", "🚜", "🚲", "🚏", "⛽️", "🚧", "🚦", "🚥", "🚀", "🚁", "✈️", "💺", "⚓️", "🚢", "🚤", "⛵️", "🚡", "🚠", "🚟", "🛂", "🛃", "🛄", "🛅", "💴", "💶", "💷", "💵", "🗽", "🗿", "🌁", "🗼", "⛲️", "🏰", "🏯", "🌇", "🌆", "🌃", "🌉", "🏠", "🏡", "🏢", "🏬", "🏭", "🏣", "🏤", "🏥", "🏦", "🏨", "🏩", "💒", "⛪️", "🏪", "🏫", "🇦🇺", "🇦🇹", "🇧🇪", "🇧🇷", "🇨🇦", "🇨🇱", "🇨🇳", "🇨🇴", "🇩🇰", "🇫🇮", "🇫🇷", "🇩🇪", "🇭🇰", "🇮🇳", "🇮🇩", "🇮🇪", "🇮🇱", "🇮🇹", "🇯🇵", "🇰🇷", "🇲🇴", "🇲🇾", "🇲🇽", "🇳🇱", "🇳🇿", "🇳🇴", "🇵🇭", "🇵🇱", "🇵🇹", "🇵🇷", "🇷🇺", "🇸🇦", "🇸🇬", "🇿🇦", "🇪🇸", "🇸🇪", "🇨🇭", "🇹🇷", "🇬🇧", "🇺🇸", "🇦🇪", "🇻🇳", "⌚️", "📱", "📲", "💻", "⏰", "⏳", "⌛️", "📷", "📹", "🎥", "📺", "📻", "📟", "📞", "☎️", "📠", "💽", "💾", "💿", "📀", "📼", "🔋", "🔌", "💡", "🔦", "📡", "💳", "💸", "💰", "💎", "🌂", "👝", "👛", "👜", "💼", "🎒", "💄", "👓", "👒", "👡", "👠", "👢", "👞", "👟", "👙", "👗", "👘", "👚", "👕", "👔", "👖", "🚪", "🚿", "🛁", "🚽", "💈", "💉", "💊", "🔬", "🔭", "🔮", "🔧", "🔪", "🔩", "🔨", "💣", "🚬", "🔫", "🔖", "📰", "🔑", "✉️", "📩", "📨", "📧", "📥", "📤", "📦", "📯", "📮", "📪", "📫", "📬", "📭", "📄", "📃", "📑", "📈", "📉", "📊", "📅", "📆", "🔅", "🔆", "📜", "📋", "📖", "📓", "📔", "📒", "📕", "📗", "📘", "📙", "📚", "📇", "🔗", "📎", "📌", "✂️", "📐", "📍", "📏", "🚩", "📁", "📂", "✒️", "✏️", "📝", "🔏", "🔐", "🔒", "🔓", "📣", "📢", "🔈", "🔉", "🔊", "🔇", "💤", "🔔", "🔕", "💭", "💬", "🚸", "🔍", "🔎", "🚫", "⛔️", "📛", "🚷", "🚯", "🚳", "🚱", "📵", "🔞", "🉑", "🉐", "💮", "㊙️", "㊗️", "🈴", "🈵", "🈲", "🈶", "🈚️", "🈸", "🈺", "🈷", "🈹", "🈳", "🈂", "🈁", "🈯️", "💹", "❇️", "✳️", "❎", "✅", "✴️", "📳", "📴", "🆚", "🅰", "🅱", "🆎", "🆑", "🅾", "🆘", "🆔", "🅿️", "🚾", "🆒", "🆓", "🆕", "🆖", "🆗", "🆙", "🏧", "♈️", "♉️", "♊️", "♋️", "♌️", "♍️", "♎️", "♏️", "♐️", "♑️", "♒️", "♓️", "🚻", "🚹", "🚺", "🚼", "♿️", "🚰", "🚭", "🚮", "▶️", "◀️", "🔼", "🔽", "⏩", "⏪", "⏫", "⏬", "➡️", "⬅️", "⬆️", "⬇️", "↗️", "↘️", "↙️", "↖️", "↕️", "↔️", "🔄", "↪️", "↩️", "⤴️", "⤵️", "🔀", "🔁", "🔂", "#⃣", "0⃣", "1⃣", "2⃣", "3⃣", "4⃣", "5⃣", "6⃣", "7⃣", "8⃣", "9⃣", "🔟", "🔢", "🔤", "🔡", "🔠", "ℹ️", "📶", "🎦", "🔣", "➕", "➖", "〰", "➗", "✖️", "✔️", "🔃", "™", "©", "®", "💱", "💲", "➰", "➿", "〽️", "❗️", "❓", "❕", "❔", "‼️", "⁉️", "❌", "⭕️", "💯", "🔚", "🔙", "🔛", "🔝", "🔜", "🌀", "Ⓜ️", "⛎", "🔯", "🔰", "🔱", "⚠️", "♨️", "♻️", "💢", "💠", "♠️", "♣️", "♥️", "♦️", "☑️", "⚪️", "⚫️", "🔘", "🔴", "🔵", "🔺", "🔻", "🔸", "🔹", "🔶", "🔷", "▪️", "▫️", "⬛️", "⬜️", "◼️", "◻️", "◾️", "◽️", "🔲", "🔳", "🕐", "🕑", "🕒", "🕓", "🕔", "🕕", "🕖", "🕗", "🕘", "🕙", "🕚", "🕛", "🕜", "🕝", "🕞", "🕟", "🕠", "🕡", "🕢", "🕣", "🕤", "🕥", "🕦", "🕧"];
                        for ($i = 0; $i < count($emojis); $i++) {
                        ?>
                            <p class="m-[1px] hover:bg-blue-300 relative cursor-pointer rounded" onclick="addemoji(this)"><?= $emojis[$i] ?></p>
                        <?php
                        }
                        ?>
                    </div>
                    <i class="material-icons p-1 rounded-full cursor-pointer neumorphism">mood</i>
                </div> -->
                <input id='comment<?= $postid ?>' required type="text" name="comment-text" class="thecommentarea w-3/5 bg-gray-300 rounded p-2" placeholder="Comment here">
                <button type="submit" name='comment' class="2/5 rounded bg-blue-500 hover:bg-blue-600 text-white p-2 w-32">Send</button>
            </form>
            <div>
                <?php
                while (list($commentid, $commenttime, $commenterusername, $commenttext, $commenterprofile) = mysqli_fetch_array($getComments)) {
                ?>
                    <div class="w-10/12 relative flex items-center justify-around  rounded m-2 box-border">
                        <div class="w-16 h-16 rounded-full neumorphism flex items-center justify-center">
                            <img class="w-12 h-12 rounded-full object-cover" src="<?= $commenterprofile ?>" alt="">
                        </div>
                        <div class="w-2/3 neumorphism rounded text-sm flex flex-col items-start justify-center pt-1 pb-1 pr-3 pl-4">
                            <a class='font-bold' href="user.php?username=<?= $commenterusername ?>"><?= $commenterusername ?></a>
                            <p><?= $commenttext ?></p>
                            <p class="text-xs text-gray-600"><?= $commenttime ?></p>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
        <?php
    }
    if (isset($_POST['comment'])) {
        $comment = $_POST['comment-text'];
        if ($comment === '') {
        ?>
            <script>
                swal('Error', 'You should add a comment', 'error', {
                    buttons: false,
                    timer: 1500
                })
            </script>
        <?php
        }
        echo $postid;
        $postid = $_GET['postid'];
        $username = $_GET['username'];
        $commentQuery = "INSERT INTO comments(post_id,commenter_id,commenter_username,comment) VALUES('$postid','$userid',$username,'$comment')";
        // echo $commentQuery; 
        $addComment = mysqli_query($connection, $commentQuery) or die(mysqli_error($connection));
        $addToPosterActivity = mysqli_query($connection, "INSERT INTO activity_$posterusername(activity_comment,related) VALUES('$username commented on your post','$postid')");
        $addToCommenterActivity = mysqli_query($connection,"INSERT INTO activity_$username(activity_comment,related) VALUES('You commented on a post from $posterusername','$postid')");
        if ($addComment) {
        ?>
            <script>
                window.location.replace('/picpi/home.php#post<?= $postid ?>')
            </script>
    <?php
        }
    }
    if (isset($_POST['deletepostfromhome'])) {
        $postid = $_GET['postid'];
        $deletePostQuery = "DELETE FROM posts WHERE post_id='$postid'";
        $performDeleteQuery = mysqli_query($connection, $deletePostQuery);
        if ($performDeleteQuery) {
            header("Location: ./home.php");
        } else {
            return;
        }
    }
    ?>
    <div class="theoverlay flex-col w-screen fixed z-100 bg-[#00000057] h-screen items-center justify-center " style="display: none;">

</body>
<script>
    console.log("%cLOADED THE HOME PAGE", "font-size:3em;color:green;")
    const popup = (storyPosterProfile, storyPosterUsername, src, text, postid, type) => {
        const overlay = document.querySelector('.theoverlay')
        overlay.style.display = 'flex'
        if (type === 'image') {
            const post = document.querySelector('.post')
            overlay.innerHTML = `
            <div class="flex flex-col items-center h-4/5 mt-16 justify-center p-4 box-border bg-white rounded w-4/12">
                <div class='w-full h-2/12 flex items-center justify-between'>
                    <div class='w-8/12 h-full flex items-start justify-center'>
                        <a href='user.php?username=${storyPosterUsername}' class='flex items-center justify-start w-full h-full'>
                            <img src="${storyPosterProfile}" class='rounded-full w-16 h-16' />
                            <p class='text-xl font-semibold ml-4'>${storyPosterUsername}</p>
                        </a>
                    </div>
                    <i class="w-4/12 h-5 text-center flex items-baseline justify-center material-icons cursor-pointer" style="font-size:2em;" onclick="removepopup()">close</i>   
                </div>   
                <img class="w-full h-8/12" src="${src}" alt="" />
                <p>${text}</p>
            </div>
                `
        } else if (type === 'video') {
            const post = document.querySelector('.post')
            overlay.innerHTML = `
            <div class="flex flex-col items-center h-4/5 mt-16 justify-center p-4 box-border bg-white rounded w-4/12">
                <div class='w-full h-2/12 flex items-center justify-between'>
                    <div class='w-8/12 h-full m-1 flex items-start justify-center'>
                        <a href='user.php?username=${storyPosterUsername}' class='flex items-center justify-start w-full h-full'>
                            <img src="${storyPosterProfile}" class='rounded-full w-16 h-16' />
                            <p class='text-xl font-semibold ml-4'>${storyPosterUsername}</p>
                        </a>
                    </div>
                    <i class="w-4/12 h-5 text-center flex items-baseline justify-center material-icons cursor-pointer" style="font-size:2em;" onclick="removepopup()">close</i>   
                </div>   
                <video loop controls class="w-full h-8/12" src="${src}"></video>
                <p>${text}</p>
            </div>
            `
        }
    }
    const removepopup = () => {
        const overlay = document.querySelector('.theoverlay')
        overlay.innerHTML = ''
        overlay.style.display = 'none'
    }
    async function follow(e, toFollowUsername) {
        const text = e.textContent
        text === 'Follow' ?
            (async () => {
                e.textContent = 'Unfollow'
                var formData = new FormData();
                formData.append("toFollowUsername", toFollowUsername);
                formData.append("status", "follow");
                const api = await fetch('follow.php', {
                    method: 'POST',
                    // headers:{'Content-Type':'application/x-www-form-urlencoded'},    
                    body: formData
                })
                // const response = await api.json()
            })() :
            (async () => {
                e.textContent = 'Follow'
                const text = e.textContent
                text === 'Unfollow'
                var formData = new FormData();
                formData.append("toFollowUsername", toFollowUsername);
                formData.append("status", "unfollow");
                const api = await fetch('follow.php', {
                    method: 'POST',
                    // headers:{'Content-Type':'application/x-www-form-urlencoded'},    
                    body: formData
                })
                // const response = await api.json()
            })()
    }
    async function editpostpopup(post_id) {

    }
    async function liking(e, post_id) {
        console.log(e.classList)
        const classes = e.classList
        classes.contains('bx-like') ?
            (async () => {
                e.classList.replace('bx-like', 'bxs-like')
                var formData = new FormData();
                formData.append("post_id", post_id);
                formData.append("status", "liking");
                const api = await fetch('liking.php', {
                    method: 'POST',
                    // headers:{'Content-Type':'application/x-www-form-urlencoded'},    
                    body: formData
                })
                const response = await api.json()
                console.log(JSON.stringify(response))
            })() :
            (async () => {
                e.classList.replace('bxs-like', 'bx-like')
                var formData = new FormData();
                formData.append("post_id", post_id);
                formData.append("status", "disliking");
                const api = await fetch('liking.php', {
                    method: 'POST',
                    // headers:{'Content-Type':'application/x-www-form-urlencoded'},    
                    body: formData
                })
                const response = await api.json()
                // console.log(response)
            })()
    }
    const addemoji = (e) => {
        const commentarea = document.querySelector('.thecommentarea')
        const text = commentarea.value + e.textContent
        commentarea.value = text
    }
    const focuscomment = (inputid) => {
        const input = document.querySelector(`#${inputid}`)
        input.focus()
    }
    const newStoryDiv = document.querySelector('.addstory')
    if(newStoryDiv) {
        console.log("Defined")
    }
    newStoryDiv.style.backgroundImage = "url(<?= $profile ?>)";
    newStoryDiv.style.backgroundSize = "cover";
    newStoryDiv.style.backgroundPosition = "center";
    newStoryDiv.style.backgroundRepeat = "no-repeat";
    newStoryDiv.style.backgroundColor = "white";
</script>

</html>