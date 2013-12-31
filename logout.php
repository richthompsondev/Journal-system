<?php
session_start();

if(!isset($_SESSION["username"]))
{
  echo "<p> Not logged-in. Please Log-in </p>";
  header('Refresh: 3;url=login.php');
}
else
{
  echo "<p>Logging-out the user ".$_SESSION["username"]."</p>";
  session_destroy();
  unset($_SESSION["username"]);
  session_unset();
  echo "relogin please";
  header('Refresh: 3;url=login.php');
}
?>
