<?php
define("DB_HOST","localhost");
define("DB_USER","saki");
define("DB_PASS","saki@123");
define("DB_NAME","widget_corp");



$conn=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
if(mysqli_connect_errno())
{
  //die("database conn failed");
  echo mysqli_connect_errno()."(".mysqli_connect_errno().")";
}
?>