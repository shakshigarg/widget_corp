<?php require_once("../includes/function.php");?>
<?php $layout="admin"?>
    <?php require_once("../includes/layout/headers.php");?>
     <?php require_once("../includes/validation.php");?>

    <?php//to establish database connection?>
    <?php require_once("../includes/db_conn.php");?>
  <?php require_once("session.php");?>
    <?php
    confirm_login();
?>
    <?php
    if(isset($_GET["page_id"]))
    {
      $page_id=$_GET["page_id"];
      //$page_id=NULL;
    }
    if($page_id)
		{
		  $current_page=find_page_by_id($page_id);
		}
	else
{
  $_SESSION["message"]="page id not found!!";
  redirect_to("manage_content.php");
}


//$page_set=find_pages_of_subject($subject_id);
// if(mysqli_num_rows($page_set)>0)
// {
// 	$_SESSION["message"]="cannot delete subject becoz it contains pages!!";
//         redirect_to("manage_content.php");
// }
    $query="delete from pages where id=".$page_id;
    //$query.=$menu_name."\",position=".$position.",visible=".$visible." where id=".$subject_id;
    //echo $query;
    $res=mysqli_query($conn,$query);
    if($res)
    {
      $_SESSION["message"]="successfully deleted page";
        redirect_to("manage_content.php");
    }
    else
    {
      //$_SESSION["errors"]=$errors;
      $_SESSION["message"]="page deletion failed!!";
       // show_errors($errors);
      redirect_to("manage_content.php?page_id=urlencode($page_id)");
    }
