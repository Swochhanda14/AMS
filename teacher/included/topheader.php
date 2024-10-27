<?php
require('../Including/db_connection.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    header("location: ../index.php");
    exit();
}

$username = $_SESSION['username'];

$sql = "SELECT * FROM teacher WHERE username = '$username'";

$teacherResult = mysqli_query($conn, $sql);

$result = mysqli_fetch_assoc($teacherResult);
?>


<div class="dashboard-header">
    <div class="hidden">

    </div>

    <h1>Attendence Managemanet System</h1>

    <div class="sideicon">
        <ul>
            <li>
                <a href="#">
                    <span class="material-symbols-rounded">notifications</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <span class="material-symbols-rounded">chat_bubble</span>
                </a>
            </li>

            <li>
                <a href="profile.php" class="profileholder">
                    <img src="../upload/teacher/<?php echo !empty($result['profile']) ? $result['profile'] : 'default.png'; ?>" alt="Profile Image" id="profile-pic" 
                    alt="profile">
                </a>
            </li>
        </ul>
    </div>
</div>