<?php
require('../Including/db_connection.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("location: ../index.php");
    exit();
}


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
        $sql = "INSERT INTO semester (class, semester, faculty) VALUES ('$class', '$sem', '$classFaculty')";
        $data = mysqli_query($conn, $sql);

        if ($data) {
            echo "<script>alert('Semester added successfully')</script>";
        } else {
            echo "<script>alert('Failed to add semester')</script>";
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
                    <h2>Add Semester</h2>
                    <h3><a href="dashboard.php">Dashboard</a>/ <a href="viewsemester.php">View Semester</a>/ Add
                        Semester</h3>
                </div>

                <div class="form-container">

                    <h2>Add Semester</h2>

                    <h4>Semester Details</h4>

                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">


                        <div class="input-field">
                            <label for="class">Class Name</label>
                            <select name="class" id="class">
                                <option value="">Select Class</option>
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
                            <label for="sem">Semester</label>
                            <select name="sem" class="select" id="sem">
                                <option value="">Select Semester</option>
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