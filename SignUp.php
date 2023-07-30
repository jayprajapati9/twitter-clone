<!-- SignUp File -->
<?php

$errorMSG = "";

session_start();
if (isset($_SESSION["sessionUsername"])) {
    header("location: Home.php");
}
include 'connection.php';

if (isset($_POST["d_username"])) {
    $username = mysqli_real_escape_string($conn, str_replace(' ', '', strtolower($_POST['d_username'])));
    $fullname = mysqli_real_escape_string($conn, $_POST['d_fullname']);
    $password = mysqli_real_escape_string($conn, md5($_POST['d_password']));
    $email = mysqli_real_escape_string($conn, $_POST['d_email']);
    $month = mysqli_real_escape_string($conn, $_POST['d_month']);
    $day = mysqli_real_escape_string($conn, $_POST['d_day']);
    $year = mysqli_real_escape_string($conn, $_POST['d_year']);
    $dob = $month . "/" . $day . "/" . $year;
    $joined = date('M Y');

    include 'connection.php';

    mysqli_query($conn, "INSERT INTO users(username, userfullname, useremail, userpassw, userdob, userjoined) VALUES ('$username', '$fullname', '$email', '$password', '$dob', '$joined')");
    mysqli_close($conn);
    // header('location: Login.php');
    // $sql ="SELECT * FROM users WHERE name = '".$_POST["username"]."'";
    // $result = mysqli_query($con,$sql);
    // if (mysqli_num_rows($result)>0) {
    //     echo '<span>Username Not Available</span>';
    // }else{
    //     echo '<span>Username Is Available</span>';     
    // }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/1811a0037b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Style/2_SignUp.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="Octa Css/OctaDist.css">
    <title>Sign up for Twitter</title>
</head>

<body>
    <section class="signUp_Card">
        <div class="signUp_Controls">
            <div class="signUp_BrandIcon">
                <i class="fa fa-twitter"></i>
            </div>
            <h1>Create your account</h1>
            <input type="text" name="username" id="username" placeholder="Username" required maxlength="30" onkeyup="this.value=removeSpaces(this.value);">
            <span class="pt-5" style="color: red;" id="available"></span>
            <input type="text" name="fullname" id="fullname" placeholder="Name" required maxlength="40">
            <input type="email" name="email" id="email" placeholder="Email" required>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <br><br>
            <h4>Date of birth</h4>
            <p>This will not be shown publicly. Confirm your own age, even if this account is for a business, a pet,
                or
                something else.</p>
            <span style="display: flex;">
                <select name="month" id="month" class="month" required>
                    <option value="Month" disabled selected>Month</option>
                    <option value="January">January</option>
                    <option value="February">February</option>
                    <option value="March">March</option>
                    <option value="April">April</option>
                    <option value="May">May</option>
                    <option value="June">June</option>
                    <option value="July">July</option>
                    <option value="August">August</option>
                    <option value="September">September</option>
                    <option value="October">October</option>
                    <option value="November">November</option>
                    <option value="December">December</option>
                </select>
                <select name="day" id="day" class="day" required>
                    <option value="Day" disabled selected>Day</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
                </select>
                <select name="year" id="year" class="year" required>
                    <option value="Year" disabled selected>Year</option>
                    <option value="2021">2021</option>
                    <option value="2020">2020</option>
                    <option value="2019">2019</option>
                    <option value="2018">2018</option>
                    <option value="2017">2017</option>
                    <option value="2016">2016</option>
                    <option value="2015">2015</option>
                    <option value="2014">2014</option>
                    <option value="2013">2013</option>
                    <option value="2012">2012</option>
                    <option value="2011">2011</option>
                    <option value="2010">2010</option>
                    <option value="2009">2009</option>
                    <option value="2008">2008</option>
                    <option value="2007">2007</option>
                    <option value="2006">2006</option>
                    <option value="2005">2005</option>
                    <option value="2004">2004</option>
                    <option value="2003">2003</option>
                    <option value="2002">2002</option>
                    <option value="2001">2001</option>
                    <option value="2000">2000</option>
                    <option value="1999">1999</option>
                    <option value="1998">1998</option>
                    <option value="1997">1997</option>
                    <option value="1996">1996</option>
                    <option value="1995">1995</option>
                    <option value="1994">1994</option>
                    <option value="1993">1993</option>
                    <option value="1992">1992</option>
                    <option value="1991">1991</option>
                    <option value="1990">1990</option>
                    <option value="1989">1989</option>
                    <option value="1988">1988</option>
                    <option value="1987">1987</option>
                    <option value="1986">1986</option>
                    <option value="1985">1985</option>
                    <option value="1984">1984</option>
                    <option value="1983">1983</option>
                    <option value="1982">1982</option>
                    <option value="1981">1981</option>
                    <option value="1980">1980</option>
                    <option value="1979">1979</option>
                    <option value="1978">1978</option>
                    <option value="1977">1977</option>
                    <option value="1976">1976</option>
                    <option value="1975">1975</option>
                    <option value="1974">1974</option>
                    <option value="1973">1973</option>
                    <option value="1972">1972</option>
                    <option value="1971">1971</option>
                    <option value="1970">1970</option>
                    <option value="1969">1969</option>
                    <option value="1968">1968</option>
                    <option value="1967">1967</option>
                    <option value="1966">1966</option>
                    <option value="1965">1965</option>
                    <option value="1964">1964</option>
                    <option value="1963">1963</option>
                    <option value="1962">1962</option>
                    <option value="1961">1961</option>
                    <option value="1960">1960</option>
                    <option value="1959">1959</option>
                    <option value="1958">1958</option>
                    <option value="1957">1957</option>
                    <option value="1956">1956</option>
                    <option value="1955">1955</option>
                    <option value="1954">1954</option>
                    <option value="1953">1953</option>
                    <option value="1952">1952</option>
                    <option value="1951">1951</option>
                    <option value="1950">1950</option>
                </select>
            </span>
            <div class="signUp_NextBtnBlock">
                <button id="submit">Submit</button>
            </div>
        </div>
    </section>
    <br><br>
    <script>
        function validateEmail(email) {
            const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }
        $(document).ready(function() {
            $('#submit').click(function() {
                var username = document.getElementById("username").value;
                var fullname = document.getElementById("fullname").value;
                var email = document.getElementById("email").value;
                var password = document.getElementById("password").value;
                var month = document.getElementById("month").value;
                var day = document.getElementById("day").value;
                var year = document.getElementById("year").value;

                if (username == "" || username == null || fullname == "" || fullname == null || email == "" || email == null || password == "" || password == null || month == "" || month == null || day == "" || day == null || year == "" || year == null) {
                    alert("Please Fill All Fields");
                } else {
                    $.ajax({
                        //url: 'signUp.php',
                        method: "POST",
                        data: {
                            d_username: username,
                            d_fullname: fullname,
                            d_email: email,
                            d_password: password,
                            d_month: month,
                            d_day: day,
                            d_year: year
                        },
                        dataType: "text",
                        cache: false,
                        success: function() {
                            alert("Created account now you can login");
                            document.getElementById("username").value = "";
                            document.getElementById("fullname").value = "";
                            document.getElementById("email").value = "";
                            document.getElementById("password").value = "";
                            document.getElementById("month").value = "";
                            document.getElementById("day").value = "";
                            document.getElementById("year").value = "";
                            //$('#available').html(html);
                        }
                    });
                }
            });
        });

        function removeSpaces(string) {
            return string.split(' ').join('');
        }
        document.getElementById("username").addEventListener("keyup", checkUserName);

        function checkUserName() {
            var x = document.getElementById("username").value;
            $.ajax({
                url: "CheckUserAvailability.php",
                method: "POST",
                cache: false,
                data: {
                    checkuseravailability: x
                },
                dataType: "text",
                success: function(html) {
                    $('#available').html(html);
                }
            });
        }
    </script>
</body>

</html>