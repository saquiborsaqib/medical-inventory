<?php
session_start();
$email= $_SESSION['user'];
if(!isset($_SESSION['user']))
{echo'<script> window.location.href="login.php?msg=You Must Login First!"; </script>';}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> fetch expiry </title>
</head>

<body>

<?php

$names= $_REQUEST['e'];

include("include/db.php");

$qry= "SELECT * FROM medicine_stock WHERE iupac= '$names'";

$result= mysql_query($qry);

$row= mysql_fetch_array($result);
?>

<input value="<?php echo $row['expiry_date']; ?>"/>
<?php
mysql_close($conn);
?>
</body>
</html>