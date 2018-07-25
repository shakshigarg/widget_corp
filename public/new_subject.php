    <?php require_once("../includes/function.php");?>
    <?php $layout="admin"?>
    <?php require_once("../includes/layout/headers.php");?>
     <?php require_once("../includes/validation.php");?>

    <?php//to establish database connection?>
    <?php require_once("../includes/db_conn.php");?>
    <?php require_once("session.php");?>
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
        <h2>CREATE FORM</h2>
        <form action="create_subject.php" method="post">
         <p>MENU NAME:
         <input type="test" name="menu_name" value="">
       </p>
       <p>POSITION:
        <select name="position">
          <?php
          $res1=find_all_subjects();
          $res=mysqli_num_rows($res1);
          //$query="select count(*) from subjects";
          //$res=mysqli_query($conn,$query);
          //$res=mysqli_fetch_row($res);
            for($count=1;$count<=($res+1);$count++)
            {
              echo "<option value='$count'>{$count}</option>";
            }
          ?>
        </select>
      </p>
      <p>VISIBLE:
        <input type="radio" name="visible" value="0" />NO
        &nbsp;
        <input type="radio" name="visible" value="1" />YES
      </p>
      <input type="submit" name="create_subject" value="submit"/>
    </form>
  </br>
  <a href="manage_content.php">Cancel</a>


      </div>
      
    </div> 
   <?php include("../includes/layout/footers.php")?>