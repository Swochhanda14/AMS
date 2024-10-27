<?php
require('../Including/db_connection.php');

$stdid = (int)$_GET['id'];

$sql = "DELETE FROM student where id=$stdid";

$data = mysqli_query($conn, $sql);

if ($data) {
    echo "<script>alert('Student deleted Succesfully!')</script>";
?>
    <meta http-equiv="refresh" content="0; url=http://localhost/ams/dashboard/viewstudent.php"> 
<?php
exit();
}else{
    echo "<script>alert('Failed to delete!')</script>";
    exit();
}
?>