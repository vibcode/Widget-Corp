<?php require_once("includes/sessions.php"); ?>
<?php
  confirm_logged_in();
?>
<?php require_once("includes/functions.php"); ?>
<?php
  $_SESSION=array();
  //Destroy the cookie
  if(isset($COOKIE[session_name()]))
  {
    setcookie(session_name(),'',time()-42000,'/');
  }
  session_destroy();
  header("Location: login.php?logout=1");
  exit;
?>
