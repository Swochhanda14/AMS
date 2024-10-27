<?php
require('../Including/db_connection.php');

$semid = (int)$_GET['id'];

$sql = "DELETE FROM semester where id=$semid";

$data = mysqli_query($conn, $sql);

if ($data) {
    echo "<script>alert('Semester deleted Succesfully!')</script>";
?>
    <meta http-equiv="refresh" content="0; url=http://localhost/ams/dashboard/viewsemester.php"> 
<?php
exit();
}else{
    echo "<script>alert('Failed to delete!')</script>";
    exit();
}
?>