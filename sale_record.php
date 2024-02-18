<?php
session_start();
if(!isset($_SESSION['user']))
{echo'<script> window.location.href="login.php?warn=You Must Login First"; </script>';
}
$user= $_SESSION['user'];
$pagename= "sale_record.php";
$tablename= "sale_record";

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
<title>View Sale Record</title>

</head>

<body>

<div class="wrapper">

<!-- header-->
<?php include("include/header.php");   ?>
<!-- header-->

<div class="wrapper holder">

<div class="container showhead1"> <h4> VIEW SALE! </h4>  </div> 

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
$vendr= mysql_query($vendor_qry);
$v_row= mysql_fetch_array($vendr);

$med_qry= "SELECT * FROM medicine_details";
$med= mysql_query($med_qry);
$med_row= mysql_fetch_array($med);


?>

<div class="container">
<div class="col-md-2"> </div>
<div class="col-md-8 form-holder">
<div  class="text-decor1"> Search Sale(select one) </div>
 
<form method="post" action="#">

<span class="input-span"> By Date:- </span> <input type="date" name="sale_date"  required="required"/>

<span> <input type="submit" name="date"/> </span>

</form>  <br/>

<form method="post" action="#">

<span class="input-span"> By Block No:- </span> <input type="text" name="block_no"  required="required"/>

<span> <input type="submit" name="block"/> </span>

</form>  <br/>

<form method="post" action="#">

<span class="input-span"> By Vendor:- </span> <select name="vendor_sale"  required="required">

<?php
while($v_row= mysql_fetch_array($vendr))
{ ?>
	
    <option><?php  echo $v_row['vendor_name'];  ?></option>

<?php } ?>
</select>

<span> <input type="submit" name="vendor"/> </span>

</form>  

<form method="post" action="#">

<span class="input-span"> By Medicine:- </span> <select name="medicine_sale"  required="required">

<?php
while($med_row= mysql_fetch_array($med))
{ ?>
	
    <option><?php  echo $med_row['med_name'];  ?></option>

<?php } ?>
</select>


<span> <input type="submit" name="medicine"/> </span>

</form>  

</div>
<div class="col-md-2"> </div>
</div>

<hr/>

<div class="wrapper">

<div class="container-fluid showhead2"> <h4> SEARCHED SALE RECORDS!<h4>  </div>

<div class="container-fluid table-holder">

<table align="center" class="table-responsive">

<th>SR NO.</th>
<th>SALE DATE</th>
<th>SALE TIME</th>
<th>SALE VENDOR</th>
<th>SLAE STOCK DATE  </th>
<th>MEDICINE NAME</th>
<th>MEDICINE POWER</th>
<th>BLOCK NO.</th>
<th>RACK NO.</th>
<th>UNIT SALE</th>
<th>UNIT COST</th>
<th>COST(In Rs.)</th>
<th>DELETE</th>


<?php

$no= 1;

include("include/db.php");

$qry= "SELECT * FROM sale_record ORDER BY id DESC";


if(isset($_POST['block']))
{
$block_no= $_POST['block_no'];
$qry= "SELECT * FROM sale_record WHERE block_no= '$block_no' ORDER BY id DESC ";

}

if(isset($_POST['vendor']))
{
$vendor_sale= $_POST['vendor_sale'];
$qry= "SELECT * FROM sale_record WHERE vendor_name= '$vendor_sale' ORDER BY id DESC ";

}

if(isset($_POST['medicine']))
{
$medicine= $_POST['medicine_sale'];
$qry= "SELECT * FROM sale_record WHERE medicine= '$medicine' ORDER BY id DESC ";

}

$result= mysql_query($qry);


while($row= mysql_fetch_array($result))
{
	
$id= $row['id'];

echo "<tr>";
echo "<td>".$no++."."."</td>";
echo "<td>".$row['date']."</td>";
echo "<td>".$row['time']."</td>";
echo "<td>".$row['vendor_name']."</td>";
echo "<td>".$row['stock_date']."</td>";
echo "<td>".$row['medicine']."</td>";
echo "<td>".$row['med_power']."</td>";
echo "<td>".$row['block_no']."</td>";
echo "<td>".$row['rack_no']."</td>";
echo "<td>".$row['units_sale']."</td>";
echo "<td>".$row['unit_cost']."</td>";
echo "<td>".$row['medicine_cost']."</td>";
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
