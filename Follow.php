<?php
session_start();
$sessionUsername = $_SESSION['sessionUsername'];
include 'Functions.php';

if ($_GET['username']) {
    if ($_GET['username'] != $sessionUsername) {
        $follow_username = $_GET['username'];
        include 'connection.php';
        followFunc($follow_username);
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}
?>