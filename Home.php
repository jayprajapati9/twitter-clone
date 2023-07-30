<?php
session_start();
if (!isset($_SESSION["sessionUsername"])) {
    header("location: Login.php?msg=Please Login");
}
$sessionUserId = $_SESSION["sessionUserId"];
$sessionUsername = $_SESSION["sessionUsername"];
include 'connection.php';
include 'Functions.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="Style/4_Home.css">
    <link rel="stylesheet" href="Style/MobileNavbar.css">
    <link rel="stylesheet" href="Vendor/MaterialIcons.css">
    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="index.css?v=< ?php //echo time(); ?>"> -->
    <!-- Ctrl + F5 Hard Refresh -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Home</title>
</head>

<body>
    <ul class="nav-menu">
        <div class="nav-menuTitleBar">
            <h2>Account info</h2>
            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>
        <div class="nav-menuBody">
            <div class="SideNavUserInfo">
                <img src="<?php echo $u_useravatar; ?>" alt="">
                <p class="sideMenuFName"><?php echo $u_userfullname; ?></p>
                <p class="sideMenuUName">@<?php echo $u_username; ?></p>
            </div>
            <div class="AccStat">
                <h4><b><?php echo $u_userfollowings; ?></b>Following</h4>
                <h4><b><?php echo $u_userfollowers; ?></b>Followers</h4>
            </div>
            <li class="nav-item">
                <i class="material-icons">person</i>
                <a href="Profile.php" class="nav-link">Profile</a>
            </li>
            <li class="nav-item">
                <i class="material-icons">list_alt</i>
                <a href="#" class="nav-link">Lists</a>
            </li>
            <li class="nav-item">
                <i class="material-icons">settings</i>
                <a href="#" class="nav-link">Settings</a>
            </li>

            <li class="nav-item">
                <i class="material-icons">list_alt</i>
                <a href="#" class="nav-link">Display</a>
            </li>

            <li class="nav-item logoutbody">
                <br>
                <i class="material-icons">logout</i>
                <a href="Logout.php" class="nav-link">Log out</a>
            </li>
            <br><br>
        </div>
    </ul>

    <!-- Floating Tweet Button For Mobile -->
    <button class="floatingTweet_Btn" onclick="location.href='Compose.php'">
        <svg viewBox="0 0 24 24" aria-hidden="true">
            <g>
                <path d="M8.8 7.2H5.6V3.9c0-.4-.3-.8-.8-.8s-.7.4-.7.8v3.3H.8c-.4 0-.8.3-.8.8s.3.8.8.8h3.3v3.3c0 .4.3.8.8.8s.8-.3.8-.8V8.7H9c.4 0 .8-.3.8-.8s-.5-.7-1-.7zm15-4.9v-.1h-.1c-.1 0-9.2 1.2-14.4 11.7-3.8 7.6-3.6 9.9-3.3 9.9.3.1 3.4-6.5 6.7-9.2 5.2-1.1 6.6-3.6 6.6-3.6s-1.5.2-2.1.2c-.8 0-1.4-.2-1.7-.3 1.3-1.2 2.4-1.5 3.5-1.7.9-.2 1.8-.4 3-1.2 2.2-1.6 1.9-5.5 1.8-5.7z">
                </path>
            </g>
        </svg>
    </button>

    <!-- Side Navigation Bar -->
    <navbar>
        <ul class="Nav_List">
            <i class="fa fa-twitter Nav_Brand_Icon"></i>

            <li class="Nav_Item Active_NavItem">
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

            <li class="Nav_Item">
                <a href="Profile.php">
                    <i class="material-icons">person_outline</i>
                    <p class="NavItem_Label">Profile</p>
                </a>
            </li>

            <li class="Nav_Item itemNavLogout">
                <a href="Logout.php">
                    <i class="material-icons" style="font-size: 28px;">logout</i>
                    <p class="NavItem_Label">Log out</p>
                </a>
            </li>

        </ul>
    </navbar>

    <!-- Main Content -->
    <main class="MainContent">
        <div class="Main">
            <div class="TitleBar">
                <img src="<?php echo $u_useravatar; ?>" alt="" id="MobileAvatarBtn">
                <h2>Home</h2>
                <i class="material-icons" onclick="callTweet();" title="Latest Tweet">auto_awesome</i>
            </div>
            <div class="TweetDeck">
                <div class="MakeTweet_Box">
                    <div class="MakeTweet_Img_Input">
                        <img src="<?php echo $u_useravatar; ?>" alt="" style="height: 48px; width: 48px; border-radius: 50%;">
                        <textarea id="getTweet" placeholder="What's happening?" maxlength="140"></textarea>
                    </div>
                    <div class="MakeTweetOptions">
                        <i class="material-icons">crop_original</i>
                        <button id="submitTweet">Tweet</button>
                    </div>
                    <h4 style="color: #d9d9d9; text-align: center; margin-bottom: 12px;" id="errMsg"></h4>
                    <div style="border-bottom: 1px solid rgb(47, 51, 54);  border-top: 1px solid rgb(47, 51, 54);  height: 12px; background-color: rgb(21, 24, 28);">
                    </div>
                </div>
                <!--
                <div class="WelcomeMsg">
                    <h2>Welcome to Twitter!</h2>
                    <p>This is the best place to see what’s happening in your world. Find some people and topics to
                        follow
                        now.</p>
                </div>
                -->

                <div id="ShowTweet">

                </div>
                <!-- <div class="Tweet">
                    <img src="Images/default_profile.png" alt="">
                    <div class="TweetInner_Body">
                        <span style="display: flex;">
                            <a href="">Jay Prajapati</a>
                            <h3 class="TweetInner_BodyUName">@jayy</h3>
                        </span>
                        <p><a href="">Doge to the moon</a></p>
                        <br>
                        <div class="Tweet_Action_Icons">
                            <i class="material-icons" id="tweet_like_btn">favorite_border</i>
                            <p>62</p>
                            <i class="material-icons">repeat</i>
                            <i class="material-icons">chat_bubble_outline</i>
                        </div>
                    </div>
                    <a href="#" class="TweetdeleteIcon" title="Delete Tweet">
                        <i class="material-icons">more_horiz</i></a>
                </div>

                <div class="Tweet">
                    <img src="Images/default_profile.png" alt="">
                    <div class="TweetInner_Body">
                        <span>
                            <a href="">Elon Musk</a>
                            <h3 class="TweetInner_BodyUName">@elon</h3>
                            <i class="material-icons">verified</i>
                        </span>
                        <p><a href="">Tesla, SpaceX, Paypal Ceo </a></p>
                        <br>
                        <div class="Tweet_Action_Icons">
                            <i class="material-icons" style="color: #e0245e;">favorite</i>
                            <p>86</p>
                            <i class="material-icons">repeat</i>
                            <i class="material-icons">chat_bubble_outline</i>
                        </div>
                    </div>
                    <a href="#" class="TweetdeleteIcon" title="Delete Tweet"><i class="material-icons">more_horiz</i></a>
                </div> -->

                <h2 style="color: #1da1f2; margin-bottom: 70px; text-align: center;">·</h2>
            </div>
        </div>

        <!-- Right Div -->
        <div class="RightSideDiv">
            <div class="User_SearchBar">
                <i class="material-icons">search</i>
                <input type="text" name="" id="" placeholder="Search Twitter" onclick="location.href = 'Search.php';">
            </div>
            <div class="WhotoFollow_Card">
                <h2>Who to follow</h2>

                <?php
                include 'connection.php';
                $sessionUsername = $_SESSION["sessionUsername"];
                randomUsers();
                mysqli_close($conn);
                ?>

                <!-- <div class="RandomUser_Card">
                    <img src="Images/default_profile.png" alt="">
                    <div class="RandomUser_Card_Name">
                        <a href="">Elon musk</a>
                        <p>@elon</p>
                    </div>
                    <a href="" class="RandomeUserFollowBtn">Follow</a>
                </div> -->

            </div>
            <br>

            <div class="WhotoFollow_Card">
                <h2>Developer</h2>
                <div class="RandomUser_Card">
                    <?php
                    include 'connection.php';
                    developerCard($sessionUsername);
                    mysqli_close($conn);
                    ?>
                </div>
            </div>

        </div>
    </main>
    <script>
        const hamburger = document.querySelector(".hamburger");
        const MobileAvatarBtn = document.getElementById("MobileAvatarBtn");
        const navMenu = document.querySelector(".nav-menu");
        const navLink = document.querySelectorAll(".nav-link");
        hamburger.addEventListener("click", closeMenu);
        MobileAvatarBtn.addEventListener("click", mobileMenu);
        navLink.forEach(n => n.addEventListener("click", closeMenu));

        function mobileMenu() {
            navMenu.classList.toggle("active");
        }

        function closeMenu() {
            navMenu.classList.remove("active");
        }

        /*---------------------------------------------*/
        const tx = document.getElementsByTagName("textarea");
        for (let i = 0; i < tx.length; i++) {
            tx[i].setAttribute("style", "height:" + (tx[i].scrollHeight) + "px;overflow-y:hidden;");
            tx[i].addEventListener("input", OnInput, false);
        }

        function OnInput() {
            this.style.height = "auto";
            this.style.height = (this.scrollHeight) + "px";
        }

        // /*---------------------------------------------*/
        // $(document).ready(function() {
        //     $("#tweet_like_btn").click(function() {
        //         if ($("#tweet_like_btn").hasClass("likedTweet")) {
        //             $("#tweet_like_btn").css('color', '#6e767d');
        //             $("#tweet_like_btn").html('favorite_border');
        //             $("#tweet_like_btn").removeClass("likedTweet");
        //         } else {
        //             $("#tweet_like_btn").html('favorite');
        //             $("#tweet_like_btn").css('color', '#e0245e');
        //             $("#tweet_like_btn").addClass("likedTweet");
        //         }
        //     });
        // });

        /*---------------------------------------------*/
        $('#submitTweet').click(function() {
            var getTweet = document.getElementById("getTweet").value;
            if (getTweet == "" || getTweet == 0) {
                //alert("Please Enter Tweet");
                document.getElementById("errMsg").innerText = "Please Enter Tweet";

                setTimeout(() => {
                    document.getElementById("errMsg").innerText = "";
                }, 2000);
            } else {
                $.ajax({
                    url: 'AddNewTweet.php',
                    method: "POST",
                    data: {
                        d_tweet: getTweet,
                    },
                    dataType: "text",
                    cache: false,
                    success: function() {
                        //alert("Created Tweet");
                        callTweet();
                        document.getElementById("getTweet").value = "";
                        //$('#available').html(html);
                    }
                });
            }
        });
        /*---------------------------------------------*/
        function callTweet() {
            $('#ShowTweet').load('LoadTweetForHome.php')
        }
        callTweet();

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
            callTweet();
        });
    </script>
</body>

</html>