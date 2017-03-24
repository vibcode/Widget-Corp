<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
$sel_subj="";
$sel_page="";
if(isset($_GET['subj']))
{
    $sel_subj=$_GET['subj'];
}

  if(isset($_GET['page']))
  {
      $sel_page=$_GET['page'];

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
          <?php
          if(!$sel_page)
           $x=navigation_i($sel_subj,$sel_page);
          else
          {
            $x=navigation_i($sele_page['subject_id'],$sel_page);
          }
          ?>
        </td>
        <td id="page">
          <h2>
            <?php
            if($x)
            {
              $sel_page=$x;
              $sele_page=get_page_by_id($sel_page);
            }
             if(isset($sele_page["menu_name"]))
             {
               echo htmlentities($sele_page["menu_name"]);
             }
             else
             {
               echo "Welcome to Widget Corp";
             }
             ?>

        </h2>
        <div class="page_content">
          <?php
            if(isset($sele_page["content"]))
            {
              echo nl2br($sele_page["content"]);

            }
            if($sel_page=='7')
            {
              echo "<a href="."index.php?page=8".">dealer page</a>";
            }

           ?>
           <br>
           Already a user: <a href="login.php">Login</a>

        </div>
        </td>
      </tr>
    </table>
<?php require("includes/footer.php"); ?>
