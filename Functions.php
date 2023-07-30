<?php
$sessionUserId = $_SESSION["sessionUserId"];
$sessionUsername = $_SESSION["sessionUsername"];
include 'connection.php';

// Get Logged User Information For Using Across All Pages.
$getuserInfoQuery = "SELECT * FROM users WHERE userid='$sessionUserId'";
$getUserQuery = mysqli_query($conn, $getuserInfoQuery);
$getUserRow = mysqli_fetch_assoc($getUserQuery);

$u_userid = $getUserRow['userid'];
$u_username = $getUserRow['username'];
$u_userfullname = $getUserRow['userfullname'];
$u_useremail = $getUserRow['useremail'];
$u_userbio = $getUserRow['userbio'];
$u_userlocation = $getUserRow['userlocation'];
$u_userwebsite = $getUserRow['userwebsite'];
$u_userjoined = $getUserRow['userjoined'];
$u_usertotaltweets = $getUserRow['totaltweets'];
$u_userfollowers = $getUserRow['followers'];
$u_userfollowings = $getUserRow['followings'];
$u_useravatar = $getUserRow['useravatar'];

// For Adding New Tweet 
function AddNewTweet($tweetData)
{
    global $conn;
    global $u_username;
    global $u_userfullname;
    global $u_userid;
    global $u_useravatar;
    $status = "";
    $result = mysqli_query($conn, "INSERT INTO tweets(username,userid,userfullname,tweet) VALUES('$u_username','$u_userid','$u_userfullname','$tweetData')");
    mysqli_query($conn, "UPDATE users SET totaltweets = totaltweets + 1, useravatar = '$u_useravatar' WHERE username='$u_username'");
    mysqli_query($conn, "UPDATE tweets SET useravatar = '$u_useravatar' WHERE username='$u_username'");
    if ($result) {
        $status = "Added Successfully.";
    } else {
        $status = "Not Added. " . mysqli_error($conn) . "";
    }
}

// For Follow User
function followFunc($I_following)
{
    global $conn;
    global $u_username;
    $query = mysqli_query($conn, "SELECT id FROM connection WHERE follower='$u_username' AND following='$I_following'");
    if (!(mysqli_num_rows($query) >= 1)) {
        mysqli_query($conn, "INSERT INTO connection (follower, following) VALUES ('$u_username', '$I_following')");
        mysqli_query($conn, "UPDATE users SET followings = followings + 1 WHERE username='$u_username'");
        mysqli_query($conn, "UPDATE users SET followers = followers + 1 WHERE username='$I_following'");
    }
}

// For Unfollow User
function unFollowFunc($I_following)
{
    global $conn;
    global $u_username;
    $query = mysqli_query($conn, "SELECT id FROM connection WHERE follower='$u_username' AND following='$I_following'");
    if (mysqli_num_rows($query) >= 1) {
        mysqli_query($conn, "DELETE FROM connection WHERE follower='$u_username' AND following='$I_following'");
        mysqli_query($conn, "UPDATE users SET followings = followings - 1 WHERE username='$u_username'");
        mysqli_query($conn, "UPDATE users SET followers = followers - 1 WHERE username='$I_following'");
    }
}


// For Showing Random User In Home Page
function randomUsers()
{
    global $conn;
    global $u_username;
    $RandomUserquery = mysqli_query($conn, "SELECT * FROM users WHERE NOT username = '$u_username' ORDER BY RAND() LIMIT 3;");
    while ($row = mysqli_fetch_array($RandomUserquery)) {
        echo "<div class='RandomUser_Card'>
                <img src='" . $row['useravatar'] . "' alt=''>
                <div class='RandomUser_Card_Name'>
                    <a href='" . $row['username'] . "'>" . $row['userfullname'] . "</a>
                    <p>@" . $row['username'] . "</p>
                </div>";
        $user_name = $row['username'];
        $query2 = mysqli_query($conn, "SELECT id FROM connection WHERE follower='$u_username' AND following='$user_name'");
        if (mysqli_num_rows($query2) >= 1) {
            echo "<a href='Unfollow.php?username=$user_name' class='RandomeUserFollowBtn' style='background-color: #1da1f2; color: #ffffff;'>Unfollow</a>";
        } else {
            echo "<a href='Follow.php?username=$user_name' class='RandomeUserFollowBtn'>Follow</a>";
        }
        echo "</div>";
    }
}

