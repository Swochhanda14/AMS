<?php
require('../Including/db_connection.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- primary meta tags -->
    <title>Dashboard Login</title>
    <meta name="description" content="Attendence managemant system" />

    <!-- favicon -->
    <link rel="shortcut icon" href="../assets/logo/roll-call.png" type="image/svg+xml" />


    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <!-- links css      -->
    <?php
    require('../including/links.php');
    ?>
    <link rel="stylesheet" href="../css/dashboard.css" />

</head>

<body>
    <div class="container">

        <!-- sidebar  -->
        <?php
        require('../including/sidebar.php');
        ?>

        <!-- body part  -->
        <div class="dashboard">

            <!-- topheader    -->
            <?php
            require('../including/topheader.php');
            ?>

            <div class="dashboard-content">

                <div class="dashboard-title">
                    <h2>Add Teacher</h2>
                    <h3><a href="dashboard.php">Dashboard</a>/ <a href="viewteacher.php">View Teacher</a>/ Add Teacher
                    </h3>
                </div>

                <div class="form-container">

                    <h2>Add Teacher</h2>

                    <h4>Teacher Details</h4>

                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="flex">
                            <div class="input-field">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control" id="fname" name="fname"
                                    placeholder="Enter First name">
                            </div>

                            <div class="input-field">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-control" id="lname" name="lname"
                                    placeholder="Enter Last name">
                            </div>
                        </div>

                        <div class="flex">
                            <div class="input-field">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Enter Username">
                            </div>

                            <div class="input-field">
                                <label for="password">Password</label>
                                <input type="text" class="form-control" id="password" name="password"
                                    placeholder="Enter Password" value="1234" readonly>
                            </div>
                        </div>

                        <div class="flex">
                            <div class="input-field">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    placeholder="Enter your number">
                            </div>

                            <div class="input-field">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="Enter your address">
                            </div>
                        </div>

                        <div class="flex">
                            <div class="input-field">
                                <label for="class">Class</label>
                                <select name="class" id="class">
                                    <option value="">Select class</option>
                                    <?php
                                    $sql = "SELECT * FROM class";
                                    $data = mysqli_query($conn, $sql);

                                    while ($row = mysqli_fetch_assoc($data)) {
                                        echo "<option value='" . $row['class'] . "'>" . $row['class'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="input-field">
                                <label for="semester">Semester</label>
                                <select name="semester" id="semester">
                                    <option value="">Select semester</option>
                                    <option value="1st Semester">1st Semester</option>
                                    <option value="2nd Semester">2nd Semester</option>
                                    <option value="3rd Semester">3rd Semester</option>
                                    <option value="4th Semester">4th Semester</option>
                                    <option value="5th Semester">5th Semester</option>
                                    <option value="6th Semester">6th Semester</option>
                                    <option value="7th Semester">7th Semester</option>
                                    <option value="8th Semester">8th Semester</option>
                                </select>
                            </div>
                        </div>

                        <input type="submit" name="submit" class="submit-btn">

                    </form>
                </div>
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
                    $fname = $_POST['fname'];
                    $lname = $_POST['lname'];
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $phone = $_POST['phone'];
                    $address = $_POST['address'];
                    $class = $_POST['class'];
                    $semester = $_POST['semester'];

                    if (!empty($fname) && !empty($lname) && !empty($username) && !empty($password) && !empty($phone) && !empty($address) && !empty($class) && !empty($semester)) {
                        $checkQuery = "SELECT * FROM teacher WHERE username = '$username' AND class = '$class'";
                        $checkResult = mysqli_query($conn, $checkQuery);

                        if (mysqli_num_rows($checkResult) > 0) {
                            echo "<script>alert('Username and class already exists. Please enter a unique combination.')</script>";
                        } else {
                            $sql = "INSERT INTO teacher (fname, lname, username, password, phone, address, class, semester) VALUES ('$fname', '$lname', '$username', '$password', '$phone', '$address', '$class', '$semester')";
                            $data = mysqli_query($conn, $sql);

                            if ($data) {
                                echo "<script>alert('Teacher added successfully')</script>";
                                echo "<meta http-equiv='refresh' content='0; url=http://localhost/ams/dashboard/viewteacher.php'>";
                            } else {
                                echo "<script>alert('Failed to add teacher')</script>";
                            }
                        }
                    } else {
                        echo "<script>alert('Please fill all the fields')</script>";
                    }
                }
                ?>


            </div>

        </div>
        <!-- body part  -->
    </div>
</body>

<script src="../js/script.js"></script>

</html>