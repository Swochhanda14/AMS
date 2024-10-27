<?php
require('../Including/db_connection.php');

$classid = (int)$_GET['id'];

$sql = "DELETE FROM class where id=$classid";

$data = mysqli_query($conn, $sql);

if ($data) {
    echo "<script>alert('Class deleted Succesfully!')</script>";
?>
    <meta http-equiv="refresh" content="0; url=http://localhost/ams/dashboard/viewclass.php">
<?php
exit();
}else{
    echo "<script>alert('Failed to delete!')</script>";
    exit();
}
?>