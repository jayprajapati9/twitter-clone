<?php
session_start();
include 'connection.php';
include 'Functions.php';

if (!isset($_SESSION["sessionUsername"])) {
    header("location: Login.php?msg=Please Login");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compose new Tweet</title>
    <link rel="stylesheet" href="Style/6_Compose.css">
    <link rel="stylesheet" href="Vendor/MaterialIcons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <!-- File For Mobile Only For Composing Tweet -->
    <div class="ComposeTweet_Body">
        <div class="TitleBar">
            <button onclick="location.href='Home.php'">
                <i class="material-icons">arrow_back</i>
            </button>
            <input type="submit" value="Tweet" id="submitTweet">
        </div>
        <div class="Compose_Area">
            <img src="<?php echo $u_useravatar; ?>" alt="" style="height: 48px; width: 48px; border-radius: 50%;">
            <textarea placeholder="What's happening?" maxlength="140" id="getTweet"></textarea>
        </div>
        <div style="border-bottom: 1px solid rgb(47, 51, 54);  border-top: 1px solid rgb(47, 51, 54);  height: 12px; background-color: rgb(21, 24, 28);">
        </div>
        <h4 style="color: #d9d9d9; text-align: center; margin-top: 12px;" id="errMsg"></h4>
    </div>
    <script>
        const tx = document.getElementsByTagName("textarea");
        for (let i = 0; i < tx.length; i++) {
            tx[i].setAttribute("style", "height:" + (tx[i].scrollHeight) + "px;overflow-y:hidden;");
            tx[i].addEventListener("input", OnInput, false);
        }

        function OnInput() {
            this.style.height = "auto";
            this.style.height = (this.scrollHeight) + "px";
        }
        $('#submitTweet').click(function() {
            var getTweet = document.getElementById("getTweet").value;
            if (getTweet == "" || getTweet == null || getTweet == 0 ) {
                document.getElementById("errMsg").innerText = "Please Enter Tweet";

                setTimeout(() => {
                    document.getElementById("errMsg").innerText = "";
                }, 2000);

                //alert("Please Fill All Fields");
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
                        location.href = 'Home.php';
                        document.getElementById("getTweet").value = "";
                        //$('#available').html(html);
                    }
                });
            }
        });
    </script>
</body>

</html>