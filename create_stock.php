<?php
session_start();
if(!isset($_SESSION['user']))
{echo'<script> window.location.href="login.php?warn=You Must Login First!"; </script>';}
$user= $_SESSION['user'];
$pagename= "create_stock.php";
$tablename= "create_stock";
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
<script src="js/fetch_sales_person.js" type="text/javascript"></script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Stock Creation Page</title>

</head>

<body>

<div class="wrapper">

<!-- header-->
<?php include("include/header.php");   ?>
<!-- header-->

<div class="wrapper holder">

<div class="container showhead1"> <h4> PLEASE CREATE STOCK DETAILS! </h4>  </div> <hr/>

<?php
if(isset($_REQUEST['msg']))
{ ?>
<div class="alert alert-success" style="font-family: 'Exo 2', sans-serif;">
  <strong>NOTE!-</strong> <?php  echo $_REQUEST['msg']; ?> </div>
    <meta http-equiv="refresh" content="4; url=create_stock.php" />

<?php }

if(isset($_REQUEST['warn']))
{
	?>
<div class="alert alert-danger" style="font-family: 'Exo 2', sans-serif;">
  <strong>NOTE!-</strong> <?php  echo $_REQUEST['warn']; ?> </div>
    <meta http-equiv="refresh" content="4; url=create_stock.php" />

<?php } ?>

<div class="container">
<div class="col-md-2"> </div>
<div class="col-md-8 form-holder">


<form method="post" action="#">

<span class="input-span"> Stock Reach Date:- </span> <input type="date" name="stock_date" placeholder="date of stock"  class="input-float" required/>
<br/> <br/>

<span class="input-span"> Stock Vendor :- </span> <select name="stock_vendor" id="vendor" onchange="showsales(this.value)" class="input-float" >

<?php 
include("include/db.php"); 
$qry="SELECT * FROM vendor_details ORDER BY ID DESC";
$result= mysql_query($qry);
while($row= mysql_fetch_array($result))
{ echo"<option value='".$row['id']."'>".$row['vendor_name']."</option>"; }
?>

</select>
<br/> <br/>

<span class="input-span"> Vendor Sales Person :- </span> <select name="sales_person" id="sales_space"  class="input-float" >
                      
</select>
<br/> <br/>

<span class="input-span"> Vendor Payment(In Rs):- </span> <input type="text" name="ven_pay" placeholder="vendor payment"  class="input-float" required/>
<br/> <br/>

<span class="input-span"> Vendor Payment Mode:- </span> <input type="text" name="pay_mode" placeholder="payment mode"  class="input-float" required/>
<br/> <br/>

<span class="input-span"> Remark:- </span> <input type="text" name="remark" placeholder="remark"  class="input-float" required/>
<br/> <br/>

<span class="input-span"> Description:- </span> <textarea name="descrip" placeholder="Description" class="input-float" >  </textarea>
<br/> <br/>


<span class="sub-span"> <input type="submit" name="sub"/> </span> <input type="reset" name="reset" value="reset"/>

</form>

</div>
<div class="col-md-2"> </div>
</div>

<?php
if(isset($_POST['sub']))
{
$stock_date= $_POST['stock_date'];
$stock_vendor_id= $_POST['stock_vendor'];
$sales_person= $_POST['sales_person'];
$ven_pay= $_POST['ven_pay'];
$pay_mode= $_POST['pay_mode'];
$remark= $_POST['remark'];
$descrip= $_POST['descrip'];

date_default_timezone_set("Asia/Calcutta");
$time= date("h:i:sa");
include("include/db.php");
	
$qry1= "INSERT INTO create_stock(stock_date,stock_time,stock_vendor,sales_person,ven_pay,pay_mode,remark,descrip) 
VALUES('$stock_date','$time','$stock_vendor_id','$sales_person','$ven_pay','$pay_mode','$remark','$descrip')";	
$result1= mysql_query($qry1);

$result2= mysql_query("SELECT id FROM create_stock ORDER BY ID DESC LIMIT 0,1");
$row2= mysql_fetch_array($result2);

if($row2)
{
$id2= $row2['id'];

echo "<script> window.location.href='stock_details.php?id=$id2&&page_name=$pagename&&msg=Stock is Successfully Inserted| Now Create Medicine Stock!'; </script>";
}
else
{
echo "<script> window.location.href='create_stock.php?warn=Stock is Not Successfully Inserted| Now Create Again!'; </script>";

} 
   
mysql_close($conn); } 
?>

<hr/>
</div> 

<!-- footer  -->
<?php include("include/footer.php");   ?>
<!-- footer  -->

</div>

</body>
</html>

