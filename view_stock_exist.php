<?php
session_start();
if(!isset($_SESSION['user']))
{echo'<script> window.location.href="login.php?warn=You Must Login First"; </script>';
}
$user= $_SESSION['user'];
$pagename= "view_stock_exist.php";
$tablename= "medicine_stock";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset='utf-8'>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="css/style-menu.css">

<!-- Favicon -->
		<link rel="shortcut icon" href="images/favicon.ico">

		<!-- Web Fonts -->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700,300&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Raleway:700,400,300' rel='stylesheet' type='text/css'>

		<!-- Bootstrap core CSS -->
		<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        
		<!-- Font Awesome CSS -->
		<link href="fonts/font-awesome/css/font-awesome.css" rel="stylesheet">

		<!-- Plugins -->
		<link href="css/animations.css" rel="stylesheet">

		<!-- Worthy core CSS file -->
		<link href="css/style.css" rel="stylesheet">

		<!-- Custom css --> 
		<link href="css/custom.css" rel="stylesheet">
        
        <!-- styling css --> 
        <link href="css/styling.css" rel="stylesheet" type="text/css">
  
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/npm.js" type="text/javascript"></script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Medicine Stock</title>

</head>

<body>

<div class="wrapper">

<!-- header-->
<?php include("include/header.php");   ?>
<!-- header-->

<div class="wrapper holder">

<div class="container showhead1"> <h4> VIEW MEDICINE! </h4>  </div> 

<hr/>

<!-- alert-->
<?php
if(isset($_REQUEST['msg']))
{ ?>
<div class="alert alert-success" style="font-family: 'Exo 2', sans-serif;">
  <strong>NOTE!-</strong> <?php  echo $_REQUEST['msg']; ?> </div>
  <meta http-equiv="refresh" content="3; url= view_stock_exist.php" />
	
<?php }

if(isset($_REQUEST['warn']))
{
	?>
<div class="alert alert-success" style="font-family: 'Exo 2', sans-serif;">
  <strong>NOTE!-</strong> <?php  echo $_REQUEST['warn']; ?> </div>
  <meta http-equiv="refresh" content="3; url= view_stock_exist.php" />

<?php } ?>

<!-- alert -->

<?php
include("include/db.php");

$vendor_qry= "SELECT * FROM vendor_details";
$v= mysql_query($vendor_qry);
$v_row= mysql_fetch_array($v);

?>

<div class="container">
<div class="col-md-2"> </div>
<div class="col-md-8 form-holder">
<div  class="text-decor1"> Search Medicine(select one) </div>
 
<form method="post" action="#">

<span class="input-span"> By Date:- </span> <input type="date" name="date_stock"  required="required"/>

<input type="submit" name="date"/> </span>

</form>  <br/>

<form method="post" action="#">

<span class="input-span"> By Stock Id:- </span> <input type="text" name="id_stock"  required="required"/>

<span> <input type="submit" name="id"/> </span>

</form>  <br/>

<form method="post" action="#">

<span class="input-span"> By Vendor:- </span> <select name="vendor_stock"  required="required">

<?php
while($v_row= mysql_fetch_array($v))
{ ?>
	
    <option><?php  echo $v_row['vendor_name'];  ?></option>

<?php } ?>
</select>

<span> <input type="submit" name="vendor"/> </span>

</form>  



</div>
<div class="col-md-2"> </div>
</div>

<hr/>

<div class="wrapper">

<div class="container-fluid showhead2"> <h4> SEARCHED STOCK DETAILS !<h4>  </div>

<div class="container-fluid table-holder">

<table align="center" class="table-responsive">

<th>SR NO.</th>
<th>STOCK ID</th>
<th>STOCK DATE</th>
<th>STOCK VENDOR</th>
<th>VENDOR SALES PERSON</th>
<th>MEDICINE NAME</th>
<th>IUPAC NAME</th>
<th>MEDICINE POWER</th>
<th>MANUFACTURE DATE</th>
<th>EXPIRY DATE</th>
<th>BLOCK NO.</th>
<th>RACK NO.</th>
<th>MEDICINE UNIT</th>
<th>UNIT COST</th>
<th>TOTAL COST</th>
<th>EDIT</th>
<th>DELETE</th>


<?php

$no= 1;

include("include/db.php");

$qry= "SELECT * FROM medicine_stock ORDER BY id DESC";


if(isset($_POST['date']))
{
$stockdate= $_POST['date_stock'];
$qry= "SELECT * FROM medicine_stock WHERE stock_date= '$stockdate' ORDER BY id DESC ";

}

if(isset($_POST['id_stock']))
{
$stockid= $_POST['id_stock'];
$qry= "SELECT * FROM medicine_stock WHERE stock_id= '$stockid' ORDER BY id DESC ";

}

if(isset($_POST['vendor']))
{
$stockvendor= $_POST['vendor_stock'];
$qry= "SELECT * FROM medicine_stock WHERE stock_vendor= '$stockvendor' ORDER BY id DESC ";

}

$result= mysql_query($qry);


while($row= mysql_fetch_array($result))
{
	
$id= $row['id'];

echo "<tr>";
echo "<td>".$no++."."."</td>";
echo "<td>".$row['stock_id']."</td>";
echo "<td>".$row['stock_date']."</td>";
echo "<td>".$row['stock_vendor']."</td>";
echo "<td>".$row['sales_person']."</td>";
echo "<td>".$row['medicine_name']."</td>";
echo "<td>".$row['iupac']."</td>";
echo "<td>".$row['power']."</td>";
echo "<td>".$row['manufacture_date']."</td>";
echo "<td>".$row['expiry_date']."</td>";
echo "<td>".$row['block_no']."</td>";
echo "<td>".$row['rack_no']."</td>";
echo "<td>".$row['medicine_unit']."</td>";
echo "<td>".$row['unit_cost']."</td>";
echo "<td>".$row['total_cost']."</td>";
echo "<td> <a href='medicine_stock_edit.php?id=$id&&page_name=$pagename&&table_name=$tablename'> edit </a> </td>";
echo "<td> <a href='delete.php?id=$id&&page_name=$pagename&&table_name=$tablename'> delete </a> </td>";
echo "</tr>";	

}
mysql_close($conn);
?>

</table>

  
</div>  </div> </div>

<!-- footer  -->
<?php include("include/footer.php");   ?>
<!-- footer  -->


</div>

</body>
</html>
