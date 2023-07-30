<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="Vendor/fontAwesomeCss.css">
    <script src="Vendor/fontAwesomeScript.js"></script>
    <link rel="stylesheet" href="Vendor/MaterialIcons.css">
    <link rel="stylesheet" href="Style/8_Search.css">
    <title>Search</title>
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

            <li class="Nav_Item Active_NavItem">
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
        <!-- Mai Center Div -->
        <div class="Main">
            <div class="TitleBar">
                <button onclick="location.href='Home.php'">
                    <i class="material-icons">arrow_back</i>
                </button>

                <div class="User_SearchBar">
                    <i class="material-icons">search</i>
                    <input type="text" id="username" placeholder="Search Twitter">
                </div>
            </div>
            <!-- <div class="RandomUser_Card">
                <a href="#">
                    <img src="Images/default_profile.png" alt="">
                    <div class="RandomUser_Card_Name">
                        <p>Jay Prajapati</p>
                        <p>@jayy</p>
                    </div>
                    <button>Follow</button>
                </a>
            </div>
            <div class="RandomUser_Card">
                <a href="#">
                    <img src="https://pbs.twimg.com/profile_images/1413849387076182016/oc0Ic9Dy_400x400.jpg" alt="">
                    <div class="RandomUser_Card_Name">
                        <p>Risabh Arora</p>
                        <p>@dankrishu</p>
                    </div>
                    <button>Follow</button>
                </a>
            </div>
            <div class="RandomUser_Card">
                <a href="#">
                    <img src="https://static.dezeen.com/uploads/2021/06/elon-musk-architect_dezeen_1704_col_0.jpg" alt="">
                    <div class="RandomUser_Card_Name">
                        <p>Elon Musk</p>
                        <p>@elon</p>
                    </div>
                    <button>Follow</button>
                </a>
            </div> -->
            <span id="SearchResults">

            </span>
        </div>
    </main>
    <script>
        document.getElementById("username").addEventListener("keyup", myFunction);

        function myFunction() {
            var x = document.getElementById("username").value;
            $.ajax({
                url: "UserSearching.php",
                method: "POST",
                data: {
                    username: x
                },
                dataType: "text",
                success: function(html) {
                    $('#SearchResults').html(html);
                }
            });
        }
    </script>
</body>

</html>