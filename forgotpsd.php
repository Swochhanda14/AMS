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

                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                        <h2 class="title-medium">Password reset Pannel</h2>

                        <div class="form-contents">
                            <div class="form-content">
                                <input type="text" name="username" required maxlength="100" placeholder="Username"
                                    id="username">
                                <span class="material-symbols-rounded loginicon">person</span>
                            </div>

                            <div class="form-content">
                                <input type="password" name="password" required maxlength="20"
                                    placeholder="New Password" id="password">
                                <span class="material-symbols-rounded loginicon">lock</span>
                            </div>

                            <div class="form-content">
                                <input type="password" name="cpassword" required maxlength="20"
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
                <?php
                if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
                    $username = $_POST['username'];
                    $password = isset($_POST['password']) ? $_POST['password'] : null;
                    $confirm_password = isset($_POST['cpassword']) ? $_POST['cpassword'] : null;

                    // Validate password and confirm password
                    if($password != $confirm_password){
                        echo "<script>alert('Password do not match')</script>";
                    }

                    // Check if username exists
                    $sql = "SELECT * FROM teacher WHERE username = '$username'";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) == 0){
                        echo "<script>alert('Username does not exist')</script>";
                    }

                    // Update password
                    $sql = "UPDATE teacher SET password = '$password' WHERE username = '$username'";
                    $result = mysqli_query($conn, $sql);
                    if($result){
                        echo "<script>alert('Password reset successfully')</script>";
                        echo "<meta http-equiv='refresh' content='0; url=index.php'>";
                    }
                }      
                ?>
                </div>

            </div>

        </article>
    </main>


</body>

<script src=""></script>

</html>