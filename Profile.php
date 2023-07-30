<?php
session_start();
include 'connection.php';

if (!isset($_SESSION["sessionUsername"])) {
    header("location: Login.php?msg=Please Login");
}

$sessionUserId = $_SESSION["sessionUserId"];
$sessionUsername = $_SESSION["sessionUsername"];

$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$sessionUsername'");
$row = mysqli_fetch_assoc($query);
$user_name = $row['username'];
$user_fullname = $row['userfullname'];
$user_totaltweets = $row['totaltweets'];
$user_followers = $row['followers'];
$user_following = $row['followings'];
$user_joined = $row['userjoined'];
$user_avatar = $row['useravatar'];
$user_totaltweeets = $row['totaltweets'];
$user_bio = $row['userbio'];
$user_website = $row['userwebsite'];
$user_location = $row['userlocation'];
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/5_Profile.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="Vendor/MaterialIcons.css">
    <link rel="stylesheet" href="Vendor/fontAwesomeCss.css">
    <script src="Vendor/fontAwesomeScript.js"></script>
    <title><?php echo $user_fullname; ?></title>
</head>

<body>
    <!-- Side Navigation Bar -->
    <navbar>
        <ul class="Nav_List">
            <i class="fa fa-twitter Nav_Brand_Icon"></i>

            <li class="Nav_Item">
                <a href="Home.php">
                    <i class="material-icons">home</i>
                    <p class="NavItem_Label">Home</p>
                </a>
            </li>

            <li class="Nav_Item ExploreItem">
                <a href="">
                    <i class="material-icons">tag</i>
                    <p class="NavItem_Label">Explore</p>
                </a>
            </li>

            <li class="Nav_Item NotificationItem">
                <a href="">
                    <i class="material-icons">notifications_none</i>
                    <p class="NavItem_Label">Notifications</p>
                </a>
            </li>

            <li class="Nav_Item">
                <a href="Search.php">
                    <i class="material-icons">search</i>
                    <p class="NavItem_Label">Search</p>
                </a>
            </li>

            <li class="Nav_Item Active_NavItem">
                <a href="#">
                    <i class="material-icons">person</i>
                    <p class="NavItem_Label">Profile</p>
                </a>
            </li>

        </ul>
    </navbar>


    <!-- Main Content -->
    <main class="MainContent">

        <!-- Mai Center Div -->
        <div class="Main">
            <div class="TitleBar">
                <a href="Home.php">
                    <i class="material-icons">arrow_back</i>
                </a>
                <div>
                    <h2><?php echo $user_fullname; ?></h2>
                    <p><?php echo $user_totaltweeets; ?> Tweets</p>
                </div>
            </div>
            <div class="ProfileBody">
                <div class="ProfilePic_N_Button">
                    <img src="<?php echo $user_avatar; ?>" alt="">
                    <!-- <button onclick="location.href='EditProfile.html';">Edit</button> -->
                    <a href="EditProfile.php">Edit</a>
                </div>
                <div class="Profile_Info">
                    <h2><?php echo $user_fullname; ?></h2>
                    <p>@<?php echo $user_name; ?></p>
                    <p style="color: #d9d9d9; margin-top: 10px; margin-bottom: 4px;">
                        <?php
                        if (isset($user_bio)) {
                            echo $user_bio;
                        } else {
                            echo "";
                        }
                        ?>
                    </p>
                    <span>
                        <?php
                        if (!empty($user_location)) {
                            echo "<i class='material-icons'>place</i> $user_location <div style='margin-right: 15px;'></div>";
                        } else {
                            echo "";
                        }
                        ?>
                        <i class="material-icons">date_range</i>Joined <?php echo $user_joined; ?>
                    </span>
                    <span>
                        <?php
                        if (!empty($user_website)) {
                            echo "<i class='material-icons'>link</i>
                                      <a href='#' style='color: #1da1f2; text-decoration: none; min-width: 50px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;'>" . $user_website . "</a>";
                        } else {
                            echo "";
                        }
                        ?>
                    </span>
                    <div>
                        <h4><a href=""><?php echo $user_following; ?></a>Following</h4>
                        <h4><a href=""><?php echo $user_followers; ?></a>Followers</h4>
                    </div>
                </div>
            </div>
            <button class="Tweets_Btn">Tweets</button>
            <div style=" border-top: 1px solid rgb(47, 51, 54);"></div>

            <?php
            include 'Functions.php';
            include 'connection.php';
            getTweetForProfile($sessionUsername,$sessionUserId);
            mysqli_close($conn);
            ?>

            <!-- <div class="Tweet">
                <img src="Images/default_profile.png" alt="">
                <div class="TweetInner_Body">
                    <span style="display: flex;">
                        <a href="">Jay Prajapati</a>
                        <h3 class="TweetInner_BodyUName">@jayy</h3>
                    </span>
                    <p>
                        <a href="">Hi Hello Jay Here This Is Twitter Clone Made In Php And Html Pure Css</a>
                    </p>
                    <br>
                    <div class="Tweet_Action_Icons">
                        <i class="material-icons" style="color: #e0245e;">favorite</i>
                        <p>10</p>
                        <i class="material-icons">repeat</i>
                        <i class="material-icons">chat_bubble_outline</i>
                    </div>
                </div>
                <a href="#" class="TweetdeleteIcon" title="Delete Tweet">
                    <i class="material-icons">delete_outline</i></a>
            </div>

            <div class="Tweet">
                <img src="Images/default_profile.png" alt="">
                <div class="TweetInner_Body">
                    <span style="display: flex;">
                        <a href="">Jay Prajapati</a>
                        <h3 class="TweetInner_BodyUName">@jayy</h3>
                    </span>
                    <p>
                        <a href="">Hi Hello Jay Here This Is Twitter Clone Made In Php And Html Pure Css</a>
                    </p>
                    <br>
                    <div class="Tweet_Action_Icons">
                        <i class="material-icons">favorite_border</i>
                        <p>60</p>
                        <i class="material-icons">repeat</i>
                        <i class="material-icons">chat_bubble_outline</i>
                    </div>
                </div>
                <a href="#" class="TweetdeleteIcon" title="Delete Tweet"><i class="material-icons">delete_outline</i></a>
            </div> -->

            <h2 style=" color: #1da1f2; margin-bottom: 70px; text-align: center;">·</h2>
        </div>

        <!-- Right End Main Div -->
        <div class="RightSideDiv">
            <div class="BrandPromo_Card">
                <h2>New to Twitter?</h2>
                <p>Sign up now to get your own personalized timeline!</p>
                <button>Sign up</button>
            </div>
            <br>
            <div class="BrandPromo_Card">
                <h2 style="font-size: 1.4rem;">Developer</h2>
                <h2 style="font-size: 1rem; padding-bottom: 5px !important;">Jay Prajapati</h2>
                <p>@jayprajapati</p>
                <button>Follow</button>
            </div>
        </div>
    </main>
    <script>
        $("body").on("click", ".likebtn", function(event) {
            console.log("A");
            var id = $(this).attr("id");
            var gettext = $(this).text();
            if (gettext == "favorite_border") {
                $(this).text("favorite");
                $(this).css('color', '#e0245e');
            } else if (gettext == "favorite") {
                $(this).text("favorite_border");
                $(this).css('color', '#6e767d');
            }
            $.post("LikeDislikePost.php", {
                data: id,
                how: 'c'
            });
        });
    </script>
</body>

</html>