function likeDislikePost($I_post_id)
{
    global $conn;
    global $u_userid;
    $sql1 = "SELECT `liker_id`, `likedpost_id` FROM `likeconnection` WHERE liker_id='$u_userid' and likedpost_id='$I_post_id'";
    $result = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($result) == 0) {
        // Like
        $sql2 = "UPDATE `tweets` SET `totallikes`=totallikes+1 WHERE tweetid='$I_post_id'";
        mysqli_query($conn, $sql2);
        $sql3 = "INSERT INTO `likeconnection`(`liker_id`, `likedpost_id`) VALUES ('$u_userid','$I_post_id')";
        mysqli_query($conn, $sql3);
    } else {
        // Dislike     
        $sql2 = "UPDATE `tweets` SET `totallikes`=totallikes-1 WHERE tweetid='$I_post_id'";
        mysqli_query($conn, $sql2);
        $sql3 = "DELETE FROM `likeconnection` WHERE liker_id='$u_userid' and likedpost_id='$I_post_id'";
        mysqli_query($conn, $sql3);
    }
}
function developerCard($I_UserName)
{
    global $conn;
    $query = mysqli_query($conn, "SELECT * FROM users WHERE username = 'jayprajapati';");
    $row = mysqli_fetch_array($query);
    echo "<img src='" . $row['useravatar'] . "' alt=''>
            <div class='RandomUser_Card_Name'>
            <a href=''>Jay Prajapati</a>
            <p>@jayprajapati</p>
          </div>";
    $query2 = mysqli_query($conn, "SELECT id FROM connection WHERE follower='$I_UserName' AND following='jayprajapati'");
    if (mysqli_num_rows($query2) >= 1) {
        echo "<a href='Unfollow.php?username=jayprajapati' class='RandomeUserFollowBtn' style='background-color: #1da1f2; color: #ffffff;'>Unfollow</a>";
    } else {
        echo "<a href='Follow.php?username=jayprajapati' class='RandomeUserFollowBtn'>Follow</a>";
    }
}
function getTweetForProfile($I_UserName, $I_UserID)
{
    global $conn;
    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$I_UserName'");
    $row = mysqli_fetch_assoc($query);
    $userfullname = $row['userfullname'];
    $GetTweetquery = mysqli_query($conn, "SELECT * FROM tweets WHERE username = '$I_UserName' ORDER BY tweetid DESC;");
    while ($raw = mysqli_fetch_array($GetTweetquery)) {
        $tweet_id = $raw['tweetid'];
        echo "<div class='Tweet'>
        <img src='" . $raw['useravatar'] . "' alt=''>
        <div class='TweetInner_Body'>
            <span>
                <a href=''>" . $raw['userfullname'] . "</a>
                <h3 class='TweetInner_BodyUName'>@" . $raw['username'] . "</h3>
            </span>
            <p><a href=''>" . nl2br($raw['tweet']) . "</a></p>
            <br>
            <div class='Tweet_Action_Icons'>";
        include 'connection.php';
        $sql1 = "SELECT `liker_id`, `likedpost_id` FROM `likeconnection` WHERE liker_id='$I_UserID' and likedpost_id='$tweet_id'";
        $result = mysqli_query($conn, $sql1);

        if (mysqli_num_rows($result) == 1) {
            if ($raw['totallikes'] == 0) {
                $showlikes = "";
            } else {
                $showlikes = $raw['totallikes'];
            }
            echo "<i class='material-icons likebtn' id='" . $tweet_id . "' style='color: #e0245e;'>favorite</i> <p>" . $showlikes . "</p>";
        } else {
            if ($raw['totallikes'] == 0) {
                $showlikes = "";
            } else {
                $showlikes = $raw['totallikes'];
            }
            echo "<i class='material-icons likebtn' id='" . $tweet_id . "'>favorite_border</i> <p>" . $showlikes . "</p>";
        }

        //echo "<i class='material-icons' id='".$tweet_id."'>favorite_border</i><p></p>";
        echo "<i class='material-icons'>repeat</i>
              <i class='material-icons'>chat_bubble_outline</i>
            </div>
        </div>
        <a href='#' class='TweetdeleteIcon'><i class='material-icons'>more_horiz</i></a>
    </div> ";
    }
}
mysqli_close($conn);
