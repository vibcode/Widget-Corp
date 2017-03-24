<?php require_once("includes/sessions.php"); ?>
<?php
  confirm_logged_in();
?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php

if(isset($_POST['submit']))
{

$not_empty=array('username','password');
$errors=array();
foreach($not_empty as $field)
{
  if(!isset($field)||empty($field))
  {
    $errors[]="{$field} can't be empty";
  }
}
$field_with_lengths=array('username' => 30);
foreach($field_with_lengths as $fieldname => $max)
{
  if(strlen(trim($_POST['username']))>$max)
  {
    $errors[]="{$fieldname} can't be larger than {$max}";
  }
}
if(!$errors)
{

  $username=mysql_real_escape_string($_POST['username']);
  $hashed_password=sha1($_POST['password']);
  $query="INSERT INTO users(username,hashed_password) VALUES('{$username}','{$hashed_password}')";
  $resul=mysql_query($query,$connection);
  if($resul)
  {
    //success
    $message="The user was successfully added";
  }
  else
  {
    //failure
    $message="The user can't be added";
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
<?php include("includes/header.php"); ?>
    <table id="structure">
      <tr>
        <td id="navigation">
          <a href="staff.php">Return to menu</a>
        </td>
        <td align="center" id="page">
          <p class="message"><?php if(isset($message)){echo $message;$message="";}?></p>
        <h2>
          Add a new user

        </h2>
        <div class="page_content">
          <FORM action="new_user.php" method="post">
          <p>Username: <INPUT type="text" name='username'></p>
          <p>Password: <INPUT type="password" name='password'></p>
          <p><INPUT type="submit" value="Create User" name='submit'></p>
          </FORM>
        </div>

        </td>
      </tr>
    </table>
<?php require("includes/footer.php"); ?>
