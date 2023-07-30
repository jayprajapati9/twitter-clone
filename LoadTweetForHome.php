<?php
session_start();
$sessionUserId = $_SESSION["sessionUserId"];
$sessionUsername = $_SESSION["sessionUsername"];

include 'connection.php';

$sqlStmt = "SELECT * FROM `tweets` WHERE `username` = '$sessionUsername' OR `username` IN (SELECT `following` FROM `connection` WHERE `follower`='$sessionUsername') ORDER BY tweetid DESC";
$GetTweetquery = mysqli_query($conn, $sqlStmt);
while ($raw = mysqli_fetch_array($GetTweetquery)) {
    $tweet_id = $raw['tweetid'];
    echo "<div class='Tweet'>
                <img src='" . $raw['useravatar'] . "' alt=''>
                <div class='TweetInner_Body'>
                    <span>
                        <a href='" . $raw['username'] . "'>" . $raw['userfullname'] . "</a>
                        <h3 class='TweetInner_BodyUName'>@" . $raw['username'] . "</h3>
                    </span>
                    <p><a href=''>" . nl2br($raw['tweet']) . "</a></p>
                    <br>
                    <div class='Tweet_Action_Icons'>";
                    include 'connection.php';
                    $sql1 = "SELECT `liker_id`, `likedpost_id` FROM `likeconnection` WHERE liker_id='$sessionUserId' and likedpost_id='$tweet_id'";
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
                    echo "<i class='material-icons'>repeat</i>
                          <i class='material-icons'>chat_bubble_outline</i>
                    </div>
                </div>
                <a href='#' class='TweetdeleteIcon'><i class='material-icons'>more_horiz</i></a>
            </div> ";
}
mysqli_close($conn);
