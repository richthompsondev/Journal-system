
 <?php
session_start();
$userid = $_SESSION['user_id'];
$type = $_POST['type'];
$date = $_POST['date'];
$time = $_POST['time'];
$appt = $_SESSION['appid'];
$purpose = $_POST['purpose'];

$conn = new mysqli('localhost', 'root', 'root', 'Journal');
if (mysqli_connect_errno()) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}
$sql = "DELETE FROM appointment where appointment_id='$appt'";

$res = mysqli_query($conn, $sql);
if($res==true){

    header('Location:mainpage.php');

}
else{
      printf("Could not insert record: %s\n", mysqli_error($conn));
}
?>

      
      
	  