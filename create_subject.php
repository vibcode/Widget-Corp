<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
$not_empty=array('menu_name','position','visible');
$errors=array();
foreach($not_empty as $field)
{
  if(!isset($_POST[$field])||empty($_POST[$field]))
  {
    $errors[]="{$field} can't be empty";
  }
}
$field_with_lengths=array('menu_name' => 30);
foreach($field_with_lengths as $fieldname => $max)
{
  if(strlen(trim($_POST['menu_name']))>$max)
  {
    $errors[]="{$fieldname} can't be larger than {$max}";
  }
}
if($errors)
{
  header("Location: new_subject.php");
  exit;
}

?>
<?php
  $menu_name=mysql_real_escape_string($_POST['menu_name']);
  $position=mysql_real_escape_string($_POST['position']);
  $visible=mysql_real_escape_string($_POST['visible']);
  $query="INSERT INTO subjects (menu_name,position,visible) VALUES ('{$menu_name}',{$position},{$visible})";
  if(mysql_query($query,$connection))
  {
    //Success
    header("Location: content.php");
    exit;
  }
  else
  {
    echo "Subject creation failed";
  }



?>


<?php mysql_close($connection); ?>
