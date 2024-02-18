<?php
session_start();
if(!isset($_SESSION['user']))
{echo'<script> window.location.href="login.php?warn=You Must Login First!"; </script>';}
$user= $_SESSION['user'];
$pagename= "medicine_invoice.php";
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
<title>update vendor</title>

</head>

<body>

<div class="wrapper">

<!-- header-->
<?php include("include/header.php");   ?>
<!-- header-->

<div class="wrapper holder">

<div class="container showhead1"> <h4> MEDICALHUB INVENTORY(Sale Invoice)! </h4>  </div> <hr/>

<!-- alert -->
<?php
if(isset($_REQUEST['msg']))
{ ?>
<div class="alert alert-success" style="font-family: 'Exo 2', sans-serif;">
  <strong>NOTE!-</strong> <?php  echo $_REQUEST['msg']; ?> </div>
	
<?php }

if(isset($_REQUEST['warn']))
{
	?>
<div class="alert alert-danger" style="font-family: 'Exo 2', sans-serif;">
  <strong>NOTE!-</strong> <?php  echo $_REQUEST['warn']; ?> </div>
  
<?php } ?>
<!-- alert -->

<div class="container-fluid edit-table-holder">

<table align="center" class="table-responsive">

  <tr> 
    <th colspan="2"> CUSTOMER NAME: </th> 
    <td colspan="3"> <input type="text" style="color:rgb(34, 114, 111);"/> </td>
  </tr>
  <tr> 
    <th colspan="2"> CUSTOMER AGE: </th> 
    <td colspan="3"> <input type="number" /> </td>
  </tr>
  <tr> 
    <th colspan="2"> CUSTOMER MOBILE: </th> 
    <td colspan="3"> <input type="number" /> </td>
  </tr>
  <tr>
    <th>SR. NO</th>
    <th>NAME</th>
    <th>UNIT PRICE</th>
    <th>QUANTITY</th>
    <th>TOTAL</th>
  </tr>
<!--===============loop=====================-->
<?php

if(isset($_SESSION['total_medicine']))
{

$count=count($_SESSION['total_medicine']);
$n=1;
$total=0;
for($ct=0;$ct<$count;$ct+=2)
{
	$sr=$ct+1;
	$medid=$_SESSION['total_medicine'][$ct];
	$medunit=$_SESSION['total_medicine'][$sr];
	include("include/db.php");
	$selqry="select * from medicine_stock where id = ".$medid;
	$medres=mysql_query($selqry);
	$medres0=mysql_fetch_array($medres);
?>
  <tr>
    <td><?php echo $n++; ?></td>
    <td><?php echo $medres0["medicine_name"];?></td>
    <td><?php echo $medres0["unit_cost"];?></td>
    <td><?php echo $medunit;?></td>
    <td><?php echo $medres0["unit_cost"]*$medunit;?></td>
    <?php $total=$total+$medres0["unit_cost"]*$medunit;?>
    <tr>
    	
<?php
} ?>  <tr> <td colspan="4">total</td>
        <td><?php echo $total;?></td> <tr> <?php }
?>

<!--===============loop=====================-->
</table>

<button onclick="fn()">Print</button>
<script>
function fn()
{
	window.print();
	
}
</script>
  
  
<div class="container-fluid sign-txt">Accounts signature </div>
  
  
<hr/>
</div> 


<?php mysql_close($conn);   ?>

<!-- footer  -->
<?php include("include/footer.php");   ?>
<!-- footer  -->

</div>

</body>
</html>
