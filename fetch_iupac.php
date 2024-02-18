<?php
session_start();
if(!isset($_SESSION['user']))
{echo'<script> window.location.href="login.php?msg=You Must Login First!"; </script>';}

$email= $_SESSION['user'];

?>
<html>
<head> <title> fetch_iupac </title>
</head>
<body>
<select>
<?php

include("include/db.php");

$names= $_REQUEST['q'];

$qry= "SELECT * FROM medicine_details WHERE med_name= '$names'";
$result= mysql_query($qry);

while($row= mysql_fetch_array($result))
{
	echo "<option value=".$row['iupac'].">".$row['iupac']."</option>";
}
mysql_close($conn);
?>
</select>
</body>
</html>