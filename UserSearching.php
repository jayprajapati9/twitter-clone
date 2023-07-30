<?php
session_start();
include 'connection.php';
$sessionUsername = $_SESSION["sessionUsername"];
if (isset($_POST["username"])) {
    $username = $_POST["username"];
    //$username = preg_match("#[^0-9a-z]#i", "", $username);
    $sql = "SELECT * FROM users WHERE username LIKE '%$username%' OR userfullname LIKE '%$username%'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0) {
        echo "There Was No Search Are";
    } else {
        while ($row = mysqli_fetch_array($result)) {
            $dusername = $row['username'];
            $duseravatar = $row['useravatar'];
            $duserfullname = $row['userfullname'];

            echo "<div class='RandomUser_Card'>
                    <a href='" . $dusername . "'>
                        <img src='" . $duseravatar . "' alt=''>
                        <div class='RandomUser_Card_Name'>
                            <p>" . $duserfullname . "</p>
                            <p>@" . $dusername . "</p>
                        </div>
                        <button>Follow</button>
                    </a>
                </div>";
        }
    }
    mysqli_close($conn);
}
