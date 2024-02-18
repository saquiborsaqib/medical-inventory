<?php
session_start();
if(!isset($_SESSION['user']))
{echo'<script> window.location.href="login.php?warn=You Must Login First"; </script>';
}
$user= $_SESSION['user'];
$pagename= "stock_details.php";
$tablename= "medicine_stock";

if(!isset($_REQUEST['id']) && !isset($_REQUEST['page_name']))
{echo'<script> window.location.href="create_stock.php?warn=You Cant Reach Stock Details Page(Until New Stock Created)!"; </script>';
}

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
<script src="js/fetch_iupac.js" type="text/javascript"></script>

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
<title>Fill Stock Page</title>

</head>

<body>

<div class="wrapper">

<!-- header-->
<?php include("include/header.php");   ?>
<!-- header-->

<div class="wrapper holder">

<div class="container showhead1"> <h4> PLEASE ENTER MEDICINES UNDER THE STOCK CREATED! </h4>  </div> <hr/>

<?php
include("include/db.php");

$stock_id= $_REQUEST['id'];

$qry= "SELECT * FROM create_stock WHERE id= '$stock_id'";

$result= mysql_query($qry);
$row= mysql_fetch_array($result);

$stock_date= $row['stock_date'];
$stock_time= $row['stock_time'];
$stock_vendor= $row['stock_vendor'];
$sales_person= $row['sales_person'];
$vendor_pay= $row['ven_pay'];
$pay_mode= $row['pay_mode'];
$remark= $row['remark'];


$qry1= "SELECT * FROM  medicine_details";

$result1= mysql_query($qry1);

$qry2="SELECT * FROM vendor_details WHERE id= '$stock_vendor'";
$result2= mysql_query($qry2);
$row2= mysql_fetch_array($result2);
$vendorname= $row2['vendor_name'];

?>

<!-- alert-->
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

<div class="container">
<div class="col-md-2"> </div>
<div class="col-md-8 form-holder">

<form method="post" action="#">

<span class="input-span"> Stock Id:- </span> <input type="number" name="stockid" value="<?php echo $stock_id; ?>" class="input-float" readonly/>
<br/> <br/>

<span class="input-span"> Stock Reach Date:- </span> <input type="text" name="stockdate" value="<?php echo $stock_date; ?>"  class="input-float" readonly/>
<br/> <br/>

<span class="input-span"> Stock Vendor:- </span> <input type="text" name="stock_vendor" value="<?php echo $vendorname; ?>"  class="input-float" readonly/>
<br/> <br/>

<span class="input-span"> Sales Person:- </span> <input type="text" name="sales_person" value="<?php echo $sales_person; ?>"  class="input-float" readonly/>
<br/> <br/>

<span class="input-span"> Medicine Name:- </span> <select name="medicine_name" id="medicine" onchange="iupaccall(this.value)"  class="input-float" required="required"/>
<?php
         while($row1= mysql_fetch_array($result1))
		 {  
		    echo "<option>".$row1['med_name']."</option>";
          }
?>               
</select>
<br/> <br/>

<span class="input-span"> IUPAC Name:- </span> <select name="iupac" id="iupac_block"  class="input-float" required="required"/>
             
</select>
<br/> <br/>


<span class="input-span"> Medicine Power:- </span> <input type="text" name="power" placeholder="Medicine Power"  class="input-float" required/>
<br/> <br/>

<span class="input-span"> Manufacturing Date- </span> <input type="date" name="manufacture_date" placeholder="manufacturing date"  class="input-float" required/>
<br/> <br/>

<span class="input-span"> Expiry Date:- </span> <input type="date" name="expiry_date" placeholder="Expiry Date"  class="input-float" required/>
<br/> <br/>

<span class="input-span"> Block No.:- </span> <input type="text" name="block_no" placeholder="medicine Block No."  class="input-float" required/>
<br/> <br/>

<span class="input-span"> Rack No.:- </span> <input type="text" name="rack_no" placeholder="rack no."  class="input-float" required/>
<br/> <br/>

