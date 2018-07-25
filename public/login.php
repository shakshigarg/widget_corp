    <?php require_once("../includes/function.php");?>
    <?php $layout="admin"?>
    <?php require_once("../includes/layout/headers.php");?>
     <?php require_once("../includes/validation.php");?>

    <?php//to establish database connection?>
    <?php require_once("../includes/db_conn.php");?>
    <?php require_once("session.php");?>
    <?php
    if(isset($_SESSION['user_id']))
    {
      redirect_to("admin.php");
    }
    ?>
   <?php
    if(isset($_POST["submit"]))
{
  $errors=array();
  $username=trim($_POST["username"]);
  $password=trim($_POST["password"]);
  if(!has_present($username))
  {
      $errors[]="USERNAME CANNOT BE EMPTY";
  }

  if(!has_present($password))
  {
      $errors[]="PASSWORD CANNOT BE EMPTY";
  }

if(has_present($username))
{
  if(!valid_len($username))
  {
      $errors[]="USERNAME must have chars more than 4 and less than 30";
  }
}
  if(has_present($password))
  {
  if(!valid_len($password))
  {
      $errors[]="PASSWORD must have chars more than 4 and less than 30";
  }
}

  if(empty($errors))
  {
    $hashed_password=sha1($password);
    $query="select * from admins where hashed_password='{$hashed_password}' and username='{$username}'";
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result))
    {//$message="YOU CAN ENTER IN ADMIN AREA";
  $found=mysqli_fetch_array($result);
  $_SESSION['user_id']=$found['id'];
  $_SESSION['username']=$found['username'];
     redirect_to("admin.php");
    }
    else
    {
      $message="SORRY UNAUTHORISED ACCESS";
    }
  }
  else
  {
    $errors[]="PLEASE ENTER VALID INFO";
    $message="";
  }
}
else
{
    $username="";
    $message="";
    $errors=array();
}
?>
<?php
if(isset($_GET['m']))
   {
    $message="PLEASE LOGIN USING YOUR NEW PASSWORD";
   }
   ?>

    <div id="main">
     <div id="navigation">
      &nbsp;
        <p><a href="admin.php">RETURN TO MENU</a></p>
        &nbsp;
      </div>
      <div id="page">
        <h2>LOGIN</h2>
        <?php echo mge($message);?>
<?php echo show_errors($errors);?>
        <form action="login.php" method="post">
         <p>USERNAME :
         <input type="test" name="username" value="<?php echo $username; ?>" >
       </p>
       
      <p>PASSWORD:
        <input type="password" name="password" value="">
      </p>
      <p>
      <input type="submit" name="submit" value="LOGIN"/>
    </p>
    </form>
  </br>


      </div>
      
    </div> 
   <?php include("../includes/layout/footers.php")?>