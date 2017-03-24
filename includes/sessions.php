<?php
  session_start();
  function loggedin()
  {
    return isset($_SESSION['user_id']);
  }
  function confirm_logged_in()
  {
    if(!loggedin())
    {
      header("Location: login.php");
      exit;
    }
  }
?>
