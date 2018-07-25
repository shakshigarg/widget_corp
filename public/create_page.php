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
    if(isset($_POST['create_page']))
 {
    if(isset($_POST["menu_name"]))
    {
        $menu_name=$_POST["menu_name"];
    }
    else
    {
      $menu_name=NULL;
    }

    if(isset($_POST["text"]))
    {
        //$text=mysqli_real_escape_string($_POST["text"]);
        $text=$_POST["text"];
    }
    else
    {
      $text="HELLO";
    }
  //   if(isset($_POST["position"]))
  //   $position=(int)$_POST["position"];
  // else
  // {
  //   $position=NULL;
  // }
    if(isset($_POST["visible"]))
    $visible=(int)$_POST["visible"];
  else
  {
    $visible=NULL;
  }
  if(isset($_POST["subject_id"]))
    $subject_id=(int)$_POST["subject_id"];
  else
  {
    $subject_id=NULL;
  }

    if(!has_present($menu_name))
  {
      $errors[]="MENUAME CANNOT BE EMPTY";
  }

  if(!has_present($visible))
  {
      $errors[]="visiblity is not specified";
  }

  if(!has_present($text))
  {
      $errors[]="content is not specified";
  }
  if(!has_present($subject_id))
  {
      $errors[]="subject_id  is not specified";
  }
  else
  {
    if(is_present($subject_id)==null)
    {
      $errors[]="first create subject corresponding to this id";
    }
  }

if(has_present($menu_name))
{
  if(!valid_len($menu_name))
  {
      $errors[]="MENUNAME must have chars more than 4 and less than 30";
  }
}
}
//echo $subject_id;
    //$menu_name=mysqli_real_escape_string($menu_name);
    //echo $menu_name;

     // $position=find_pos($subject_id);
     // $position=$position+1;
    if(empty($errors))
    {
      $position=find_pos($subject_id);
      if($position==NULL)
      {
        $pos=1;
      }
      else
      {
     $pos=mysqli_num_rows($position);
     $pos=$pos+1;
   }
   //echo $pos;
   $text=trim($_POST["text"]);
   $text=mysqli_real_escape_string($conn,$text);
    $query="insert into pages(subject_id,menu_name,position,visible,content) values({$subject_id},'{$menu_name}',{$pos},{$visible},'{$text}')";
    //echo $query;
    $res=mysqli_query($conn,$query);
    if($res)
    {
    	$_SESSION["message"]="successfully created pages";
        redirect_to("manage_content.php");
    }
    else
    {
      die("query failed");
    }

    }
    else
    {
      $_SESSION["errors"]=$errors;
    	$_SESSION["message"]="some problem is encontered plz review!!!";
       // show_errors($errors);
    	redirect_to("new_page.php");
    }
