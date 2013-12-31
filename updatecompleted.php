<?php
session_start();
$userid = $_SESSION['user_id'];
$type = $_POST['type'];
$date = $_POST['date'];
$time = $_POST['time'];
$purpose = $_POST['purpose'];
$appt = $_SESSION['appid'];
$checkval = $_POST['checkedval'];

$conn = new mysqli('localhost', 'root', 'root', 'Journal');
if (mysqli_connect_errno()) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}
$sql = "UPDATE appointment SET completed='$checkval' WHERE appointment_id='$appt'";

$res = mysqli_query($conn, $sql);
if($res==true){


    header('Location:mainpage.php');

}
else{
      printf("couldn't update record %s\n", mysqli_error($conn));
}
?>