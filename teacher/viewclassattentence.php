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
    <meta name="description" content="Attendance management system" />

    <!-- favicon -->
    <link rel="shortcut icon" href="../assets/logo/roll-call.png" type="image/svg+xml" />
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <!-- links css -->
    <?php require('../including/links.php'); ?>
    <link rel="stylesheet" href="../css/dashboard.css" />
</head>

<body>
    <div class="container">
        <!-- sidebar -->
        <?php require('included/sidebar.php'); ?>

        <!-- body part -->
        <div class="dashboard">
            <!-- topheader -->
            <?php require('included/topheader.php'); ?>

            <div class="dashboard-content">
                <div class="dashboard-title">
                    <h2>View Class Attendance (<span><?php echo $result['class'] ?> |
                            <?php echo $result['semester'] ?></span>)</h2>
                    <h3><a href="dashboard.php">Dashboard</a> / View class attendance</h3>
                </div>

                <div class="form-container">
                    <h2>Add Classes</h2>
                    <h4>Class Details</h4>
                    <form action="#" method="GET">
                        <div class="input-field">
                            <label for="date">Select Date</label>
                            <input type="date" class="form-control" id="date" name="date"
                                value="<?php echo isset($_GET['date']) ? $_GET['date'] : ''; ?>">
                        </div>
                        <input type="submit" name="submit" class="submit-btn">
                    </form>

                    <?php
                    $attendanceRecords = [];
                    $totalCount = 0;
                    $perPage = isset($_GET['entrie']) ? $_GET['entrie'] : 10;
                    $searchValue = isset($_GET['search']) ? $_GET['search'] : '';

                    if (isset($_GET['date']) && !empty($_GET['date'])) {
                        $date = $_GET['date'];
                        $class = $result['class'];
                        $semester = $result['semester'];

                        $attendanceQuery = "SELECT * FROM studentattendence WHERE date = '$date' AND class = '$class' AND semester = '$semester' ORDER BY fname ASC";
                        if (!empty($searchValue)) {
                            $attendanceQuery .= " AND CONCAT(id, fname, admissionid) LIKE '%$searchValue%' ORDER BY fname ASC";
                        }
                        $attendanceQuery .= " LIMIT $perPage";

                        $attendanceResult = mysqli_query($conn, $attendanceQuery);

                        if ($attendanceResult) {
                            $totalCount = mysqli_num_rows($attendanceResult);
                            while ($row = mysqli_fetch_assoc($attendanceResult)) {
                                $attendanceRecords[] = $row;
                            }
                        }
                    }
                    ?>
                </div>

                <div class="table-container">
                    <h2>Student List</h2>
                    <div class="search-container">
                        <div class="search-container">
                            <form action="#" method="GET">

                                <input type="hidden" name="date"
                                    value="<?php echo isset($_GET['date']) ? $_GET['date'] : ''; ?>">

                                <div class="showentrie">
                                    <label for="entries">Show</label>
                                    <select name="entrie" onchange="this.form.submit()">
                                        <option value="10" <?php if ($perPage == 10)
                                            echo 'selected'; ?>>10</option>
                                        <option value="20" <?php if ($perPage == 20)
                                            echo 'selected'; ?>>20</option>
                                        <option value="50" <?php if ($perPage == 50)
                                            echo 'selected'; ?>>50</option>
                                        <option value="100" <?php if ($perPage == 100)
                                            echo 'selected'; ?>>100</option>
                                    </select>
                                    <label for="entries">Entries</label>
                                </div>

                                <div class="searchbar">
                                    <input type="search" name="search" value="<?php echo $searchValue; ?>"
                                        placeholder="Search by Student name/id">
                                    <input type="submit" value="Search">
                                </div>
                            </form>
                        </div>

                    </div>

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
                                    <th>Attendance</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($totalCount > 0) {
                                    $counter = 1;
                                    foreach ($attendanceRecords as $attendance) {
                                        $bgColor = ($attendance['attendence'] === 'present') ? 'style="background-color: green; color: white;"' : 'style="background-color: red; color: white;"';
                                        echo "<tr>
                                                <td>{$counter}</td>
                                                <td>{$attendance['fname']}</td>
                                                <td>{$attendance['lname']}</td>
                                                <td>{$attendance['admissionid']}</td>
                                                <td>{$attendance['class']}</td>
                                                <td>{$attendance['semester']}</td>
                                                <td $bgColor>{$attendance['attendence']}</td>
                                                <td>{$attendance['date']}</td>
                                              </tr>";
                                        $counter++;
                                    }
                                } else {
                                    echo "<tr><td colspan='8'>No records found for the selected date.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="totalcount">
                        <p>Showing 1 to <?php echo $totalCount; ?> of <?php echo $totalCount; ?> Entries</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- body part -->
    </div>
</body>

<script src="../js/script.js"></script>

</html>