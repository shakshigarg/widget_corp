    <?php require_once("../includes/function.php");?>
    <?php $layout="admin"?>
    <?php require_once("../includes/layout/headers.php");?>
     <?php require_once("../includes/validation.php");?>

    <?php//to establish database connection?>
    <?php require_once("../includes/db_conn.php");?>
    <?php require_once("session.php");?>
   <?php
    $query="delete from admins where username='{$_SESSION['username']}' ";
    $result=mysqli_query($conn,$query);
    if($result)
    {
      $_SESSION["user_id"]=null;
      $_SESSION["username"]=null;
      redirect_to('login.php');
    }
    else
    {
      $_SESSION["message"]="SOME PROBLEM OCCURRED CANNOT DELETE USER";
    }?>
    <div id="main">
     <div id="navigation">
      &nbsp;
        <p><a href="admin.php">RETURN TO MENU</a></p>
        &nbsp;
      </div>
      <div id="page">
        <?php echo $_SESSION['message'];?>



      </div>
      
    </div> 
   <?php include("../includes/layout/footers.php")?>