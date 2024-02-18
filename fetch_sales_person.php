<?php

session_start();
if(!isset($_SESSION['user']))
{echo'<script> window.location.href="login.php?warn=You Must Login First!"; </script>';}

$email= $_SESSION['user'];

$vendor_id= $_REQUEST['q'];
include("include/db.php");
echo $qry="SELECT * FROM vendor_sales_person WHERE vendor_id= '$vendor_id'";
$result= mysql_query($qry);

?>
<select>

<?php 
while($row= mysql_fetch_array($result))
{
	echo "<option value='".$row['sales_person']."'>".$row['sales_person']."</option>";
}
mysql_close($conn);
?>

</select>
