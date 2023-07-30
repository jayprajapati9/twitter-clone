<?php
$error_msg = "";

session_start();
if (isset($_SESSION["sessionUsername"])) {
    header("location: Home.php");
}

include 'connection.php';

if (isset($_POST['login'])) {
    if ($_POST['username'] != "" && $_POST['password'] != "") {
        $username = strtolower($_POST['username']);
        $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' ");
        mysqli_close($conn);
        if (mysqli_num_rows($query) >= 1) {
            $password = md5($_POST['password']);
            $row = mysqli_fetch_assoc($query);
            if ($password == $row['userpassw']) {
                $_SESSION['sessionUsername'] = $username;
                $_SESSION['sessionUserId'] = $row['userid'];
                header('Location: Home.php');
                exit;
                exit();
                die();
            } else {
                $error_msg = "Incorrect username or password";
            }
        } else {
            $error_msg = "Incorrect username or password";
        }
    } else {
        $error_msg = "All fields must be filled out";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/3_Login.css">
    <link rel="stylesheet" href="Octa Css/OctaDist.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/1811a0037b.js" crossorigin="anonymous"></script>
    <title>Login on Twitter</title>
    <style>
        .Msg {
            text-align: center;
        }
    </style>
</head>

<body>
    <section class="logIn_Card">
        <div class="logIn_Controls">
            <div class="logIn_BrandIcon">
                <i class="fa fa-twitter"></i>
            </div>
            <h1>Log in to Twitter</h1>
            <form action="" method="post">

                <input type="text" placeholder="Username" name="username">
                <input type="password" placeholder="Password" name="password">

                <div class="Msg pt-15">
                    <h3><?php
                        if (isset($_GET['msg'])) {
                            if ($_GET['msg'] == "Please Login") {
                                echo "Please Login";
                            } else {
                                echo "";
                            }
                        } else {
                            echo "";
                        }
                        if (isset($error_msg)) {
                            echo $error_msg;
                        } else {
                            echo "";
                        }
                        ?></h3>
                </div>

                <div class="logIn_NextBtnBlock">
                    <button type="submit" name="login">Log in</button>
                </div>
            </form>
            <div class="logIn_OtherLinks">
                <a href="">Forgot password?</a>
                ·
                <a href="SignUp.php">Sign up for Twitter</a>
            </div>
        </div>
    </section>
</body>

</html>