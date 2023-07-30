<?php
session_start();
$sessionUsername = $_SESSION['sessionUsername'];
include 'Functions.php';

if ($_GET['username']) {
	if ($_GET['username'] != $sessionUsername) {
		$unfollow_username = $_GET['username'];
		include 'connection.php';
		unFollowFunc($unfollow_username);
		header("Location: " . $_SERVER['HTTP_REFERER']);
	}
}
?>
