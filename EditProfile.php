<?php
session_start();
include 'Functions.php';
include 'connection.php';
if (!isset($_SESSION["sessionUsername"])) {
    header("location: Login.php");
}

if (isset($_POST['submit'])) {

    $fullname = mysqli_real_escape_string($conn, $_POST['d_fullname']);
    $userbio = mysqli_real_escape_string($conn, $_POST['d_userbio']);
    $location = mysqli_real_escape_string($conn, $_POST['d_location']);
    $website = mysqli_real_escape_string($conn, $_POST['d_userwebsite']);
    mysqli_query($conn, "UPDATE users SET userfullname = '$fullname', userbio = '$userbio', userlocation='$location', userwebsite='$website' WHERE username ='$sessionUsername'");
    //mysqli_query($conn, "UPDATE users SET useravatar='$target' WHERE username ='$sessionUsername'");

    $img_name = $_FILES['my_image']['name'];
    $img_size = $_FILES['my_image']['size'];
    $tmp_name = $_FILES['my_image']['tmp_name'];
    $error = $_FILES['my_image']['error'];

    if ($error === 0) {
        if ($img_size > 125000) {
            $em = "Sorry, your file is too large.";
            //header("Location: index.php?error=$em");
        } else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                $img_upload_path = 'Uploads/' . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                // Insert into Database
                $sql = "UPDATE users SET useravatar = '$img_upload_path' WHERE username='$sessionUsername'";
                mysqli_query($conn, $sql);
                $sql1 = "UPDATE tweets SET useravatar = '$img_upload_path' WHERE username='$sessionUsername'";
                mysqli_query($conn, $sql1);
                //header("Location: view.php");
            } else {
                $em = "You can't upload files of this type";
                //header("Location: index.php?error=$em");
            }
        }
    } else {
        $em = "unknown error occurred!";
        //header("Location: index.php?error=$em");
    }
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
    <link rel="stylesheet" href="Vendor/MaterialIcons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--  -->
</head>

<body>
    <!-- File For Editing Profile -->
    <div class="ComposeTweet_Body">
        <div class="TitleBar">
            <button onclick="location.href='Profile.php'">
                <i class="material-icons">arrow_back</i>
            </button>
            <h2>Edit Profile</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="submit" value="Save" name="submit">
        </div>
        <div class="Form_Body">
            <img src="<?php echo $u_useravatar; ?>" alt="">
            <div class="Text_Input">
                <span>Profile Picture</span>
                <input type="file" name="my_image">
            </div>
            <div class="Text_Input">
                <span>Name</span>
                <input type="text" name="d_fullname" maxlength="50" value="<?php echo $u_userfullname; ?>">
            </div>
            <div class="Text_Input">
                <span>Bio</span>
                <input type="text" name="d_userbio" maxlength="160" value="<?php echo $u_userbio; ?>">
            </div>
            <div class="Text_Input">
                <span>Location</span>
                <input type="text" name="d_location" maxlength="30" value="<?php echo $u_userlocation; ?>">
            </div>
            <div class="Text_Input">
                <span>Website</span>
                <input type="url" name="d_userwebsite" maxlength="100" value="<?php echo $u_userwebsite; ?>">
            </div>
        </div>
    </div>
    </form>
</body>

</html>