<?php
session_start();
if(!isset($_SESSION['user']))
{
	echo'<script> window.location.href="login.php?warn=You Must Login First!"; </script>';
}
$user= $_SESSION['user'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Delete Medicine</title>
</head>

<body>
<?php

$del= $_GET['medid'];
session_start();
$a=$_SESSION['total_medicine'];
$count=count($_SESSION['total_medicine']);
$b=array();
var_dump($a);
unset($a[$del]);
unset($a[$del+1]);
var_dump($a);
for($l=0;$l<$count;$l++)
{
	if(isset($a[$l]))
	{
		array_push($b,$a[$l]);
	}
}
$_SESSION['total_medicine']=$b;
var_dump($b);
var_dump($_SESSION['total_medicine']);
?>
<script> window.location.assign("customer_medicine_sale.php") </script>
</body>
</html>