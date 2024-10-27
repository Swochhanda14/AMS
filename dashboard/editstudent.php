<?php
require('../Including/db_connection.php');
session_start();

$stdid = $_GET['id'];

if (!isset($_SESSION['username'])) {
    header("location: ../index.php");
    exit();
}

$sql = "SELECT * FROM `student` WHERE id=$stdid";

$data = mysqli_query($conn, $sql);

$output = mysqli_fetch_assoc($data);

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
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $address = $_POST['address'];
        $addmissionid = $_POST['addmissionid'];
        $class = $_POST['class'];
        $semester = $_POST['semester'];

        if (!empty($fname) && !empty($lname) && !empty($address) && !empty($addmissionid) && !empty($class) && !empty($semester)) {
            $sql = "UPDATE `student` SET `fname`='$fname',`lname`='$lname',`address`='$address',`admissionid`='$addmissionid',`class`='$class',`semester`='$semester' WHERE id=$stdid";
            $data = mysqli_query($conn, $sql);

            if ($data) {
                echo "<script>alert('Student updated successfully!')</script>";
                echo "<meta http-equiv='refresh' content='0; url=http://localhost/ams/dashboard/viewstudent.php'>";
            } else {
                echo "<script>alert('Failed to update student!')</script>";
            }
        } else {
            echo "<script>alert('Please fill all the fields')</script>";
        }
    }
    ?>
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

                    <form action="<?php echo $_SERVER['PHP_SELF'] . "?id=$stdid" ?>" method="POST">
                        <div class="flex">
                            <div class="input-field">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control" id="fname" name="fname" required
                                    placeholder="Enter First name" value="<?php echo $output['fname'] ?>">
                            </div>

                            <div class="input-field">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-control" id="lname" name="lname" required
                                    placeholder="Enter Last name" value="<?php echo $output['lname'] ?>">
                            </div>
                        </div>

                        <div class="flex">
                            <div class="input-field">
                                <label for="address">Address</label>
                                <input type="address" class="form-control" id="address" name="address" required
                                    placeholder="Enter address" value="<?php echo $output['address'] ?>">
                            </div>

                            <div class="input-field">
                                <label for="addmissionid">Addmission Id</label>
                                <input type="addmissionid" class="form-control" id="addmissionid" name="addmissionid"
                                    required placeholder="Enter Admission id"
                                    value="<?php echo $output['admissionid'] ?>">
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
                                        $selected = ($row['class'] == $output['class']) ? 'selected' : '';
                                        echo "<option value='" . $row['class'] . "' $selected>" . $row['class'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="input-field">
                                <label for="semester">Semester</label>
                                <select name="semester" id="semester">
                                    <option value="">Select Semester</option>
                                    <option value="1st Semester" <?php echo ($output['semester'] == '1st Semester') ? 'selected' : ''; ?>>1st Semester</option>
                                    <option value="2nd Semester" <?php echo ($output['semester'] == '2nd Semester') ? 'selected' : ''; ?>>2nd Semester</option>
                                    <option value="3rd Semester" <?php echo ($output['semester'] == '3rd Semester') ? 'selected' : ''; ?>>3rd Semester</option>
                                    <option value="4th Semester" <?php echo ($output['semester'] == '4th Semester') ? 'selected' : ''; ?>>4th Semester</option>
                                    <option value="5th Semester" <?php echo ($output['semester'] == '5th Semester') ? 'selected' : ''; ?>>5th Semester</option>
                                    <option value="6th Semester" <?php echo ($output['semester'] == '6th Semester') ? 'selected' : ''; ?>>6th Semester</option>
                                    <option value="7th Semester" <?php echo ($output['semester'] == '7th Semester') ? 'selected' : ''; ?>>7th Semester</option>
                                    <option value="8th Semester" <?php echo ($output['semester'] == '8th Semester') ? 'selected' : ''; ?>>8th Semester</option>
                                </select>
                            </div>
                        </div>

                        <input type="submit" name="submit" class="submit-btn">

                    </form>
                </div>



            </div>

        </div>
        <!-- body part  -->
    </div>
</body>

<script src="../js/script.js"></script>

</html>