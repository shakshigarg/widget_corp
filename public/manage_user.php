    <?php require_once("../includes/function.php");?>
    <?php $layout="admin"?>
    <?php require_once("../includes/layout/headers.php");?>
     <?php require_once("../includes/validation.php");?>

    <?php//to establish database connection?>
    <?php require_once("../includes/db_conn.php");?>
    <?php require_once("session.php");?>
  

    <div id="main">
     <div id="navigation">
      &nbsp;
        <p><a href="admin.php">RETURN TO MENU</a></p>
        &nbsp;
      </div>
      <div id="page">
        <h2>MANAGE ADMINS</h2>
        <table cellpadding="30em">
          <tr>
            <td>
              <a href="new_user.php"><img src="new_user.jpg" height="150em" width="150em"></a>
              <p>
              <a href="new_user.php"><b>CREATE NEW USER</b></a></p>
            </td>
            <td>
              <a href="change_pass.php"><img src="ch_pas.png" height="150em" width="150em"></a>
              <p>
              <a href="change_pass.php"><b>  CHANGE PASSWORD</b></a></p>
            </td>
            <td>
              <a href="delete_user.php"><img src="del.jpg" height="150em" width="150em"></a>
              <p>
              <a href="delete_user.php"><b>DELETE YOURSELF</b></a></p>
            </td>
          </tr>
          
        </table>


      </div>
      
    </div> 
   <?php include("../includes/layout/footers.php")?>