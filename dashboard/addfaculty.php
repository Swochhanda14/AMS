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
                    <h2>Add Class</h2>
                    <h3><a href="dashboard.php">Dashboard</a>/ <a href="viewclass.php">View Class</a>/ Add Classes</h3>
                </div>

                <div class="form-container">

                    <h2>Add Classes</h2>

                    <h4>Class Details</h4>
                    
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                        

                        <div class="input-field">
                            <label for="cname">Class Name</label>
                            <input type="text" class="form-control" id="cname" name="cname" required placeholder="Enter Class"> 
                        </div>

                        <div class="input-field">
                            <label for="fname">Faculty Name</label>
                            <select name="fname" id="fname">
                                <option value="">Select Faculty</option>
                                <option value="humanity">Humanity</option>
                                <option value="science">Science</option>
                                <option value="management">Management</option>
                            </select>
                        </div>

                        <input type="submit" name="submit" class="submit-btn">

                    </form>

                    <?php
                    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
                        $cname = $_POST['cname'];
                        $fname = $_POST['fname'];
                        
                        if(!empty($cname) && !empty($fname)){
                        $sql = "INSERT INTO class (class, faculty) VALUES ('$cname', '$fname')";
                        $data = mysqli_query($conn, $sql);

                        if($data){
                            echo "<script>alert('Class added successfully!')</script>";
                            echo "<meta http-equiv='refresh' content='0; url=http://localhost/ams/dashboard/viewclass.php'>";
                        }else{
                            echo "<script>alert('Failed to add class!')</script>";
                        }
                    }
                     
                    mysqli_close($conn);


                    }
                    ?>
                </div>


            </div>

        </div>
        <!-- body part  -->
    </div>
</body>

<script src="../js/script.js"></script>

</html>