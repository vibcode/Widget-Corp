<?php include("constants.php"); ?>
<?php
  $connection=mysql_connect($DB_SERVER,$DB_USER,$DB_PASS);
  if(!$connection)
  {
    die("Database connection failed".mysql_error());
  }
  $db=mysql_select_db($DB_NAME,$connection);
  if(!$db)
  {
    die("Datbase connection failed".mysql_error());
  }
?>
