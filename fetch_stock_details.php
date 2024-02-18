<?php
session_start();
if(!isset($_SESSION['user']))
{echo'<script> window.location.href="login.php?warn=You Must Login First!"; </script>';}
$email= $_SESSION['user'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> fetch_stock_details </title>
</head>
<body>
<?php

$names= $_REQUEST['u'];

include("include/db.php");

$qry= "SELECT * FROM medicine_stock WHERE medicine_name LIKE '%$names%'" ;

$result= mysql_query($qry);
?>

<?php
while($row= mysql_fetch_array($result))
{
	$id= $row['id'];
	$left= $row['medicine_unit'];
?>

<a href='customer_medicine_sale.php?id=<?php echo $id ?>'> <?php echo $row['medicine_name']; ?> ==>(<?php echo $row['medicine_unit']; ?> Left)</a><br/> 

<?php

} mysql_close($conn);
?> 

</body>
</html>