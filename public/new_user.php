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
    $query="select * from admins where username='{$username}'";
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result))
    {
      $message="USERNAME ALREADY IN USE";
    }
    else
    {$query="insert into admins(username,hashed_password) values('{$username}','{$hashed_password}') ";
        $result=mysqli_query($conn,$query);
        if($result)
        {$message="USER CREATED SUCCESSFULLY";
        }
        else
        {
          $message="PLEASE CHECK YOUR DETAILS";
        }}
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
        <h2>CREATE NEW USER</h2>
        <?php echo $message;?>
<?php echo show_errors($errors);?>
        <form action="new_user.php" method="post">
         <p>USERNAME :
         <input type="test" name="username" value="<?php echo $username; ?>" >
       </p>
       
      <p>PASSWORD:
        <input type="password" name="password" value="">
      </p>
      <p>
      <input type="submit" name="submit" value="create user"/>
    </p>
    </form>
  </br>


      </div>
      
    </div> 
   <?php include("../includes/layout/footers.php")?>