    <?php require_once("session.php");?>
    <?php
function has_present($val)
{
	$value=trim($val);
	if(isset($value)&&$value!=="")
	{
		return true;
	}
	else
	{
		return false;
	}
}

function valid_len($value)
{
	$max=30;
	$min=4;
	if(strlen($value)<=$max&&strlen($value)>=$min)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function show_errors($errors=array()) {
		$output = "";
		if (!empty($errors)) {
		  $output .= "<div class=\"message\">";
		  $output .= "Please fix the following errors:";
		  $output .= "<ul>";
		  foreach ($errors as $key => $error) {
		    $output .= "<li>{$error}</li>";
		  }
		  $output .= "</ul>";
		  $output .= "</div>";
		}
		$_SESSION["errors"]=array();
		return $output;
	}


?>