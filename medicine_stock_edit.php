<?php
session_start();
if(!isset($_SESSION['user']))
{echo'<script> window.location.href="login.php?warn=You Must Login First!"; </script>';}
$user= $_SESSION['user'];

if(!isset($_REQUEST['id']) && !isset($_REQUEST['page_name']) && !isset($_REQUEST['table_name']))
{
	echo'<script> window.location.href="view_stock_exist.php?warn=You Cannot Edit This Stock!"; </script>';
}
$pagename= "medicine_stock_edit.php";
$tablename= "medicine_stock";

$page=$_REQUEST['page_name'];
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

<script>
function total()
{
	var u= document.getElementById("unitmed").value;
    var c= document.getElementById("unitcost").value;
	var t = u* c;
document.getElementById("totalcost").value = t;
}
</script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Medicine Stock</title>

</head>

<body>

<div class="wrapper">

<!-- header-->
<?php include("include/header.php");   ?>
<!-- header-->

<div class="wrapper holder">

<div class="container showhead1"> <h4> UPDATE STOCK DETAILS! </h4>  </div> <hr/>

<?php
if(isset($_REQUEST['msg']))
{ ?>
<div class="alert alert-success" style="font-family: 'Exo 2', sans-serif;">
  <strong>NOTE!-</strong> <?php  echo $_REQUEST['msg']; ?> </div>
    <meta http-equiv="refresh" content="3; url= medicine_stock_edit.php" />

<?php }

if(isset($_REQUEST['warn']))
{
	?>
<div class="alert alert-danger" style="font-family: 'Exo 2', sans-serif;">
  <strong>NOTE!-</strong> <?php  echo $_REQUEST['warn']; ?> </div>
    <meta http-equiv="refresh" content="3; url= medicine_stock_edit.php" />

<?php } ?>

<div class="container">
<div class="col-md-2"> </div>
<div class="col-md-8 form-holder">

<?php

$id= $_REQUEST['id'];

include("include/db.php");

$qry= "SELECT * FROM medicine_stock WHERE id= '$id'";

$result= mysql_query($qry);
$row= mysql_fetch_array($result);

?>

<form method="post" action="#">

<span class="input-span"> Stock Id:- </span> <input type="number" name="stockid" value="<?php echo $row['stock_id']; ?>" readonly/>
<br/> <br/>

<span class="input-span"> Stock Reach Date:- </span> <input type="text" name="stockdate" value="<?php echo $row['stock_date']; ?>" readonly/>
<br/> <br/>

<span class="input-span"> Stock Vendor:- </span> <input type="text" name="stock_vendor" placeholder="Stock vendor" value="<?php echo $row['stock_vendor']; ?>" readonly/>
<br/> <br/>

<span class="input-span"> Sales Person:- </span> <input type="text" name="sales_person"  placeholder="Sales aperson" value="<?php echo $row['sales_person']; ?>"  readonly/>
<br/> <br/>

<span class="input-span"> Medicine Name:- </span> <input type="text" name="medicine_name" value="<?php echo $row['medicine_name']; ?>" required="required"/>
<br/> <br/>

<span class="input-span"> IUPAC Name:- </span> <input type="text" name="iupac" value="<?php echo $row['iupac'];; ?>" required="required"/>
<br/> <br/>


<span class="input-span"> Medicine Power:- </span> <input type="text" name="power" value= "<?php echo $row['power']; ?>" placeholder="Medicine Power" required/>
<br/> <br/>

<span class="input-span"> Manufacturing Date- </span> <input type="date" name="manufacture_date" value= "<?php echo $row['manufacture_date']; ?>" placeholder="manufacturing date" required/>
<br/> <br/>

<span class="input-span"> Expiry Date:- </span> <input type="date" name="expiry_date" value= "<?php echo $row['expiry_date']; ?>" placeholder="Expiry Date" required/>
<br/> <br/>

<span class="input-span"> Block No.:- </span> <input type="text" name="block_no" value= "<?php echo $row['block_no']; ?>"placeholder="medicine Block No." required/>
<br/> <br/>

<span class="input-span"> Rack No.:- </span> <input type="text" name="rack_no" value= "<?php echo $row['rack_no']; ?>"placeholder="rack no." required/>
<br/> <br/>

<span class="input-span"> Medicine Units:- </span> <input type="text" name="medicine_unit" id="unitmed"  value= "<?php echo $row['medicine_unit']; ?>" placeholder="medicine units" required/>
<br/> <br/>

<span class="input-span"> Cost Per Unit (in Rs):- </span> <input type="text" name="unit_cost" id="unitcost" value= "<?php echo $row['unit_cost']; ?>" placeholder="Cost per unit" required/>
<br/> <br/>

<span class="input-span"> Total Cost (in Rs):- </span> <input type="text" name="total_cost" id= "totalcost"  value= "<?php echo $row['total_cost']; ?>" placeholder="Total units cost" onclick="total()" required/>
<br/> <br/>

<span class="sub-span"> <input type="submit" name="sub"/> </span> <input type="reset" name="reset" value="reset"/>

</form>  

</div>
<div class="col-md-2"> </div>
</div>

<?php
if(isset($_POST['sub']))
{

$stockdate= $_POST['stockdate'];
$stockvendor= $_POST['stock_vendor'];
$sales_person= $_POST['sales_person'];
$medicine= $_POST['medicine_name'];
$iupac= $_POST['iupac'];
$power= $_POST['power'];
$manufacture_date= $_POST['manufacture_date'];
$expiry_date= $_POST['expiry_date'];
$block= $_POST['block_no'];
$rack= $_POST['rack_no'];
$medicine_unit= $_POST['medicine_unit'];
$unit_cost= $_POST['unit_cost'];
$total_cost= $_POST['total_cost'];

include("include/db.php");
	
$qry1= "UPDATE medicine_stock SET stock_date='$stockdate',stock_vendor='$stockvendor',sales_person='$sales_person',medicine_name='$medicine',iupac='$iupac',power='$power',manufacture_date='$manufacture_date',expiry_date='$expiry_date',block_no='$block',rack_no='$rack',medicine_unit='$medicine_unit',unit_cost='$unit_cost',total_cost='$total_cost' WHERE id= '$id'";

$result1= mysql_query($qry1);

if($result1)
{

echo "<script> window.location.href='$page?msg=Stock is Successfully Updated'; </script>";
}
else
{
echo "<script> window.location.href='$page?warn=Stock is Not Successfully Updated'; </script>";

} 
   }
 mysql_close($conn);  
   
?>

<hr/>
</div> 

<!-- footer  -->
<?php include("include/footer.php");   ?>
<!-- footer  -->

</div>

</body>
</html>

