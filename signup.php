<?php
require('including/db_connection.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- primary meta tags -->
    <title>Dashboard Signup</title>
    <meta name="description" content="Attendence managemant system">

    <!-- favicon -->
    <link rel="shortcut icon" href="../assets/logo/roll-call.png" type="image/svg+xml">

    <?php
    require('including/links.php');
    ?>

    <!-- custome links css      -->
    <link rel="stylesheet" href="css/customproperty.css" />
    <link rel="stylesheet" href="css/typography.css" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">

</head>

<body>

    <main>
        <article>

            <div class="form-container">

                <div class="form">

                    <form action="" method="post">

                        <h2 class="title-medium">Dashboard Signup Pannel</h2>

                        <div class="form-contents">

                            <div class="flex">
                                <div class="form-content radioinput">
                                    <input type="radio" name="type" value="teacher" id="teacher">
                                    <label for="teacher">Teacher</label>
                                </div>
    
                                <div class="form-content radioinput">
                                    <input type="radio" name="type" value="admin" id="admin">
                                    <label for="admin">Admin</label>
                                </div>
                            </div>

                            <div class="form-content">
                                <input type="text" name="name" required maxlength="50" placeholder="Full name"
                                    id="name">
                                <span class="material-symbols-rounded loginicon">person</span>
                            </div>

                            <div class="form-content">
                                <input type="text" name="userid" required maxlength="50" placeholder="User Id"
                                    id="userid">
                                <span class="material-symbols-rounded loginicon">person</span>
                            </div>

                            <div class="form-content">
                                <input type="email" name="email" required maxlength="50" placeholder="Email"
                                    id="email">
                                <span class="material-symbols-rounded loginicon">email</span>
                            </div>

                            <div class="form-content">
                                <input type="password" name="password" required maxlength="20" placeholder="Password"
                                    id="password">
                                <span class="material-symbols-rounded loginicon">lock</span>
                            </div>

                            <div class="form-content">
                                <input type="password" name="confirmPassword" required maxlength="20"
                                    placeholder="Confirm Password" id="confirmPassword">
                                <span class="material-symbols-rounded loginicon">lock</span>
                            </div>


                            <div class="flexs">
                                <div class="form-content forgotpsd">
                                    <input type="checkbox" id="remember">
                                    <label for="remember">Remember me</label>
                                </div> 
                            </div>

                            <input type="submit" class="contact-btn" name="login" value="Log in">

                            <p class="signupdes">Already have account <a href="index.php">Sigin here.</a></p>

                        </div>

                    </form>

                </div>

            </div>

        </article>
    </main>
 

</body>

<script src=""></script>

</html>