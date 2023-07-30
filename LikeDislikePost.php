<?php 
session_start();
$sessionUserId = $_SESSION["sessionUserId"];
$sessionUsername = $_SESSION["sessionUsername"];

include 'Functions.php';

if (isset($_POST['how'])){
    $post_id = $_POST['data'];
    include 'connection.php';
    likeDislikePost($post_id);
    mysqli_close($conn);
}
