<?php
include 'connection.php';
// For Checking Username Availability
if (isset($_POST["checkuseravailability"])) {
    $insertedUname = mysqli_real_escape_string($conn, $_POST["checkuseravailability"]);
    $sql = "SELECT * FROM users WHERE username = '" . $insertedUname . "'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo 'Username Not Available';
    } else {
        echo '';
    }
    mysqli_close($conn);
}
?>