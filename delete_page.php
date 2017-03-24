<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
  if(intval($_GET['page'])==0)
  {
    header("Location: content.php");
    exit;
  }
  $id=mysql_real_escape_string($_GET['page']);
  if($pagess=get_page_by_id($id))
  {
    $query="DELETE FROM pages WHERE id={$id} LIMIT 1";
    $result=mysql_query($query,$connection);
    if(mysql_affected_rows()==1)
    {
      header("Location: content.php");
      exit;
    }
    else
    {
      echo "Page deletion failed"."<br>";
      echo mysql_error()."<br>";
      echo "<a href=\"content.php\">Return to main page</a>";
    }
  }
  else
  {
    echo "No such page exists";
    header("Location: content.php");
    exit;
  }


?>



<?php require("includes/footer.php")?>
