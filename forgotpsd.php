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

                        <h2 class="title-medium">Password reset Pannel</h2>

                        <div class="form-contents">
                            <div class="form-content">
                                <input type="email" name="email" required maxlength="100" placeholder="Email"
                                    id="email">
                                <span class="material-symbols-rounded loginicon">email</span>
                            </div>

                            <div class="form-content">
                                <input type="password" name="password" required maxlength="20"
                                    placeholder="New Password" id="password">
                                <span class="material-symbols-rounded loginicon">lock</span>
                            </div>

                            <div class="form-content">
                                <input type="password" name="confirm_password" required maxlength="20"
                                    placeholder="Confirm Password" id="confirm_password">
                                <span class="material-symbols-rounded loginicon">lock</span>
                            </div>


                            <input type="submit" class="contact-btn" name="login" value="Reset">

                            <div class="form-content psdforgot">
                                <a href="index.php" id="backToLoginLink">
                                    << Back to Login>>
                                </a>
                            </div>



                        </div>

                    </form>

                </div>

            </div>

        </article>
    </main>


</body>

<script src=""></script>

</html>