<?php require_once("includes/sessions.php"); ?>
<?php
  confirm_logged_in();
?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>
    <table id="structure">
      <tr>
        <td id="navigation">
          &nbsp;
        </td>
        <td id="page">
          <h2>Staff Menu</h2>
          <p>Welcome to the Staff area,<?php echo $_SESSION['username']; ?></p>
          <ul>
            <li><a href="content.php">Manage website content</a>
            <li><a href="new_user.php">Add new User</a>
            <li><a href="logout.php">Logout</a>
          </ul>
        </td>
      </tr>
    </table>
<?php include("includes/footer.php"); ?>
