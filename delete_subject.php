<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
  if(intval($_GET['subj'])==0)
  {
    header("Location: content.php");
    exit;
  }
  $id=mysql_real_escape_string($_GET['subj']);
  if($subject=get_subject_by_id($id))
  {
    $query="DELETE FROM subjects WHERE id={$id} LIMIT 1";
    $result=mysql_query($query,$connection);
    if(mysql_affected_rows()==1)
    {
      header("Location: content.php");
      exit;
    }
    else
    {
      echo "Subject deletion failed"."<br>";
      echo mysql_error()."<br>";
      echo "<a href=\"content.php\">Return to main page</a>";
    }
  }
  else
  {
    echo "No such subject exists";
    header("Location: content.php");
    exit;
  }


?>



<?php require("includes/footer.php")?>
