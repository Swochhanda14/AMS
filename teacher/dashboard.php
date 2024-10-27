<?php
require('../Including/db_connection.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("location: ../index.php");
    exit();
}


$username = $_SESSION['username'];

$teacherQuery = "SELECT class, semester FROM teacher WHERE username = '$username'";

$teacherResult = mysqli_query($conn, $teacherQuery);

$teacherData = mysqli_fetch_assoc($teacherResult);

if ($teacherData) {
    $class = $teacherData['class'];
    $semester = $teacherData['semester'];
    $studentQuery = "SELECT * FROM student WHERE class = '$class' AND semester = '$semester'";
    $studentResult = mysqli_query($conn, $studentQuery);
    $total = mysqli_num_rows($studentResult);

    // Get today's date
    $currentDate = date("Y-m-d");

    // Fetch present students count
    $presentQuery = "SELECT COUNT(*) AS presentCount FROM studentattendence WHERE class = '$class' AND semester = '$semester' AND date = '$currentDate' AND attendence = 'present'";
    $presentResult = mysqli_query($conn, $presentQuery);
    $presentData = mysqli_fetch_assoc($presentResult);
    $presentCount = $presentData['presentCount'] ?? 0;

    // Fetch absent students count
    $absentQuery = "SELECT COUNT(*) AS absentCount FROM studentattendence WHERE class = '$class' AND semester = '$semester' AND date = '$currentDate' AND attendence = 'absent'";
    $absentResult = mysqli_query($conn, $absentQuery);
    $absentData = mysqli_fetch_assoc($absentResult);
    $absentCount = $absentData['absentCount'] ?? 0;
}

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
                    <h2>Welcome ClassTeacher! (<span><?php echo $teacherData['class'] ?> | <?php echo $teacherData['semester'] ?></span>)</h2>
                    <h3>Today's date: <span><?php echo $currentDate?></span></h3>
                    <h3>Dashboard</h3>
                </div>

                <div class="dashboard-card">
                    <div class="card">
                        <div class="card-icon">
                            <span class="material-symbols-rounded">groups_2</span>
                        </div>
                        <div class="card-info">
                            <span class="total">
                                <?php
                                echo $total;
                                ?>
                            </span>

                            <h3>Total Student</h3>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-icon">
                            <span class="material-symbols-rounded">meeting_room</span>
                        </div>
                        <div class="card-info">
                            <span class="total">
                                5
                            </span>

                            <h3>Classes</h3>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-icon">
                            <span class="material-symbols-rounded">groups</span>
                        </div>
                        <div class="card-info">
                            <span class="total">
                                <?php echo $presentCount;?>
                            </span>

                            <h3>Total student attendent</h3>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-icon">
                            <span class="material-symbols-rounded">groups_2</span>
                        </div>
                        <div class="card-info">
                            <span class="total">
                            <?php echo $absentCount;?>
                            </span>

                            <h3>Absent Students</h3>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!-- body part  -->
    </div>
</body>

<script src="../js/script.js"></script>

</html>