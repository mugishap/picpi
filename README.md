# picpi

Below are some queries used to create tables;

## ##User's table

| Table | Create Table

| users | CREATE TABLE `users` (
`user_id` varchar(255) NOT NULL DEFAULT uuid(),
`firstname` varchar(32) NOT NULL,
`lastname` varchar(32) NOT NULL,
`telephone` int(10) NOT NULL,
`profile` varchar(255) NOT NULL,
`gender` varchar(7) NOT NULL,
`nationality` varchar(100) NOT NULL,
`username` varchar(32) NOT NULL,
`email` varchar(180) NOT NULL,
`password` varchar(255) NOT NULL,
`role` varchar(32) DEFAULT 'user',
PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 |

## ###Post's table

| Table | Create Table  
| posts | CREATE TABLE `posts` (
`post_id` varchar(255) NOT NULL DEFAULT uuid(),
`count` int(11) NOT NULL AUTO_INCREMENT,
`time` datetime NOT NULL DEFAULT current_timestamp(),
`username` varchar(32) NOT NULL,
`profile` varchar(255) NOT NULL,
`caption` varchar(255) NOT NULL,
`image` varchar(255) NOT NULL,
PRIMARY KEY (`count`),
UNIQUE KEY `post_id` (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 |

## ##Highlight's table

| Table |
Create Table

| highlights | CREATE TABLE `highlights` (
`highlight_id` varchar(255) NOT NULL DEFAULT uuid(),
`highlight_time` datetime NOT NULL DEFAULT current_timestamp(),
`user_id` varchar(255) NOT NULL,
`username` varchar(32) NOT NULL,
`image` varchar(255) NOT NULL,
PRIMARY KEY (`highlight_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 |

## ###Stories' table

| Table |
Create Table

| stories | CREATE TABLE `stories` (
`story_id` varchar(255) NOT NULL DEFAULT uuid(),
`user_id` varchar(255) NOT NULL,
`story_time` datetime NOT NULL DEFAULT current_timestamp(),
`username` varchar(32) NOT NULL,
`text` varchar(120) DEFAULT NULL,
`media` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 |

## ###Likes' table

| Table |
Create Table

| likes | CREATE TABLE `likes` (
`like_id` varchar(255) NOT NULL DEFAULT uuid(),
`liker_id` varchar(255) DEFAULT NULL,
`post_id` varchar(255) NOT NULL,
`liker_profile` varchar(255) NOT NULL,
`likerusername` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 |

## ###comments' table

| Table |
Create Table

| comments | CREATE TABLE `comments` (
`comment_id` varchar(255) NOT NULL DEFAULT uuid(),
`comment_time` datetime NOT NULL DEFAULT current_timestamp(),
`commenter_username` varchar(255) NOT NULL,
`comment` varchar(255) NOT NULL,
`post_id` varchar(255) NOT NULL,
`commenter_id` varchar(255) NOT NULL,
PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 |

### following\_{username} table

---

| Table|
Create Table

| following\_{username} | CREATE TABLE `following_{username}` (
`follow_id` varchar(255) NOT NULL DEFAULT uuid(),
`following_id` varchar(255) NOT NULL,
`following_username` varchar(32) NOT NULL,
`following_profile` varchar(255) NOT NULL,
PRIMARY KEY (`follow_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 |

### followers\_{username} table

---

| Table |
Create Table

| followers_mugishap | CREATE TABLE `followers_mugishap` (
`follow_id` varchar(255) NOT NULL DEFAULT uuid(),
`follower_id` varchar(255) NOT NULL,
`follower_username` varchar(32) NOT NULL,
`follower_profile` varchar(255) NOT NULL,
PRIMARY KEY (`follow_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 |

### Messages table
------------------

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  PRIMARY KEY (`msg_id`)
);


### Table descriptions
--------------------
Command runned :desc table_name;


#User's table
------------
#Posts' table
------------
#Likes' table
------------
#Comments' table
------------
#following_{username}'s table
------------
#followers_{username}'s table
------------
#highlights's table
------------

#Messages table
----------------


