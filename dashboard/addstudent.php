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
                    <h2>Add Student</h2>
                    <h3><a href="dashboard.php">Dashboard</a>/ <a href="viewstudent.php">View Student</a>/ Add Student
                    </h3>
                </div>

                <div class="form-container">

                    <h2>Add Student</h2>

                    <h4>Students Details</h4>

                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="flex">
                            <div class="input-field">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control" id="fname" name="fname" required
                                    placeholder="Enter First name">
                            </div>

                            <div class="input-field">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-control" id="lname" name="lname" required
                                    placeholder="Enter Last name">
                            </div>
                        </div>

                        <div class="flex">
                            <div class="input-field">
                                <label for="address">Address</label>
                                <input type="address" class="form-control" id="address" name="address" required
                                    placeholder="Enter address">
                            </div>

                            <div class="input-field">
                                <label for="addmissionid">Addmission Id</label>
                                <input type="addmissionid" class="form-control" id="addmissionid" name="addmissionid"
                                    required placeholder="Enter Admission id">
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
                    $address = $_POST['address'];
                    $addmissionid = $_POST['addmissionid'];
                    $class = $_POST['class'];
                    $semester = $_POST['semester'];

                    if (!empty($fname) && !empty($lname) && !empty($address) && !empty($addmissionid) && !empty($class) && !empty($semester)) {
                        $checkQuery = "SELECT * FROM student WHERE admissionid = '$addmissionid'";
                        $checkResult = mysqli_query($conn, $checkQuery);

                        if (mysqli_num_rows($checkResult) > 0) {
                            echo "<script>alert('Admission ID already exists. Please enter a unique Admission ID.')</script>";
                        } else {
                            $sql = "INSERT INTO student (fname, lname, address, admissionid, class, semester) VALUES ('$fname', '$lname', '$address', '$addmissionid', '$class', '$semester')";
                            $data = mysqli_query($conn, $sql);

                            if ($data) {
                                echo "<script>alert('Student added successfully!')</script>";
                                echo "<meta http-equiv='refresh' content='0; url=http://localhost/ams/dashboard/viewstudent.php'>";
                            } else {
                                echo "<script>alert('Failed to add student!')</script>";
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