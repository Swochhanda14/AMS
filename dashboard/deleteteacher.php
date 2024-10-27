<?php
require('../Including/db_connection.php');

$tecid = (int)$_GET['id'];

$sql = "DELETE FROM teacher where id=$tecid";

$data = mysqli_query($conn, $sql);

if ($data) {
    echo "<script>alert('Teacher deleted Succesfully!')</script>";
?>
    <meta http-equiv="refresh" content="0; url=http://localhost/ams/dashboard/viewteacher.php"> 
<?php
exit();
}else{
    echo "<script>alert('Failed to delete!')</script>";
    exit();
}
?>