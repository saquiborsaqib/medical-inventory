<?php
session_start();

if(!isset($_SESSION['user']))
{echo'<script> window.location.href="login.php?warn=You Must Login First!"; </script>';
}
$user= $_SESSION['user'];
$pagename= "customer_medicine_sale.php";
$tablename= "customer_sale";
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
<script src="js/npm.js" type="text/javascript"></script>
<script src="js/fetch_medicines.js" type="text/javascript"></script>
<script src="js/fetch_expiry.js" type="text/javascript"></script>

<script>

function total()
{ 
var u= document.getElementById("med_unit").value;
var c= document.getElementById("med_cost").value;
var t = u* c;
	
document.getElementById("total_box").value= t;
}
</script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Customer Medicine Sale</title>

</head>

<body>

<div class="wrapper">

<!-- header-->
<?php include("include/header.php");   ?>
<!-- header-->

<div class="wrapper holder">

<div class="container showhead1"> <h4> CUSTOMER MEDICINE SALE! </h4>  </div> <hr/>

<!-- alert -->
<?php
if(isset($_REQUEST['msg']))
{ ?>
<div class="alert alert-success" style="font-family: 'Exo 2', sans-serif;">
  <strong>NOTE!-</strong> <?php  echo $_REQUEST['msg']; ?> </div>
    <meta http-equiv="refresh" content="3; url=create_medicine.php" />

<?php }

if(isset($_REQUEST['warn']))
{
	?>
<div class="alert alert-danger" style="font-family: 'Exo 2', sans-serif;">
  <strong>NOTE!-</strong> <?php  echo $_REQUEST['warn']; ?> </div>
    <meta http-equiv="refresh" content="3; url=create_medicine.php" />

<?php } ?>

<!-- alert -->

<div class="container search-holder">
<div class="col-md-2"> </div>
<div class="col-md-8 form-holder">

<span class="input-span"> Search Medicine :- </span> <input type="text" name="search_medicine" placeholder="search medicine" onkeyup="show(this.value)"/>

<div class="dp-down" id="med_block">  </div> <hr/>

<?php
if(isset($_GET['id']))
{
$id= $_REQUEST['id'];

include("include/db.php");

$qry="SELECT * FROM medicine_stock WHERE id='$id'";

$result= mysql_query($qry);
$row= mysql_fetch_array($result);	

$total_units= $row['medicine_unit'];
	
?>
	
<form method="post" action="#">

<span class="input-span"> Medicine name:- </span> <input type="text" name="medi_name" value="<?php echo $row['medicine_name']; ?>" class="input-float" readonly="readonly"/> <br/> <br/>

<span class="input-span"> IUPAC name:- </span> <input type="text" name="iupac_name" value="<?php echo $row['iupac']; ?>" class="input-float" readonly="readonly"/> <br/> <br/>

<span class="input-span"> Medicine power:- </span> <input type="text" name="medi_power" value="<?php echo $row['power']; ?>" class="input-float" readonly="readonly"/> <br/> <br/>

<span class="input-span"> Manufactureing date:- </span> <input type="text" name="manufacture" value="<?php echo $row['manufacture_date']; ?>" class="input-float" readonly="readonly"/> <br/> <br/>

<span class="input-span"> Expiry date:- </span> <input type="text" name="expiry" value="<?php echo $row['expiry_date']; ?>" class="input-float" readonly="readonly"/> <br/> <br/>

<span class="input-span"> Unit Medicine Cost(in Rs):- </span> <input type="text" name="medi_cost" id="med_cost" value="<?php echo $row['unit_cost']; ?>" readonly="readonly" class="input-float" /> <br/> <br/>

<span class="input-span"> Medicine Units:- </span> <input type="text" name="medi_unit" id="med_unit"  class="input-float" placeholder="Medicine Units" required="required"/> <br/> <br/>

<span class="input-span"> Total Cost(in Rs):- </span> <input type="text" name="total_cost" id="total_box" class="input-float" class="input-float" placeholder="Total cost" onclick="total()" required="required" /> <br/> <br/>

<span class="sub-span"> <input type="submit" value="ADD" name="add"/> </span>

</form>	

</div>
<div class="col-md-2"> </div>
</div>

<?php	
}
?> 

