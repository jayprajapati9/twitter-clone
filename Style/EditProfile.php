<?php
session_start();

if (!isset($_SESSION["sessionUsername"])) {
    header("location: Login.php");
}

$sessionUsername = $_SESSION["sessionUsername"];
include 'connection.php';

$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$sessionUsername'");
$row = mysqli_fetch_assoc($query);
$userAvatar = $row['useravatar'];

if (isset($_POST["submit"])) {
    
    $var1 = rand(1111, 9999);  // generate random number in $var1 variable
    $var2 = rand(1111, 9999);  // generate random number in $var2 variable

    $var3 = $var1 . $var2;  // concatenate $var1 and $var2 in $var3

    // Get image name
    $image = $_FILES['image']['name'];

    // image file directory
    $target = "UserImages/" . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $msg = "Image uploaded successfully";
    } else {
        $msg = "Failed to upload image";
    }

    $fullname = mysqli_real_escape_string($conn, $_POST['d_fullname']);
    $userbio = mysqli_real_escape_string($conn, $_POST['d_userbio']);
    $location = mysqli_real_escape_string($conn, $_POST['d_location']);
    $website = mysqli_real_escape_string($conn, $_POST['d_userwebsite']);
    mysqli_query($conn, "UPDATE users SET userfullname = '$fullname', userbio = '$userbio', userlocation='$location', userwebsite='$website', useravatar='$target' WHERE username ='$sessionUsername'");
    mysqli_query($conn, "UPDATE users SET useravatar='$target' WHERE username ='$sessionUsername'");
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit profile</title>
    <link rel="stylesheet" href="Style/7_EditProfile.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--  -->
</head>

<body>
    <!-- File For Editing Profile -->
    <div class="ComposeTweet_Body">
        <div class="TitleBar">
            <button onclick="location.href='Profile.php'">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <g>
                        <path d="M20 11H7.414l4.293-4.293c.39-.39.39-1.023 0-1.414s-1.023-.39-1.414 0l-6 6c-.39.39-.39 1.023 0 1.414l6 6c.195.195.45.293.707.293s.512-.098.707-.293c.39-.39.39-1.023 0-1.414L7.414 13H20c.553 0 1-.447 1-1s-.447-1-1-1z">
                        </path>
                    </g>
                </svg>
            </button>
            <h2>Edit Profile</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="submit" value="Save" name="submit">
        </div>
        <div class="Form_Body">
            <img src="<?php echo $userAvatar; ?>" alt="">
            <div class="Text_Input">
                <span>Profile Picture</span>
                <input type="file" name="image">
            </div>
            <div class="Text_Input">
                <span>Name</span>
                <input type="text" name="d_fullname" maxlength="50">
            </div>
            <div class="Text_Input">
                <span>Bio</span>
                <input type="text" name="d_userbio" maxlength="160">
            </div>
            <div class="Text_Input">
                <span>Location</span>
                <input type="url" name="d_location" maxlength="30">
            </div>
            <div class="Text_Input">
                <span>Website</span>
                <input type="url" name="d_userwebsite" maxlength="100">
            </div>
        </div>
    </div>
    </form>
    <!-- <script>
        $(document).ready(function() {
            $('#submit').click(function() {

                var fullname = document.getElementById("fullname").value;
                var userbio = document.getElementById("userbio").value;
                var userlocation = document.getElementById("userlocation").value;
                var userwebsite = document.getElementById("userwebsite").value;

                if (userbio == "" || userbio == null || fullname == "" || fullname == null) {
                    alert("Please Fill All Fields");
                } else {
                    $.ajax({
                        method: "POST",
                        data: {
                            d_userbio: userbio,
                            d_fullname: fullname,
                            d_location: userlocation,
                            d_userwebsite: userwebsite
                        },
                        dataType: "text",
                        cache: false,
                        success: function() {
                            alert("Profile Updated");
                        }
                    });
                }
            });
        });
    </script> -->
</body>

</html>