<?php
$dbhost="localhost";
$dbuser="saki";
$dbpass="saki@123";
$dbname="widget_corp";
$conn=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
if(mysqli_connect_errno())
{
	//die("database conn failed");
	echo mysqli_connect_errno()."(".mysqli_connect_errno().")";
}
else
{
	echo "<h1><i>DATABASE CONNECTION ESTABLISHED</i></h1>";
}
?>
<?php
$query2="select * from subjects";
$res2=mysqli_query($conn,$query2);
if(!$res2&&mysqli_affected_rows($conn)!=0)
{
	die("query has an error");
}

?>

<html>
<head>
<title>
database
</title>
<body>
<?php 
echo "<ul>";

while($row=mysqli_fetch_assoc($res2))
{
	echo "<li>".$row["menu_name"]."</li>";
	//echo "</hr>";

}
echo "</ul>";

?>

<?php
if($conn)
mysqli_free_result($res2);
?>

</br>
<?php
if($conn)
mysqli_close($conn);
?>

</form>
</body>
</html>