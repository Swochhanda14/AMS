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
    <title>Admin Dashboard Login</title>
    <meta name="description" content="Attendence managemant system">

    <!-- favicon -->
    <link rel="shortcut icon" href="../assets/logo/roll-call.png" type="image/svg+xml">

    <?php
    require('including/links.php');
    ?>

    <!-- custome links css  -->
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

                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">

                        <h2 class="title-medium">Dashboard Login Pannel</h2>

                        <h3 class="text-small">Access to our dashboard</h3>

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
                                <input type="text" name="username" required maxlength="50" placeholder="Username"
                                    id="username">
                                <span class="material-symbols-rounded loginicon">person</span>
                            </div>

                            <div class="form-content">
                                <input type="password" name="password" required maxlength="20" placeholder="Password"
                                    id="password">
                                <span class="material-symbols-rounded loginicon">lock</span>
                            </div>

                            <div class="flexs">
                                <div class="form-content forgotpsd">
                                    <input type="checkbox" id="remember">
                                    <label for="remember">Remember me</label>
                                </div>

                                <div class="form-content forgotpsd">
                                    <a href="forgotpsd.php">Forgot Password?</a>
                                </div>
                            </div>

                            <input type="submit" class="contact-btn" name="login" value="Log in">



                        </div>

                    </form>
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
                        $type = $_POST['type'];
                        $username = $_POST['username'];
                        $password = $_POST['password'];

                        // Determine the table to query based on user type
                        $table = $type === 'admin' ? 'admin' : 'teacher';

                        // Query the appropriate table
                        $sql = "SELECT * FROM $table WHERE username = '$username' AND password = '$password'";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) == 1) {
                            $_SESSION['username'] = $username;

                            // Redirect to the corresponding dashboard based on user type
                            if ($type == 'admin') {
                                header('location: dashboard/dashboard.php');
                            } elseif ($type == 'teacher') {
                                header('location: teacher/dashboard.php');
                            }
                            exit(); // Stop further code execution after redirection
                        } else {
                            echo "<script>alert('Invalid username or password');</script>";
                            ?>
                            <meta http-equiv="refresh" content="2; url=http://localhost/ams/index.php">
                            <?php
                        }

                        mysqli_close($conn);
                    }
                    ?>



                </div>

            </div>

        </article>
    </main>


</body>

<script src=""></script>

</html>