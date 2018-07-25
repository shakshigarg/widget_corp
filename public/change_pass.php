    <?php require_once("../includes/function.php");?>
    <?php $layout="admin"?>
    <?php require_once("../includes/layout/headers.php");?>
     <?php require_once("../includes/validation.php");?>

    <?php//to establish database connection?>
    <?php require_once("../includes/db_conn.php");?>
    <?php require_once("session.php");?>
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
    $query="update admins set hashed_password='{$hashed_password}' where username='{$username}'";
    $result=mysqli_query($conn,$query);
    if($result)
    {
      $_SESSION["user_id"]=null;
      $_SESSION["username"]=null;
      redirect_to('login.php?m=1');
    }
    else
    {
      $message="SORRY CANNOT CHANGE PASSWORD";
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

    <div id="main">
     <div id="navigation">
      &nbsp;
        <p><a href="admin.php">RETURN TO MENU</a></p>
        &nbsp;
      </div>
      <div id="page">
        <h2>CHANGE PASSWORD</h2>
        <?php echo $message;?>
<?php echo show_errors($errors);?>
        <form action="change_pass.php" method="post">
         <p>USERNAME :
         <input type="test" name="username" value="<?php echo $_SESSION['username']; ?>" >
       </p>
       
      <p>PASSWORD:
        <input type="password" name="password" value="">
      </p>
      <p>
      <input type="submit" name="submit" value="CHANGE PASSWORD"/>
    </p>
    </form>
  </br>


      </div>
      
    </div> 
   <?php include("../includes/layout/footers.php")?>