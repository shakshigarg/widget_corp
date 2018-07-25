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
    //to get the subject id and page id from the url so that we get to know which link is highlighted
    //and we bold that only link
    if(isset($_GET["subject_id"]))
    {
      $subject_id=$_GET["subject_id"];
      $page_id=NULL;
    }
    elseif(isset($_GET["page_id"]))
    {
      //$current_page=find_page_by_id($_GET["page_id"]);
      $page_id=$_GET["page_id"];
      $subject_id=NULL;
      //$current_subject=null;
    }
    else
      {
       //$current_subject=null;
       //$current_page=null; 
       $subject_id=NULL;
       $page_id=NULL;
    }
?>

<?php 
//echo "sub: ".$subject_id;
if($page_id)
{
  $current_page=find_page_by_id($page_id);
}
else
{
  //echo"no subj id";
  redirect_to("manage_content.php");
}
?>

<?php
    $errors=array();
    if(isset($_POST['update_page']))
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
        $text=$_POST["text"];
    }
    else
    {
      $text=NULL;
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

    if(!has_present($menu_name))
  {
      $errors[]="MENUAME CANNOT BE EMPTY";
  }
   if(!has_present($text))
  {
      $errors[]="CONTENT CANNOT BE EMPTY";
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

    //$menu_name=mysqli_real_escape_string($menu_name);
    //echo $menu_name;
    if(empty($errors))
    {
      $text=trim($_POST["text"]);
   $text=mysqli_real_escape_string($conn,$text);
    $query="update pages set menu_name=\"";
    $query.=$menu_name."\",content=\"".$text."\",visible=".$visible." where id=".$page_id;
    echo $query;
    $res=mysqli_query($conn,$query);
    if($res)
    {
      $_SESSION["message"]="successfully updated page";
        redirect_to("manage_content.php");
    }
    else
    {
      $_SESSION["errors"]=$errors;
      $_SESSION["message"]="page updation failed!!";
       // show_errors($errors);
     // redirect_to("edit_subject.php");
    }
  }
}
?>



    <div id="main">
      <div id="navigation">
        <?php
        //navigation fun return whatever we have on the navigation side
        $res=navigation($subject_id,$page_id,$layout);
        echo $res;
        //if($conn)
         //mysqli_free_result($res);

          ?>
      </div>
      <div id="page">




      <?php //it is what is written in body
      echo message();
      
        $errors=error();
        echo show_errors($errors);
        
      
      ?>
        <h2>EDIT PAGE: <?php echo ucwords($current_page["menu_name"])?></h2>
        <form action="edit_page.php?page_id=<?php echo urlencode($current_page["id"]); ?>" method="post">
         <p>MENU NAME:
         <input type="test" name="menu_name" value="<?php echo htmlentities($current_page['menu_name'])?>">
       </p>
       <!-- <p>POSITION:
        <select name="position">
          <?php
          // $res1=find_all_subjects();
          // $res=mysqli_num_rows($res1);
          //$query="select count(*) from subjects";
          //$res=mysqli_query($conn,$query);
          //$res=mysqli_fetch_row($res);
            // for($count=1;$count<=($res);$count++)
            // {
            //   echo "<option value='htmlentities($count)' ";
            //   if($count==$current_sub["id"])
            //     echo "selected";
            //   echo ">{$count}</option>";
            //}
          ?>
        </select>
      </p> -->
      <p>VISIBLE:
        <input type="radio" name="visible" value="0" <?php if($current_page['visible']==0){echo "checked";}?> />NO
        &nbsp;
        <input type="radio" name="visible" value="1" <?php if($current_page['visible']==1){echo "checked";}?> />YES
      </p>
      <p>CONTENT:<br>
        <textarea name="text"><?php echo htmlentities($current_page['content'])?></textarea>
      </p>
      <input type="submit" name="update_page" value="UPDATE"/>
    </form>
  </br>
  <a href="manage_content.php">Cancel</a>&nbsp;
  &nbsp;
  <a href="delete_page.php?page_id=<?php echo urlencode($current_page['id']); ?>">delete</a>


      </div>
      
    </div> 
   <?php include("../includes/layout/footers.php")?>