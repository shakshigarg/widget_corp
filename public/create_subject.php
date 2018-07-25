<?php require_once("../includes/function.php");?>
<?php require_once("../includes/validation.php");?>
<?php $layout="admin"?>
<?php require_once("session.php");?>
    <?php
    confirm_login();
?>
    <?php //require_once("../includes/layout/headers.php");?>
    <?php//to establish database connection?>
    <?php require_once("../includes/db_conn.php");?>
    <?php
    $errors=array();
    if(isset($_POST['create_subject']))
 {
    if(isset($_POST["menu_name"]))
    {
        $menu_name=$_POST["menu_name"];
    }
    else
    {
      $menu_name=NULL;
    }
    if(isset($_POST["position"]))
    $position=(int)$_POST["position"];
  else
  {
    $position=NULL;
  }
    if(isset($_POST["visible"]))
    $visible=(int)$_POST["visible"];
  else
  {
    $visible=NULL;
  }

    if(!has_present($menu_name))
  {
      $errors[]="MENUAME CANNOT BE EMPTY";
  }

  if(!has_present($visible))
  {
      $errors[]="visiblity is not specified";
  }

if(has_present($menu_name))
{
  if(!valid_len($menu_name))
  {
      $errors[]="MENUNAME must have chars more than 4 and less than 30";
  }
}
}
    //$menu_name=mysqli_real_escape_string($menu_name);
    //echo $menu_name;
    if(empty($errors))
    {
    $query="insert into subjects(menu_name,position,visible) values('{$menu_name}',{$position},{$visible})";
    $res=mysqli_query($conn,$query);
    	$_SESSION["message"]="successfully created subject";
        redirect_to("manage_content.php");

    }
    else
    {
      $_SESSION["errors"]=$errors;
    	$_SESSION["message"]="some problem is encontered plz review!!!";
       // show_errors($errors);
    	redirect_to("new_subject.php");
    }
