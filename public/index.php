    <?php require_once("../includes/function.php");?>
    <?php require_once("../includes/validation.php");?>

       <?php require_once("session.php");?>
       <?php $layout="public"?>
    <?php require_once("../includes/layout/headers.php");?>
    <?php//to establish database connection?>
    <?php require_once("../includes/db_conn.php");?>
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
        echo $res;?>
        <!-- <a href="new_subject.php">+ ADD NEW SUBJECT</a>
        <br>
        <br>
         <a href="new_page.php">+ ADD NEW PAGE</a> -->
        <!-- <?php
        //if($conn)
         //mysqli_free_result($res);

          ?> -->
      </div>
      <div id="page">
      <?php //it is what is written in body?>
        <h2>MANAGE CONTENT</h2>
        <?php
        //echo message();
        if($subject_id)
        {
          echo "MANAGE SUBJECT<br>";
          $current_subject=find_subject_by_id($subject_id);
          echo "<p class='view-content'>";
          echo "MENU NAME:  ".htmlentities($current_subject["menu_name"]);
          echo"<br>";
          echo "POSITION:  ".htmlentities($current_subject["position"]);
          echo"<br>";
          echo "VISIBLE:  ".htmlentities($current_subject["visible"]);
          echo"<br>";
          echo "</p>";
          //echo "CONTENT:  ".htmlentities($current_subject["content"]);
          //echo"<br>";
          //echo "<br><br><a href=\"edit_subject.php?subject_id=";
          //echo urlencode($current_subject['id'])."\" >EDIT SUBJECT</a>";
  
        }
        elseif ($page_id) {
          echo "MANAGE PAGE<br>";
          $current_page=find_page_by_id($page_id);
          echo "<p class='view-content'>";
            echo "MENU NAME:  ".htmlentities($current_page["menu_name"]);
          echo"<br>";
          echo "POSITION:  ".htmlentities($current_page["position"]);
          echo"<br>";
          echo "VISIBLE:  ".htmlentities($current_page["visible"]);
          echo"<br>";
          echo "CONTENT:  ".htmlentities($current_page["content"]);
          echo"<br>";
          echo "</p>";
          //echo "<br><br><a href=\"edit_page.php?page_id=";
          //echo urlencode($current_page['id'])."\" >EDIT PAGE</a>";
        }
        else
        {
          echo "click on page or subject";
        }
      ?>
      </div>
      
    </div> 
   <?php include("../includes/layout/footers.php")?>