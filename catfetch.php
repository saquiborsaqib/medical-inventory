<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> category fetch </title>
</head>
<?php

include("include/db.php");

$category= $_REQUEST['n'];

$qry= "SELECT * FROM medicine_category where cat_name= '$category'";
$result= mysql_query($qry);
?>
<select >
<?php

while($row= mysql_fetch_array($result))
{
	echo "<option value=".$row['id'].">".$row['id']."</option>";
}

mysql_close($conn);
?>
</select>

<body>
</body>
</html>