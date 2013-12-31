<?php
session_start();
if(isset($_SESSION["username"])){
    header('Location:mainpage.php');

}
?>
<html>
    <head>
    <script src="mystyle.js" defer></script>
    <script   type="text/javascript"  src="validate.js" ></script>
  <link href="styles.css" rel="stylesheet">
        <body>
            <div class="logindesign">
                <form action="" method="POST" id="loginform">
                    <br>
                    <br>
                    <br>
                    <h1> Login</h1>
                    <input type="text" class="designus" placeholder="username" name="username"><br>
                    <input type="password" class="designus" placeholder="password" name="password"><br>
                    <p> Don't have an Account ? &nbsp;<a href="register.php" >Register</a></p>
                    <input type="submit" class="designussubmit" onclick="return myform('loginform');"><br>
                    <br>
                    <br>
            
               
                </form>

            </div>
           
            
        </body>
    </head>
</html>
<?php
 if (!empty( $_POST))
 {
     $my_db_conn = new mysqli("localhost", "root", "root", "Journal");
     if (mysqli_connect_errno()) 
     {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
     } 
     
     $sql = "SELECT * FROM users WHERE username ='".$_POST["username"]."';";
     $res = mysqli_query($my_db_conn, $sql);

     if(mysqli_affected_rows($my_db_conn) > 0)
     {
           while ($newArray = mysqli_fetch_array($res, MYSQLI_ASSOC)) 
           {
               $userid  = $newArray['user_id'];
               $uname = $newArray['username'];
       			
               $password = $newArray['password'];					
           } 
           
           $entered_pword = hash('sha256', $_POST["password"]);
           
           mysqli_free_result($res);
           mysqli_close($my_db_conn);

           if ( $entered_pword == $password)
           {
               $_SESSION["user_id"] = $userid;
               $_SESSION["username"]=$uname;
               $_SESSION["password"]=$password;
             	
               header('Location:mainpage.php');
           }
           else
           {
             echo "<p> Wrong Password";
           
           }
     }
     else
     {	  
           echo "<p>No such user !!!</p>";
           mysqli_free_result($res);
           mysqli_close($my_db_conn);
          
     }  
 }

?>