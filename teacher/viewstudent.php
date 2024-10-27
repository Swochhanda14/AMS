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
                    <h2>All Student in (<span><?php echo $result['class'] ?> | <?php echo $result['semester'] ?></span>)
                    </h2>
                    <h3><a href="dashboard.php">Dashboard</a> / View Student</h3>
                </div>

                <div class="table-container">

                    <h2>Student List</h2>

                    <div class="search-container">
                        <form action="#" method="GET">
                            <div class="showentrie">
                                <label for="entries">Show</label>
                                <select name="entrie" onchange="this.form.submit()">
                                    <option value="10" <?php echo (isset($_GET['entrie']) && $_GET['entrie'] == 10) ? 'selected' : ''; ?>>10</option>
                                    <option value="20" <?php echo (isset($_GET['entrie']) && $_GET['entrie'] == 20) ? 'selected' : ''; ?>>20</option>
                                    <option value="50" <?php echo (isset($_GET['entrie']) && $_GET['entrie'] == 50) ? 'selected' : ''; ?>>50</option>
                                    <option value="100" <?php echo (isset($_GET['entrie']) && $_GET['entrie'] == 100) ? 'selected' : ''; ?>>100</option>
                                </select>
                                <label for="entries">Entries</label>
                            </div>

                            <div class="searchbar">
                                <?php $searchValue = isset($_GET['search']) ? $_GET['search'] : ''; ?>
                                <input type="search" name="search" value="<?php echo $searchValue; ?>"
                                    placeholder="Search by Student name/id">
                                <input type="submit" value="Search">
                            </div>
                        </form>
                    </div>

                    <div class="table">
                        <table class="user-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Address</th>
                                    <th>Admission Id</th>
                                    <th>Class</th>
                                    <th>Semester</th>
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

                                    if (isset($_GET['search']) && !empty($_GET['search'])) {
                                        $value = $_GET['search'];
                                        $studentQuery = "SELECT * FROM student WHERE class = '$class' AND semester = '$semester' AND CONCAT(fname, admissionid) LIKE '%$value%' ORDER BY fname ASC";
                                    } else {
                                        $studentQuery = "SELECT * FROM student WHERE class = '$class' AND semester = '$semester' ORDER BY fname ASC";
                                    }
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
                                                <td><?php echo $studentData['address']; ?></td>
                                                <td><?php echo $studentData['admissionid']; ?></td>
                                                <td><?php echo $studentData['class']; ?></td>
                                                <td><?php echo $studentData['semester']; ?></td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='7'>No records found.</td></tr>";
                                    }
                                }

                                ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="totalcount">
                        <p>Showign 1 to <span><?php echo $total; ?></span> of <span><?php echo $total; ?></span> Entries
                        </p>
                    </div>


                </div>


            </div>
        </div>
        <!-- body part  -->
    </div>
</body>

<script src="../js/script.js"></script>

</html>