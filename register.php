<?php
session_start();
if (isset($_SESSION["username"])) {
    header('Location:mainpage.php');
}
?>
<html>

<head>
    <script src="mystyle.js" defer></script>
    <script type="text/javascript" src="validate.js"></script>
    <link href="styles.css" rel="stylesheet">

<body>
    <div class="logindesign">
        <form action="" method="POST"  id="loginform">
            <br>
            <br>
            <br>
            <h1> Register</h1>
            <input type="text" class="designus" placeholder="username" name="username"><br>
            <input type="password" class="designus" placeholder="password" name="password"><br>
            <input type="password" class="designus" placeholder="retype-password" name="password_sec"><br>
            <p> Already have an Account ? &nbsp;<a href="login.php">Login</a></p>

            <input type="submit" class="designussubmit" onclick="return myform('loginform');"><br>
            <br>
            <br>


        </form>

    </div>


</body>
</head>

</html>
<?php
if (!empty($_POST)) {

    $usernames = $_POST['username'];
    $passwords = $_POST['password'];
    $password_sec = $_POST['password_sec'];
    $hashsec = hash('sha256', $password_sec);
    $entered_pword = hash('sha256', $passwords);




    $mysqli = new mysqli("localhost", "root", "root", "Journal");
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    if($hashsec == $entered_pword){



    $sql = "INSERT INTO users (username, password) VALUES ('$usernames','$entered_pword')";
    $res = mysqli_query($mysqli, $sql);
    if ($res === TRUE) {

       
        
        header('Refresh:3 ;url=login.php');
        echo "<p> Login with your registered pass</p>";
    }
   else

        printf("Could not insert record: %s\n", mysqli_error($mysqli));
}
else{
    echo "password don't match";
    header('Refresh:3 ;url=login.php');

        
}
}

?>