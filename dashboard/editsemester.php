<?php
require('../Including/db_connection.php');
session_start();

$semid = $_GET['id'];

if (!isset($_SESSION['username'])) {
    header("location: ../index.php");
    exit();
}

$sql = "SELECT * FROM `semester` WHERE id=$semid";

$data = mysqli_query($conn, $sql);

$output = mysqli_fetch_assoc($data);


$classFaculty = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $class = $_POST['class'];
    $sem = $_POST['sem'];

    // Fetch faculty based on the selected class
    if (!empty($class)) {
        $sql = "SELECT faculty FROM class WHERE class='$class'";
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $classFaculty = $row['faculty'];
        }
    }
    if (!empty($classFaculty) && !empty($class) && !empty($sem)) {
        $sql = "UPDATE `semester` SET `class`='$class',`faculty`='$classFaculty',`semester`='$sem' WHERE id=$semid";
        $data = mysqli_query($conn, $sql);

        if ($data) {
            echo "<script>alert('Semester Update successfully')</script>";
            echo "<meta http-equiv='refresh' content='0; url=http://localhost/ams/dashboard/viewsemester.php'>";

        } else {
            echo "<script>alert('Failed to update semester')</script>";
        }
    } else {
        echo "<script>alert('Please select a class.')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- primary meta tags -->
    <title>Dashboard</title>
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
                    <h2>Update Semester</h2>
                    <h3><a href="dashboard.php">Dashboard</a>/ <a href="viewsemester.php">View Semester</a>/ Add
                        Semester</h3>
                </div>

                <div class="form-container">

                    <h2>Update Semester</h2>

                    <h4>Semester Details</h4>

                    <form action="<?php echo $_SERVER['PHP_SELF'] . "?id=$semid"; ?>" method="POST">


                        <div class="input-field">
                            <label for="class">Class Name</label>
                            <select name="class" id="class">
                                <option value="">Select Class</option>
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
                            <label for="sem">Semester</label>
                            <select name="sem" class="select" id="sem">
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

                        <input type="hidden" name="fname" value="<?php echo $classFaculty; ?>">


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