<?php
if(isset($_POST['add']))
{
	    $medicin= $_POST['medi_name'];
		
		$units=$_POST['medi_unit'];
		if($units <= $total_units)
		{
				if(isset($_SESSION['total_medicine']))
				{
					$id= $_GET['id'];
					array_push($_SESSION['total_medicine'],$id,$units);
				}
				else
				{
					$id= $_GET['id'];
					$_SESSION['total_medicine']=array();
					array_push($_SESSION['total_medicine'],$id,$units);
				}
					}
		else
		{
			echo '<br/> <div class="alert alert-danger" style="font-family: "Exo 2", sans-serif;">
  <strong>NOTE!-</strong> LOW STOCK!; </div>';

		}
}


if(isset($_SESSION['total_medicine']))
{
	?>
    
<hr/>


<div class="wrapper">


<div class="container-fluid showhead2"> <h4>ADDED MEDICINES TO SALE!<h4>  </div>

<div class="container-fluid table-holder">

<table align="center" class="table-responsive">
  <tr>
    <th scope="col">Sr.no</th>
    <th scope="col">Name</th>
    <th scope="col">Unit Price</th>
    <th scope="col">Quantity</th>
    <th scope="col">Total</th>
    <th scope="col">Delete</th>
  </tr>
<!--===============loop=====================-->
<?php

$count=count($_SESSION['total_medicine']);
$n=1;

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
    <td><a href="delete_medicine.php?medid=<?php echo $ct;?>">delete</a></td>
    
    
<?php
}
?>

<!--===============loop=====================-->
</table>

<form action="#" method="post" class="print-adjust">
<button type="submit" class="btn btn-primary" name="update">Print</button>
</form>


</div>
<?php  
}

?> 

</div>

<!-- ===========UPDATE RECORD=========--->

<?php
if(isset($_POST["update"]))
		{
			if(isset($_SESSION['total_medicine']))
			{
				
			$count=count($_SESSION['total_medicine']);
			
				for($ct=0;$ct<$count;$ct+=2)
				{
					$sr=$ct+1;
					$medid=$_SESSION['total_medicine'][$ct];
					$medunit=$_SESSION['total_medicine'][$sr];
					include("include/db.php");
					
					
					/* ========== SALE RECORD =========== */
					
					$fetch= "SELECT * FROM medicine_stock WHERE id= '$medid'";
					$re= mysql_query($fetch);
					$hold= mysql_fetch_array($re);
					
					$date_stock= $hold['stock_date'];
					$name_vendor= $hold['stock_vendor'];
					$name_med= $hold['medicine_name'];
					$pwr= $hold['power'];
					$no_block= $hold['block_no'];
					$no_rack= $hold['rack_no'];
					$unitcost= $hold['unit_cost'];
					$med_cost= $medunit * $unitcost;
					
					date_default_timezone_set("asia/calcutta");
					
					$sale_time= date("h:si:a");
					$sale_date= date("d-m-y");
					
	                $sale= "INSERT INTO sale_record (date,time,id_medicine,units_sale,stock_date,vendor_name,medicine,med_power,block_no,rack_no,unit_cost,medicine_cost) VALUES('$sale_date','$sale_time','$medid','$medunit','$date_stock','$name_vendor','$name_med','$pwr','$no_block','$no_rack','$unitcost','$med_cost')";
					
					mysql_query($sale);
					
				  /* ========== SALE RECORD =========== */

					
				 /* ========== UPDATE RECORD =========== */

					$selqry="select * from medicine_stock where id = ".$medid;
					$medres=mysql_query($selqry);
					$medres0=mysql_fetch_array($medres);
					$medunit=$medres0["medicine_unit"]-$medunit;
					$update="update medicine_stock set medicine_unit = '$medunit' where id = $medid";
					mysql_query($update);
					
				 /* ========== UPDATE RECORD =========== */
					
					
					?>
					<script>
							window.open("medicine_invoice.php","print");
							
					</script>
	<?php
				  } 
		} mysql_close($conn);}
?>

<!-- ===========UPDATE RECORD CLOSE=========--->

<form action="#" method="post" style="float:right; padding:1% 44.9%;">
<button type="submit" class="btn btn-primary" name="cancel">CANCEL ALL</button>
</form>

<?php
if(isset($_POST['cancel']))
{
unset($_SESSION['total_medicine']);
echo"<script> window.location.href='customer_medicine_sale.php';  </script>";	
}

?>

</div> </div>

<!-- footer  -->
<?php include("include/footer.php");   ?>
<!-- footer  -->


</div>

</body>
</html>





