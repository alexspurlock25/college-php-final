<?php
$username = $_SESSION['username'];
$login_time = $_SESSION['login_time'];

?>
<!-- This file is the LOGIN/REGISTER page of the website.
User will be able to login or register. -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login Here</title>
    <link rel="stylesheet" type="text/css" href="../css_files/main-style.css">
    <style>
        body {
            background-image: url("../images/website-background/edited_background.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            overflow-x: scroll;
            overflow-y: hidden;
        }
    </style>
</head>

<!-- Start Login/Register Form -->
<div class="outer">
    <div class="middle">
        <div class="login-page-form-container">
            <div class="left-half-login"><!-- start LEFT HALF OF LOGIN PAGE -->
                <div>
                    <h1>Recipe Jar</h1>
                    <p>your virtual recipe box.</p>
                </div>
            </div><!-- end LEFT HALF OF LOGIN PAGE -->

            <div class="right-half-login"><!-- start RIGHT HALF OF LOGIN PAGE -->
                <div>
                    <form action="" method="post">
                        <div class="login-form">
                            <label>
                                <input type="text" id="username" name="username" placeholder="Username" required></label><br />
                            <label>
                                <input type="password" id="password" name="password" placeholder="Password" required></label><br />
                            <input class="login_button" id="login" type="submit" name="submit" value="Login">
                            <input class="login_button" id="register" type="submit" name="register" value="Register">
                        </div>
                        <?php
                        include "config.php";

                        if (isset($_POST['submit'])){

                            $username = mysqli_real_escape_string($con, $_POST['username']);
                            $password = mysqli_real_escape_string($con, $_POST['password']);
                            if ($username != "" && $password != "") {
                                $sql_query = "SELECT COUNT(*) AS countUsers, LoginID FROM tLogin WHERE Username='".$username."' and Password='".$password."'";
                                $result = mysqli_query($con,$sql_query);
                                $row = mysqli_fetch_array($result);
                                $count = $row['countUsers'];

                                if($count == 1){
                                    session_start();
                                    $_SESSION['login_time'] = date("h:i");
                                    $_SESSION['username'] = $username;
                                    header('Location: home.php');
                                } else {
                                    echo "Invalid username and password. Try again.";
                                }
                            }

                        }
                        if (isset($_POST['register'])){

                            $username = mysqli_real_escape_string($con, $_POST['username']);
                            $password = mysqli_real_escape_string($con, $_POST['password']);
                            if ($username != "" && $password != "") {
                                $sql_query = "SELECT COUNT(*) AS countUsers FROM tLogin WHERE Username='".$username."'";
                                $result = mysqli_query($con,$sql_query);
                                $row = mysqli_fetch_array($result);
                                $count = $row['countUsers'];

                                if($count > 0){
                                   echo "Username taken. Your creativity sucks.";
                                }
                                elseif (strlen ($username) > 15){
                                    print 'Username has to be at most 15 characters.';
                                }
                                else {

                                    $insertquery = "INSERT INTO tLogin (LoginID, Username, Password) VALUES (0, '$username', '$password')";

                                    if(mysqli_query($con, $insertquery)) {
                                        session_start();
                                        $_SESSION['username'] = $username;
                                        print '<p>Login you in....</p>';
                                        header('refresh:3; url=home.php');

                                    }else{
                                        print '<p>Could not register user. Try again.</p>';
                                    }
                                }
                            }
                        }

                        ?>

                    </form>
                </div>
            </div><!-- end RIGHT HALF OF LOGIN PAGE -->


        </div> <!-- END login-page-form-container -->
    </div>
</div>
<!-- End Login/Register Form -->
</html>
