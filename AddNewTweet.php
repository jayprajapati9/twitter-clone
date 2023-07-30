<?php
session_start();
$sessionUserId = $_SESSION["sessionUserId"];
$sessionUsername = $_SESSION["sessionUsername"];

include 'Functions.php';

if (empty($_POST['d_tweet'])) {
    echo "<script>alert('Please Enter Tweet.');</script>";
}

if (isset($_POST['d_tweet'])) {
    include 'connection.php';
    $d_tweet  = htmlentities(trim(strip_tags(mysqli_real_escape_string($conn, $_POST['d_tweet']))));;
    AddNewTweet($d_tweet); // It Is Function From Functions.php
    mysqli_close($conn);
}
?>