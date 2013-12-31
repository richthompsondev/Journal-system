<?php
session_start();
$user = $_SESSION["username"];

$mytype = $_SESSION['type'];
$mydate = $_SESSION['date'];
$myappid = $_SESSION['appid'];
$mypurpose = $_SESSION['purpose'];
$password  = $_SESSION['password'];
$userid = $_SESSION["user_id"];
$pass = base64_decode($password);
$mytime = $_SESSION['time'];
?>
<html>

<head>
    <script src="mystyle.js" defer></script>
    <script type="text/javascript" src="validate.js"></script>
    <link href="styles.css" rel="stylesheet">
    <!-- i got this from w3 school to add the icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
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
    <div class="logindesign">
        <form action="" name='settingform' method="POST" id="settingform">
            <br>
            <br>
            <br>
            <h1> Reset password </h1>
            

            <input type="text" class="designus" placeholder="username" value="<?php echo "$user"?>" name="username"  /><br>



            <input type="password" class="designus" placeholder="password" name="password"  /><br>

          
            <input type="password" class="designus" placeholder="re-type password" name="password_sec"  /><br>
            <input type="submit" class="designussubmit" value="submit" onclick="return validatesetting('settingform')" name="update">
            <br>
            <br>
            <br>


        </form>

    </div>
    <?php
    if (!empty($_POST)) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $sec_pass = $_POST["password_sec"];
        $passha = hash('sha256', $password);
        $sec_passha = hash('sha256', $sec_pass );
        
        $my_db_conn = new mysqli("localhost", "root", "root", "Journal");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        if($passha == $sec_passha){
            $sql = "UPDATE users SET  username='$username', password = '$passha'  WHERE user_id='$userid'";


            $res = mysqli_query($my_db_conn, $sql);
            if ($res) {
                echo "update successful";
                header('Refresh:3; url=mainpage.php');
            } else {
                echo "<p class:'makered'> password do not match!</p>";
        }
            }
            else {
                echo "<p class:'makered'> password do not match!</p>";
        }

        
       
      
    }


    ?>

</body>
</head>

</html>