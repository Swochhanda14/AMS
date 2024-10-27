<?php
require('../Including/db_connection.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("location: ../index.php");
    exit();
}

 // Get today's date
 $currentDate = date("Y-m-d");

 // Fetch present students count
 $presentQuery = "SELECT COUNT(*) AS presentCount FROM studentattendence WHERE date = '$currentDate' AND attendence = 'present'";
 $presentResult = mysqli_query($conn, $presentQuery);
 $presentData = mysqli_fetch_assoc($presentResult);
 $presentCount = $presentData['presentCount'] ?? 0;

 // Fetch absent students count
 $absentQuery = "SELECT COUNT(*) AS absentCount FROM studentattendence WHERE date = '$currentDate' AND attendence = 'absent'";
 $absentResult = mysqli_query($conn, $absentQuery);
 $absentData = mysqli_fetch_assoc($absentResult);
 $absentCount = $absentData['absentCount'] ?? 0;
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
                    <h2>Welcome Admin!</h2>
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
                                $query = "SELECT COUNT(*) FROM student";
                                $result = mysqli_query($conn, $query);
                                $row = mysqli_fetch_array($result);
                                echo $row[0];
                                ?>
                            </span>

                            <h3>Students</h3>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-icon">
                            <span class="material-symbols-rounded">meeting_room</span>
                        </div>
                        <div class="card-info">
                            <span class="total">
                            <?php
                                $query = "SELECT COUNT(*) FROM class";
                                $result = mysqli_query($conn, $query);
                                $row = mysqli_fetch_array($result);
                                echo $row[0];
                                ?>
                            </span>

                            <h3>Faculty</h3>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-icon">
                            <span class="material-symbols-rounded">join</span>
                        </div>
                        <div class="card-info">
                            <span class="total">
                            <?php
                                $query = "SELECT COUNT(*) FROM semester";
                                $result = mysqli_query($conn, $query);
                                $row = mysqli_fetch_array($result);
                                echo $row[0];
                                ?>
                            </span>

                            <h3>Semester</h3>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-icon">
                            <span class="material-symbols-rounded">groups</span>
                        </div>
                        <div class="card-info">
                            <span class="total">
                                <?php
                                echo $presentCount;
                                ?>
                            </span>

                            <h3>Total student attendent</h3>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-icon">
                            <span class="material-symbols-rounded">person</span>
                        </div>
                        <div class="card-info">
                            <span class="total">
                            <?php
                                $query = "SELECT COUNT(*) FROM teacher";
                                $result = mysqli_query($conn, $query);
                                $row = mysqli_fetch_array($result);
                                echo $row[0];
                                ?>
                            </span>

                            <h3>Class Teachers</h3>
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