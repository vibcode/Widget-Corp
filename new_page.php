<?php require_once("includes/sessions.php"); ?>
<?php
  confirm_logged_in();
?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
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
<?php require_once("includes/functions.php") ?>
<?php include("includes/header.php"); ?>
    <table id="structure">
      <tr>
        <td id="navigation">
          <?php navigation($sel_subj,$sel_page); ?>



        </td>
        <td id="page">
          <h2>Add Page</h2>
          <form method="post" action="create_page.php?subj=<?php echo urlencode($sel_subj); ?>">

            <p>Page Name: <INPUT type="text" name="menu_name" id="menu_name"></p>
            <p>Position: <select name="position"></p>

                <?php
                  $page_set=get_pages_for_subject($sel_subj);
                  $number=mysql_num_rows($page_set);
                  for($count=1;$count<=$number+1;$count++)
                  {
                    echo "<option value={$count}";
                    /*if($count==$sele_page['position'])
                    {
                      echo " selected";
                    }*/
                    echo ">{$count}</option>";
                  }

                 ?>

            </select>

            <p>Visible: <INPUT type="radio" name="visible" value="0">No &nbsp;
                        <INPUT type="radio" name="visible" value="1">Yes
            </p>
            <p>Content: <textarea name="content"></textarea></p>
            <INPUT type="submit" value="Add Page">
          </form>
          <a href="content.php">Cancel</a>
        </td>
      </tr>
    </table>
<?php require("includes/footer.php")?>
