<?php
session_start();
if(!isset($_SESSION['user']))
{
	echo '<script> window.location.href="login.php?warn=You Must Login First!"; </script>';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Search medicine page</title>
</head>

<body>

<?php
include("include/db.php");
if(isset($_POST['name']))
{
	$username = mysql_real_escape_string(trim($_POST['name']));
	$sql = "SELECT `medicine_name` FROM `medicine_stock` WHERE `medicine_name` LIKE '%$username%'";
	$myquery = mysql_query($sql) or die(mysql_error());
	if(mysql_num_rows($myquery) !=0)
	{
		while(($row = mysql_fetch_array($myquery )) !== false)
		{
			echo '<li>'.$row['medicine_name'].'</li>';
		}
	}
	else
	{
		echo '<li>Not Found</li>';
	}
}
mysql_close($conn);
?>


</body>
</html>