<span class="input-span"> Medicine Units:- </span> <input type="text" name="medicine_unit" id="unitmed"  placeholder="medicine units"  class="input-float" required/>
<br/> <br/>

<span class="input-span"> Cost Per Unit (in Rs):- </span> <input type="text" name="unit_cost" id="unitcost" placeholder="Cost per unit"  class="input-float" required/>
<br/> <br/>

<span class="input-span"> Total Cost (in Rs):- </span> <input type="text" name="total_cost" id= "totalcost"  placeholder="Total units cost" onclick="total()" class="input-float" required/>
<br/> <br/>

<span class="sub-span"> <input type="submit" name="sub"/> </span> <input type="reset" name="reset" value="reset"  class="input-float" />

</form>  

<form method="post" action="#">
<span class="sub-span"> <input type="submit" name="finish" value="FINISH"  class="input-float" /> </span>
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

$qry3= "INSERT INTO
medicine_stock(stock_id,stock_date,stock_vendor,sales_person,medicine_name,iupac,power,manufacture_date,expiry_date,block_no,rack_no,medicine_unit,unit_cost,total_cost)
VALUES('$stock_id','$stockdate','$stockvendor','$sales_person','$medicine','$iupac','$power','$manufacture_date','$expiry_date','$block','$rack','$medicine_unit','$unit_cost','$total_cost')";

$result3= mysql_query($qry3);

if($result3)
{ ?>
		<br/> <div class='alert alert-success' style='font-family: 'Exo 2', sans-serif;'>
  <strong>NOTE!-</strong> <?php echo "MEDICINE IS SUCCESSFULLY PUT INTO THE CREATED STOCK"; ?> </div>
  
   <?php }
   
	else
	{ ?>
    <br/> <div class='alert alert-danger' style='font-family: 'Exo 2', sans-serif;'>
  <strong>NOTE!-</strong> <?php echo "MEDICINE IS NOT SUCCESSFULLY PUT INTO THE CREATED STOCK"; ?> </div>
	<?php 	
	}  
}
?>

<?php
if(isset($_POST['finish']))
{
	
	echo "<script> window.location.href='create_stock.php?msg=YOUR STOCK CREATION IS SUCCESFULLY COMPLETED...CREATE NEXT';   </script>";	
}
?>

<hr/>

<div class="wrapper">

<div class="container-fluid showhead2"> <h4> STOCK DETAILS UNDER CREATED STOCK!<h4>  </div>

<div class="container-fluid table-holder">

<table align="center" class="table-responsive">

<th>SR NO.</th>
<th>STOCK ID</th>
<th>STOCK DATE</th>
<th>STOCK TIME</th>
<th>STOCK VENDOR</th>
<th>VENDOR SALES PERSON</th>
<th>REMARK</th>
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

<?php
$no= 1;
include("include/db.php");

$qry4= "SELECT * FROM medicine_stock ORDER BY id DESC";
$result4= mysql_query($qry4);

while($row4= mysql_fetch_array($result4))
{
	
$id= $row4['id'];

echo "<tr>";
echo "<td>".$no++."."."</td>";
echo "<td>".$row4['stock_id']."</td>";
echo "<td>".$row4['stock_date']."</td>";
echo "<td>".$stock_time."</td>";
echo "<td>".$row4['stock_vendor']."</td>";
echo "<td>".$row4['sales_person']."</td>";
echo "<td>".$remark."</td>";
echo "<td>".$row4['medicine_name']."</td>";
echo "<td>".$row4['iupac']."</td>";
echo "<td>".$row4['power']."</td>";
echo "<td>".$row4['manufacture_date']."</td>";
echo "<td>".$row4['expiry_date']."</td>";
echo "<td>".$row4['block_no']."</td>";
echo "<td>".$row4['rack_no']."</td>";
echo "<td>".$row4['medicine_unit']."</td>";
echo "<td>".$row4['unit_cost']."</td>";
echo "<td>".$row4['total_cost']."</td>";
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
