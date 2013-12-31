<?php
session_start();
if (isset($_SESSION["username"])) {
    $user = $_SESSION["username"];
} else {

    header('Location:login.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="mystyle.js" defer></script>
    <script src="validate.js"></script>
    <!-- i got this from w3 school to add the icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link href="styles.css" rel="stylesheet">
    <title>Tabs</title>
</head>

<body>

    <div class="nav">

        <a href="mainpage.php"><i class="fa fa-home" class="myicon"></i>&nbsp; Home</a>
        <div class="dropdown">
            <?php
            echo "<button class='dropbtn'><i class='fas fa-user-circle' class='myicon'></i>&nbsp;Hello $user ";
            ?>

            <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">

                <a href="settings.php"><i class="fa fa-edit" class="myicon1"></i>settings</a>
                <a href="logout.php"><i class="fa fa-sign-out" class="myicon1"></i>logout</a>

            </div>
        </div>

    </div>
    <div class="make">
        <ul class="tabs">
            <li data-tab-target="#event" class="active tab">Add events</li>
            <li data-tab-target="#appointment" class="tab">Appointments</li>
            <li data-tab-target="#finished" class="tab">Completed Appointment</li>
            <li data-tab-target="#Task" class="tab">Pending Appointment</li>
            <li data-tab-target="#Dialy" class="tab">Daily Appointment</li>
        </ul>
    </div>

    <div class="tab-content">
        <div id="event" data-tab-content class="active">
            <form action="insertappointment.php" method="POST" target="_SELF">

                <input type="text" class="designme" placeholder="appointment type" name="type" required /><br>

                <input type="date" class="designme" name="date" required /><br>
                <input type="time" class="designme" name="time" required /> <br>
                <input type="text" class="designme" placeholder="purpose" name="purpose" required /><br>
                <input type="submit" class="designsubmit" value="submit" name="submit">
                <br>
                <br>
                <br>
            </form>

        </div>
        <div id="Dialy" data-tab-content>
        <form action="updatecompleted.php" method="POST" target="_SELF">


<?php
$con = new mysqli('localhost', 'root', 'root', 'Journal');
if (mysqli_connect_errno()) {
    printf("couldn't connect%s", mysqli_connect_errno());
    exit(0);
}
$today = date('Y-m-d');



$userid = $_SESSION['user_id'];
$sql = "SELECT * FROM appointment WHERE appointment_date = '$today' AND  completed = 'No' AND user_id = '$userid'";
$res = mysqli_query($con, $sql);
if (mysqli_num_rows($res) > 0) {
    while ($newArray = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $id  = $newArray['user_id'];
        $appointid = $newArray['appointment_id'];
        $type = $newArray['type'];
        $date = $newArray['appointment_date'];
        $purpose = $newArray['purpose'];
        $time = $newArray['appointment_time'];


        $_SESSION['type'] = $type;
        $_SESSION['date'] = $date;
        $_SESSION['appid'] = $appointid;

        echo "
<div class = 'designtable'>
<ul>
<div class ='makeblue'>
<br>
<br>
<li><p>Your appointment for today is scheduled on  $time </p>
<p class='hidethis'>$appointid</p><p>Is appointment completed?<select name='checkedval'><option name='Yes' value = 'Yes'>Yes</option><option name='No' value = 'No'>No</option></select> <input type='submit' class='submitbtn' value='confirm'></p></li>

</div>
</ul>
</div>";
    }
} else {
    echo "<p> You have no appointment set up for today</p>";
}


mysqli_free_result($res);
mysqli_close($con);



?>
</form>
</div>


        <div id="finished" data-tab-content>
            <?php
            $con = new mysqli('localhost', 'root', 'root', 'Journal');
            if (mysqli_connect_errno()) {
                printf("couldn't connect%s", mysqli_connect_errno());
                exit(0);
            }


            $userid = $_SESSION['user_id'];
            $sql = "SELECT * FROM appointment WHERE completed = 'Yes' AND user_id = '$userid'";
            $res = mysqli_query($con, $sql);
            if (mysqli_num_rows($res) > 0) {
                while ($newArray = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                    $id  = $newArray['user_id'];
                    $appointid = $newArray['appointment_id'];
                    $type = $newArray['type'];
                    $date = $newArray['appointment_date'];
                    $purpose = $newArray['purpose'];
                    $time = $newArray['appointment_time'];


                    $_SESSION['type'] = $type;
                    $_SESSION['date'] = $date;
                    $_SESSION['appid'] = $appointid;

                    echo "
              <div class = 'designtable'>
              <ul>
              <div class ='makeblue'>
              <br>
              <br>
              <li><p>Your appointment for $type which was scheduled on $date $time has been completed</p>
              <br>
              <br>
              </div>
              </ul>
              </div>";
                }
            } else {
                echo "<p> no completed appointment</p>";
            }


            mysqli_free_result($res);
            mysqli_close($con);



            ?>

        </div>
        <div id="appointment" data-tab-content>


            <?php
            $con = new mysqli('localhost', 'root', 'root', 'Journal');
            if (mysqli_connect_errno()) {
                printf("couldn't connect%s", mysqli_connect_errno());
                exit(0);
            }


            $userid = $_SESSION['user_id'];
            $sql = "SELECT * FROM appointment WHERE  completed = 'No' AND user_id = '$userid'";
            $res = mysqli_query($con, $sql);
            if (mysqli_num_rows($res) > 0) {
                while ($newArray = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                    $id  = $newArray['user_id'];
                    $appointid = $newArray['appointment_id'];
                    $type = $newArray['type'];
                    $date = $newArray['appointment_date'];
                    $purpose = $newArray['purpose'];
                    $time = $newArray['appointment_time'];


                    $_SESSION['type'] = $type;
                    $_SESSION['date'] = $date;
                    $_SESSION['appid'] = $appointid;
                    $_SESSION['purpose'] = $purpose;
                    $_SESSION['time'] = $time;

                    echo "
              <div class = 'designtable'>
              <ul>
              <div class ='makeblue'>
              <br>
              <br>
              <li><p>Your appointment for $type scheduled for $date , $time  </p>
           
              <p class='hidethis'>$appointid</p><a href='deleteappointment.php' > Cancel Appointment</a><br><a href='reschedule.php' > Reschedule Appointment</a></li>

              </div>
              </ul>
              </div>";
                }
            } else {
                echo "<p> no appointment</p>";
            }


            mysqli_free_result($res);
            mysqli_close($con);



            ?>

        </div>

        <div id="Task" data-tab-content>
            <form action="updatecompleted.php" method="POST" target="_SELF">


                <?php
                $con = new mysqli('localhost', 'root', 'root', 'Journal');
                if (mysqli_connect_errno()) {
                    printf("couldn't connect%s", mysqli_connect_errno());
                    exit(0);
                }


                $userid = $_SESSION['user_id'];
                $sql = "SELECT * FROM appointment WHERE  completed = 'No' AND user_id = '$userid'";
                $res = mysqli_query($con, $sql);
                if (mysqli_num_rows($res) > 0) {
                    while ($newArray = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                        $id  = $newArray['user_id'];
                        $appointid = $newArray['appointment_id'];
                        $type = $newArray['type'];
                        $date = $newArray['appointment_date'];
                        $purpose = $newArray['purpose'];
                        $time = $newArray['appointment_time'];


                        $_SESSION['type'] = $type;
                        $_SESSION['date'] = $date;
                        $_SESSION['appid'] = $appointid;

                        echo "
              <div class = 'designtable'>
              <ul>
              <div class ='makeblue'>
              <br>
              <br>
              <li><p>Your appointment for $type is scheduled on $date $time </p>
              <p class='hidethis'>$appointid</p><p>Is appointment completed?<select name='checkedval'><option name='Yes' value = 'Yes'>Yes</option><option name='No' value = 'No'>No</option></select> <input type='submit' class='submitbtn' value='confirm'></p></li>

              </div>
              </ul>
              </div>";
                    }
                } else {
                    echo "<p> No Pending Appointment</p>";
                }


                mysqli_free_result($res);
                mysqli_close($con);



                ?>
            </form>
        </div>
    </div>
    <div class="makefooter">
        <p>@Oghenemano omogha 21813677</p>

    </div>
</body>

</html>