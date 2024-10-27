<?php
require('../Including/db_connection.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("location: ../index.php");
    exit();
}
?>

<?php
$Todaydate = date("Y-m-d");

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=today_attendance_report.xls");
header("Pragma: no-cache");
header("Expires: 0");

$query = "SELECT * FROM studentattendence WHERE date = '$Todaydate' ORDER BY fname ASC";

$result = mysqli_query($conn, $query);

echo "<table border='1'>";
    echo "<tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Admission ID</th>
            <th>Class</th>
            <th>Semester</th>
            <th>Attendance</th>
            <th>Date</th>
          </tr>";

          if (mysqli_num_rows($result) > 0) {
            $counter = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                $bgColor = ($row['attendence'] === 'present') ? 'style="background-color: green; color: white;"' : 'style="background-color: red; color: white;"';
                echo "<tr>
                        <td>{$counter}</td>
                        <td>{$row['fname']}</td>
                        <td>{$row['lname']}</td>
                        <td>{$row['admissionid']}</td>
                        <td>{$row['class']}</td>
                        <td>{$row['semester']}</td>
                        <td $bgColor>{$row['attendence']}</td>
                        <td>{$row['date']}</td>
                      </tr>";
                     $counter++;
            }
        } else {
            echo "<tr><td colspan='8'>No records found for today.</td></tr>";
        }
        echo "</table>";
    mysqli_close($conn);
?>