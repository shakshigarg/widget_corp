   <?php $layout="admin"?>
    <?php require_once("../includes/function.php");?>
      <?php require_once("session.php");?>
    <?php

    confirm_login();
?>
    <?php include("../includes/layout/headers.php")?>
    <div id="main">
      <div id="navigation">
        &nbsp;
      </div>
      <div id="page">
          
        
        <div id="page">
        <h2>WELCOME TO ADMIN AREA<?php if(isset($_SESSION['username'])){ echo ",".$_SESSION['username'];}?></h2>
        <table cellpadding="30em">
          <tr>
            <td>
              <a href="manage_content.php"><img src="manage.jpg" height="150em" width="150em"></a>
              <p>
              <a href="manage_content.php"><b><center>MANAGE WEBSITE CONTENT</center></b></a></p>
            </td>
            <td>
              <a href="manage_user.php"><img src="main.jpg" height="150em" width="150em"></a>
              <p>
              <a href="manage_user.php"><b><center>MANAGE ADMIN USERS</center></b></a></p>
            </td>
            <td>
              <a href="logout.php"><img src="logout.jpg" height="150em" width="150em"></a>
              <p>
              <a href="logout.php"><b><center>LOGOUT</center></b></a></p>
            </td>
          </tr>
          
        </table>


      </div>
      </div>
    </div>
   <?php include("../includes/layout/footers.php")?>