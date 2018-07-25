<?php
function redirect_to($to)
{
header("Location: ".$to);
exit;
}
//this fun check if the result is valid or not i.e. if the query work successfully or not
function confirm_query($result,$conn)
{
  if(!$result && mysqli_affected_rows($conn)!=0)
{
  die("query has an error");
}
}

function find_all_a_pages($page_id)
{
  global $conn;
   $query="select * from pages where subject_id=(select subject_id from pages where id=".$page_id; 
   echo $query;
      //$sub_id=mysqli_query($conn,$query);
      //$sub_id=(int)$sub_id;
      //$query="select * from pages where subject_id=".$sub_id;
      $res=mysqli_query($conn,$query);
      return $res;
}

function find_pos($subject_id)
{
  global $conn;
   $query="select * from pages where subject_id=".$subject_id; 
   echo $query;
      //$sub_id=mysqli_query($conn,$query);
      //$sub_id=(int)$sub_id;
      //$query="select * from pages where subject_id=".$sub_id;
      $res=mysqli_query($conn,$query);
      return $res;
}

function  is_present($subject_id)
{
  global $conn;
   $query2="select * from subjects where id=".$subject_id;
      $res2=mysqli_query($conn,$query2);
      return $res2;
}


//this fun used to get all data from table subjects where visible is 1
function find_all_subjects($admin=true)
{
	global $conn;
	 $query2="select * from subjects ";
   if(!$admin)
    {$query2.="where visible=1 ";}
  $query2.="order by position asc";
      $res2=mysqli_query($conn,$query2);
      return $res2;
}

function find_max_subject_id()
{
  global $conn;
   $query2="select * from subjects where id=(select max(id) from subjects)";
      $res2=mysqli_query($conn,$query2);
      return $res2;
}
function find_pages_of_subject($subject_id)
{
  global $conn;
   $query2="select * from pages where subject_id=$subject_id";
      $res2=mysqli_query($conn,$query2);
      return $res2;
}

function prep($string)
{
	$es_string=mysqli_real_escape_string($string);
	return $es_string;
}

//fun to get all pages corresponding to one subject id
function find_all_pages($id,$admin=true)
{
	global $conn;
	$query="select * from pages where ";
  if(!$admin)
  $query.="visible=1 and ";
  $query.="subject_id=".$id;
    $res=mysqli_query($conn,$query);
      return $res;
}

function find_subject_by_id($subject_id)
{
		global $conn;
	$subject_id=mysqli_real_escape_string($conn,$subject_id);
	 $query2="select * from subjects where id=$subject_id";
      $res2=mysqli_query($conn,$query2);
      confirm_query($res2,$conn);
      if($res=mysqli_fetch_assoc($res2))
     { //print_r($res);
      return $res;
  }
  else
  {
  	return null;
  }
}

function find_page_by_id($page_id)
{
	global $conn;
	$page_id=mysqli_real_escape_string($conn,$page_id);

	 $query2="select * from pages where id=$page_id LIMIT 1";
      $res2=mysqli_query($conn,$query2);
      if($page=mysqli_fetch_assoc($res2))
      return $page;
  else
  {
  	return null;
  }
}

//it is the fun to get all data we have to put on navigation
function navigation($subject_id,$page_id,$layout)
{
	global $conn;
	$subject_id=mysqli_real_escape_string($conn,$subject_id);
	$page_id=mysqli_real_escape_string($conn,$page_id);
  if($page_id!=null)
	{$current_page=find_page_by_id($page_id);}
    //echo $current_page['subject_id'];}
  //$current_page=mysqli_fetch_assoc($current_page);}
else
{
  $current_page=null;
}
if($layout=="admin")
	$res2=find_all_subjects();
else
{
  $res2=find_all_subjects(false);
}
	//echo $res2;
    confirm_query($res2,$conn);
    $output ="<ul class='subjects'>";
    if($layout=="admin")
{
          while($row=mysqli_fetch_assoc($res2))
    {
            if($layout=="public")
           $output .="<a href='index.php?subject_id=".urlencode($row["id"])."'>"."<li ";
         else
         {
          $output .="<a href='manage_content.php?subject_id=".urlencode($row["id"])."'>"."<li ";
         }
           if($row["id"]==$subject_id)
           $output .="class='selected'";
           $output .=">".$row["menu_name"]."</a></li>";
           $res=find_all_pages($row["id"]);
           confirm_query($res,$conn);
           //if($row["id"]==$subject_id || $row["id"]==$current_page['subject_id'])
           $output .="<ul class='pages'>";
           while($row1=mysqli_fetch_assoc($res))
           {
                  if($layout=="public")
           $output .="<a href='index.php?page_id=".urlencode($row1["id"])."'>"."<li ";
         else
         {
          $output .="<a href='manage_content.php?page_id=".urlencode($row1["id"])."'>"."<li ";
         }
                 
                 if($row1["id"]==$page_id)
                $output .="class='selected'";
                $output .=">".$row1["menu_name"]."</li>"."</a>";
           }
           $output .="</ul>";
     }
            $output .="</ul>";
 }
    else
    {
      while($row=mysqli_fetch_assoc($res2))
    {
     $output .="<a href='index.php?subject_id=".urlencode($row["id"])."'>"."<li ";
     if($row["id"]==$subject_id)
     $output .="class='selected'";
     $output .=">".$row["menu_name"]."</a></li>";
     $res=find_all_pages($row["id"]);
     confirm_query($res,$conn);
     if($row["id"]==$subject_id || $row["id"]==$current_page['subject_id'])
     {$output .="<ul class='pages'>";
     while($row1=mysqli_fetch_assoc($res))
     {
     $output .="<a href='index.php?page_id=".urlencode($row1["id"])."'>"."<li ";
     if($row1["id"]==$page_id)
    $output .="class='selected'";
    $output .=">".$row1["menu_name"]."</li>"."</a>";
}
$output .="</ul>";}
}
$output .="</ul>";
    }
//echo $output;
return $output;
}

function navigation_public($subject_id,$page_id)
{
  global $conn;
  $subject_id=mysqli_real_escape_string($conn,$subject_id);
  $page_id=mysqli_real_escape_string($conn,$page_id);
  
  $res2=find_all_subjects();
  //echo $res2;
    confirm_query($res2,$conn);
    $output ="<ul class='subjects'>";

    while($row=mysqli_fetch_assoc($res2))
    {
     $output .="<a href='index.php?subject_id=".urlencode($row["id"])."'>"."<li ";
     if($row["id"]==$subject_id)
     $output .="class='selected'";
     $output .=">".$row["menu_name"]."</a></li>";
     $res=find_all_pages($row["id"]);
     confirm_query($res,$conn);
     $output .="<ul class='pages'>";
     while($row1=mysqli_fetch_assoc($res))
     {
     $output .="<a href='index.php?page_id=".urlencode($row1["id"])."'>"."<li ";
     if($row1["id"]==$page_id)
    $output .="class='selected'";
    $output .=">".$row1["menu_name"]."</li>"."</a>";
}
$output .="</ul>";
}
$output .="</ul>";
//echo $output;
return $output;
}


function mge($message)
{
 if($message)
 {
   $output="<div class=\"message\">";
  $output.=$message;
  $output.="</div> ";
  return $output;
 }

}
?>
