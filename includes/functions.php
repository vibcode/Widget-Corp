<?php
function confirm_query($result_set)
{
  if(!$result_set)
  {
    die("Database query failed2".mysql_error());
  }
}
function get_all_subjects($public=true)
{
  $query="SELECT * FROM subjects";
  if($public)
  {
    $query.=" WHERE visible=1";
  }
  $query.=" ORDER BY position";
  $subject_set=mysql_query($query);
  confirm_query($subject_set);
  return $subject_set;
}
function get_subject_by_id($subject_id)
{
  $query="SELECT * FROM subjects WHERE id={$subject_id} LIMIT 1";
  $sub_id=mysql_query($query);
  confirm_query($sub_id);
  $subject=mysql_fetch_array($sub_id);
  return $subject;
}
function get_page_by_id($page_id)
{
  $query="SELECT * FROM pages WHERE id={$page_id} LIMIT 1";
  $page_id=mysql_query($query);
  confirm_query($page_id);
  $subject=mysql_fetch_array($page_id);
  return $subject;
}
function navigation($sel_subj,$sel_page)
{
  echo "<ul class=\"subjects\">";

    $subject_set=get_all_subjects(false);
    while($subject=mysql_fetch_array($subject_set))
    {
      echo "<li ";
      if($sel_subj==$subject["id"])
      {
        echo "class=\"selected\"";
      }
      echo"><a href=\"edit_subject.php?subj=".urlencode($subject["id"])."\">".$subject["menu_name"]."</a>"."</li>";
      $page_set=mysql_query("SELECT * FROM pages WHERE subject_id={$subject["id"]} ORDER BY position");
      confirm_query($page_set);
      echo "<ul class=\"pages\">";
      while($page=mysql_fetch_array($page_set))
      {
        echo "<li ";
        if($sel_page==$page["id"])
        {
          echo "class=\"selected\"";
        }
        echo "><a href=\"content.php?page=".urlencode($page["id"])."\">".$page["menu_name"]."</li>";
      }
      echo "</ul>";
    }

  echo "</ul>";
}

function navigation_c($sel_subj,$sel_page)
{
    echo "<ul class=\"subjects\">";
    $subject_set=get_all_subjects(false);
    while($subject=mysql_fetch_array($subject_set))
    {
      echo "<li ";
      if($sel_subj==$subject["id"])
      {
        echo "class=\"selected\"";
      }
      echo"><a href=\"content.php?subj=".urlencode($subject["id"])."\">".$subject["menu_name"]."</a>"."</li>";
      $page_set=mysql_query("SELECT * FROM pages WHERE subject_id={$subject["id"]} ORDER BY position");
      confirm_query($page_set);
      echo "<ul class=\"pages\">";
      while($page=mysql_fetch_array($page_set))
      {
        echo "<li ";
        if($sel_page==$page["id"])
        {
          echo "class=\"selected\"";
        }
        echo "><a href=\"content.php?page=".urlencode($page["id"])."\">".$page["menu_name"]."</li>";
      }
      echo "</ul>";
    }

  echo "</ul>";
}
function navigation_i($sel_subj,$sel_page)
{
  $x="";
  echo "<ul class=\"subjects\">";
  $subject_set=get_all_subjects(true);
  while($subject=mysql_fetch_array($subject_set))
  {
    echo "<li ";
    if($sel_subj==$subject["id"])
    {
      echo "class=\"selected\"";
      echo"><a href=\"index.php?subj=".urlencode($subject["id"])."\">".$subject["menu_name"]."</a>"."</li>";
      $ques="SELECT * FROM pages WHERE subject_id={$subject["id"]}";
      $ques.=" AND visible='1'";  
      $ques.=" ORDER BY position";
      $page_set=mysql_query($ques);
      confirm_query($page_set);
      echo "<ul class=\"pages\">";
      while($page=mysql_fetch_array($page_set))
      {
        echo "<li ";
        if(!$sel_page)
        {
          if($page["position"]=='1')
          {
            echo "class=\"selected\"";
            $x=$page["id"];
          }
         echo "><a href=\"index.php?"."page=".urlencode($page["id"])."\">".$page["menu_name"]."</li>";
        }
        else
        {

          if($sel_page==$page["id"])
          {
            echo "class=\"selected\"";
          }
          echo "><a href=\"index.php?"."page=".urlencode($page["id"])."\">".$page["menu_name"]."</li>";
        }
      }
      echo "</ul>";
    }
    else
    {
      echo"><a href=\"index.php?subj=".urlencode($subject["id"])."\">".$subject["menu_name"]."</a>"."</li>";
    }
  }
  echo "</ul>";
return $x;

}


function get_pages_for_subject($sub,$public=true)
{
  $query="SELECT * FROM pages";
  $query.= " WHERE subject_id={$sub}";
  if($public)
  {
    $query.= " AND visible='1'";
  }
  $query.=" ORDER BY position ASC";
  $res=mysql_query($query);

  return $res;

}
?>
