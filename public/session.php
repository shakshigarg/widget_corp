<?php

session_start();
?>
<?php
function confirm_login()
{
     
    if(!isset($_SESSION['user_id']))
    {
      redirect_to("login.php");
    }
    
}
function message()
{
	if(isset($_SESSION["message"]))
	{
		$output="<div class=\"message\">";
		$output.=htmlentities($_SESSION["message"]);
		$output.="</div>";
		$_SESSION["message"]=null;
         return $output;
	}
}

	function error()
	{
      if(isset($_SESSION["errors"]))
      {
      	$output=$_SESSION["errors"];
      	$_SESSION["errors"]=null;
      	return $output;
      }
      else
      {
      	return null;
      }
	}

?>