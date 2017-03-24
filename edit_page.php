<?php require_once("includes/sessions.php"); ?>
<?php
  confirm_logged_in();
?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
/*if(intval($_GET['page'])==0)
{
  header("Location: content.php");
  exit;
}*/
if(isset($_POST['submit']))
{

$not_empty=array('menu_name','position','visible');
$errors=array();
foreach($not_empty as $field)
{
  if(!isset($_POST[$field])||(empty($_POST[$field])&&$_POST[$field]!=0))
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
if(!$errors)
{
  $id=mysql_real_escape_string($_GET['page']);
  $menu_name=mysql_real_escape_string($_POST['menu_name']);
  $position=mysql_real_escape_string($_POST['position']);
  $visible=mysql_real_escape_string($_POST['visible']);
  $content=mysql_real_escape_string($_POST['content']);
  $query="UPDATE pages SET menu_name='{$menu_name}',content='{$content}',position={$position},visible={$visible} WHERE id={$id}";
  $resul=mysql_query($query,$connection);
  if(mysql_affected_rows()==1)
  {
    //success
    $message="The page was successfully edited";
  }
  else
  {
    //failure
    $message="The page updation failed";
    $message.="<br>".mysql_error();
  }

}
else
{
  //Errors
  $message="There were ".count($errors)."in the form.";
  echo "<p>";
  echo "Please review the following fields:"."<br>";
  foreach($errors as $error)
  {
    echo "-".$error."<br>";
  }
  echo "</p>";
}
}
?>




<?php
if(isset($_GET['subj']))
{
    $sel_subj=$_GET['subj'];
    $sel_page="";
}
else
{
  if(isset($_GET['page']))
  {
      $sel_page=$_GET['page'];
      $sel_subj="";
  }
  else
  {
    $sel_subj="";
    $sel_page="";
  }
}
if($sel_subj)
{
  $sel_subject=get_subject_by_id($sel_subj);
}
if($sel_page)
{
  $sele_page=get_page_by_id($sel_page);
}
?>

<?php include("includes/header.php"); ?>
    <table id="structure">
      <tr>
        <td id="navigation">
          <?php navigation($sel_subj,$sel_page); ?>
        </td>
        <td id="page">
          <p class="message">
          <?php if(isset($message)){echo $message;$message="";}?></p>




          <h2>Edit Page: <?php echo $sele_page['menu_name']; ?></h2>
          <form method="post" action="edit_page.php?page=<?php echo urlencode($sel_page); ?>">

            <p>Page Name: <INPUT type="text" name="menu_name" id="menu_name" value="<?php echo $sele_page['menu_name']; ?>"></p>
            <p>Position: <select name="position"></p>

              <?php
                $page_set=get_pages_for_subject($sele_page['subject_id'],false);
                $number=mysql_num_rows($page_set);
                for($count=1;$count<=$number+1;$count++)
                {
                  echo "<option value={$count}";
                  if($count==$sele_page['position'])
                  {
                    echo " selected";
                  }
                  echo ">{$count}</option>";
                }

               ?>

            </select>
            <p>Visible:
              <?php
              echo "<INPUT type='radio' name='visible' value='0'";
              if($sele_page['visible']=='0')
              {
                echo " checked";
              }
              echo ">No &nbsp";
              echo "<INPUT type='radio' name='visible' value='1'";
              if($sele_page['visible']=='1')
              {
                echo " checked";
              }
              echo ">Yes";
              ?>
            </p>
            <p>Content:<br><br> <textarea name="content" rows="5" cols="25"><?php echo $sele_page['content']; ?></textarea></p>
            <INPUT type="submit" name="submit" value="Edit Page">
              &nbsp;&nbsp;







<br>
          <a href="delete_page.php?page=<?php echo urlencode($sel_page); ?>" onclick="return confirm('Are you sure?');">Delete Page</a>
        </form>
          <a href="content.php">Cancel</a>
        </td>
      </tr>
    </table>
<?php require("includes/footer.php"); ?>
