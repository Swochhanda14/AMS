<?php
require('../Including/db_connection.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("location: ../index.php");
    exit();
}

$id = $_SESSION['username'];

$sql = "SELECT * FROM teacher WHERE username ='$id'";

$data = mysqli_query($conn, $sql);

$result = mysqli_fetch_assoc($data);


// Fetch current date
$currentDate = date("Y-m-d");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- primary meta tags -->
    <title>Teacher Dashboard</title>
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
        require('included/sidebar.php');
        ?>

        <!-- body part  -->
        <div class="dashboard">

            <!-- topheader    -->
            <?php
            require('included/topheader.php');
            ?>

            <div class="dashboard-content">

                <div class="dashboard-title">
                    <h2>Take Attendance (Today's Date: <span><?php echo $currentDate; ?></span>)</h2>
                    <h3><a href="dashboard.php">Dashboard</a> / Student attendence</h3>
                </div>

                <div class="table-container">

                    <div class="table-heading" style="display: flex; justify-content: space-between;">
                        <h2 style="font-size: 18px;">All Student in (<span><?php echo $result['class'] ?> |
                                <?php echo $result['semester'] ?></span>)</h2>
                        <h2 style="color: red; font-size: 18px;"><em>Note: Click on the checkboxes besides each student
                                to take attendance!</em></h2>

                    </div>


                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <input type="hidden" name="attendance_date" value="<?php echo $currentDate; ?>">
                        <div class="table">
                            <table class="user-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Admission Id</th>
                                        <th>Class</th>
                                        <th>Semester</th>
                                        <th>Attendence</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $username = $_SESSION['username'];
                                    $teacherQuery = "SELECT class, semester FROM teacher WHERE username = '$username'";
                                    $teacherResult = mysqli_query($conn, $teacherQuery);
                                    $teacherData = mysqli_fetch_assoc($teacherResult);

                                    if ($teacherData) {
                                        $class = $teacherData['class'];
                                        $semester = $teacherData['semester'];

                                        $studentQuery = "SELECT * FROM student WHERE class = '$class' AND semester = '$semester' ORDER BY fname ASC";

                                        $studentResult = mysqli_query($conn, $studentQuery);

                                        $total = mysqli_num_rows($studentResult);
                                        if ($total > 0) {
                                            $counter = 1;
                                            while ($studentData = mysqli_fetch_assoc($studentResult)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $counter++; ?></td>
                                                    <td><?php echo $studentData['fname']; ?></td>
                                                    <td><?php echo $studentData['lname']; ?></td>
                                                    <td><?php echo $studentData['admissionid']; ?></td>
                                                    <td><?php echo $studentData['class']; ?></td>
                                                    <td><?php echo $studentData['semester']; ?></td>
                                                    <td>
                                                        <div class="radio-inputs">
                                                            <label class="present">
                                                                <input class="radio-input" type="radio"
                                                                    name="attendance[<?php echo $studentData['id']; ?>]"
                                                                    value="present">
                                                                <span class="radio-tile">
                                                                    <span
                                                                        class="material-symbols-rounded atticon">check_circle</span>
                                                                    <span class="radio-label">Present</span>
                                                                </span>
                                                            </label>

                                                            <label class="absent">
                                                                <input class="radio-input" type="radio"
                                                                    name="attendance[<?php echo $studentData['id']; ?>]"
                                                                    value="absent">
                                                                <span class="radio-tile">
                                                                    <span class="material-symbols-rounded atticon">cancel</span>
                                                                    <span class="radio-label">Absent</span>
                                                                </span>
                                                            </label>
                                                        </div>

                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }else{
                                             echo "<tr><td colspan='7'>No students found in this class and semester.</td></tr>";
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-bottom">
                            <div class="totalcount">
                                <p>Showign 1 to <span><?php echo $total; ?></span> of <span><?php echo $total; ?></span>
                                    Entries</p>
                            </div>

                            <div class="submit-attendence">
                                <button type="submit" class="btn">Submit Attendance</button>
                            </div>
                        </div>
                    </form>
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $attendance_date = $_POST['attendance_date'];
                        $attendance = $_POST['attendance'];
                        $success = true;

                        foreach ($attendance as $student_id => $status) {
                            $studentQuery = "SELECT fname, lname, admissionid, class, semester FROM student WHERE id = '$student_id'";
                            $studentResult = mysqli_query($conn, $studentQuery);
                            $studentData = mysqli_fetch_assoc($studentResult);

                            if ($studentData) {
                                $fname = $studentData['fname'];
                                $lname = $studentData['lname'];
                                $admissionid = $studentData['admissionid'];
                                $class = $studentData['class'];
                                $semester = $studentData['semester'];

                                $sql = "INSERT INTO studentattendence (fname, lname, admissionid, class, semester, attendence, date) VALUES ('$fname', '$lname', '$admissionid', '$class', '$semester', '$status', '$attendance_date')";
                                if (!mysqli_query($conn, $sql)) {
                                    $success = false;
                                    echo "<script>alert('Failed to record attendance for $fname $lname')</script>";
                                }
                            } else {
                                echo "<script>alert('Student not found!')</script>";
                            }
                        }

                        if ($success) {
                            echo "<script>alert('Attendance recorded successfully!')</script>";
                            echo "<meta http-equiv='refresh' content='0; url=http://localhost/ams/teacher/takeattendence.php'>";
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