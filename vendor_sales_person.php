<?php
session_start();
if(!isset($_SESSION['user']))
{echo'<script> window.location.href="login.php?warn=You Must Login First!"; </script>';}

$email= $_SESSION['user'];

$table_name="vendor_sales_person";
$pagename="vendor_sales_person.php";

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
<title>Sales Person Creation</title>

</head>

<body>

<div class="wrapper">

<!-- header-->
<?php include("include/header.php");   ?>
<!-- header-->

<div class="wrapper holder">

<div class="container showhead1"> <h4> PLEASE CREATE VENDOR SALES PERSON DETAILS! </h4>  </div> <hr/>

<!-- message-->
<?php
if(isset($_REQUEST['msg']))
{ ?>
<div class="alert alert-success" style="font-family: 'Exo 2', sans-serif;">
  <strong>NOTE!-</strong> <?php  echo $_REQUEST['msg']; ?> </div>
<meta http-equiv="refresh" content="3; url= vendor_sales_person.php" />
<?php }

if(isset($_REQUEST['warn']))
{
	?>
<div class="alert alert-danger" style="font-family: 'Exo 2', sans-serif;">
  <strong>NOTE!-</strong> <?php  echo $_REQUEST['warn']; ?> </div>
<meta http-equiv="refresh" content="3; url= vendor_sales_person.php" />

<?php } ?>

<!-- message -->

<?php

include("include/db.php");

$qry= "SELECT * FROM vendor_details";

$result= mysql_query($qry);


?>

<div class="container">
<div class="col-md-2"> </div>
<div class="col-md-8 form-holder">

<form method="post" action="#">

<span class="input-span"> Vendor Name:- </span> <select name="vendor_name"  class="input-float" required/>

<?php

while($row= mysql_fetch_array($result))
{
echo "<option value=".$row['id'].">".$row['vendor_name']."</option>";	
}

?>
</select>
<br/> <br/>

<span class="input-span"> Sales Person Name:- </span> <input type="text" name="sales_person" placeholder="sales person"  class="input-float" required/>
<br/> <br/>


<span class="input-span"> Contact No.:- </span>  <input type="text" name="contact" placeholder="Contact No." class="input-float"  required/>
<br/> <br/>


<span class="sub-span"> <input type="submit" name="sub"/> </span> <input type="reset" name="reset" value="reset"/>

</form>

</div>
<div class="col-md-2"> </div>
</div>

<?php
if(isset($_POST['sub']))
{
	$vendor_id= $_POST['vendor_name'];
	$sales_person= $_POST['sales_person'];
	$contact= $_POST['contact'];
	
    include("include/db.php");
	
	$qry1= "SELECT * FROM vendor_details WHERE id='$vendor_id'";
	
	
	$result1= mysql_query($qry1);
	$row1= mysql_fetch_array($result1);
	
	$vendor_name= $row1['vendor_name'];
	
	$vqry= "SELECT * FROM vendor_sales_person WHERE vendor_id= '$vendor_id' and sales_person= '$sales_person'";
	$vresult= mysql_query($vqry);
	$vrow= mysql_fetch_array($vresult);
	if($vrow)
	{?>
	
    <br/> <div class='alert alert-danger' style='font-family: 'Exo 2', sans-serif;'>
  <strong>NOTE!-</strong> <?php echo "THIS SALES PERSON ALREADY EXIST !"; ?> </div>
	<?php 		
	}
   else
   {

	$qry2="INSERT INTO vendor_sales_person(vendor_id,vendor_name,sales_person,mobile_no)
	VALUES('$vendor_id','$vendor_name','$sales_person','$contact')";
	
	$result2= mysql_query($qry2);
	
	if($result2)
	{ ?>
		<br/> <div class='alert alert-success' style='font-family: 'Exo 2', sans-serif;'>
  <strong>NOTE!-</strong> <?php echo "YOUR SALES PERSON IS SUCCESSFULLY CREATED"; ?> </div>
   <?php }
   
	else
	{ ?>
   <br/> <div class='alert alert-danger' style='font-family: 'Exo 2', sans-serif;'>
  <strong>NOTE!-</strong> <?php echo "YOUR SALES PERSON IS NOT SUCCESSFULLY CREATED"; ?> </div>
	<?php 	
	}  
   } }  ?>

<hr/>

<div class="wrapper">
<div class="container-fluid showhead2"> <h4> CREATED SALES PERSONS!<h4>  </div>
<div class="container-fluid table-holder">

<table align="center" class="table-responsive">
  <tr>
    <th>SR NO.</th>
    <th>VENDOR ID</th>
    <th>VENDOR NAME</th>
    <th>SALES PERSON NAME</th>
    <th>SALES PERSON CONTACT</th>
    <th>EDIT</th>
    <th>DELETE</th>
  </tr>
  
  <?php
   $no= 1;
   
   include("include/db.php");
	
   $qry3= "SELECT * FROM vendor_sales_person ORDER BY ID DESC";
  
  $result3= mysql_query($qry3);
  while($row3= mysql_fetch_array($result3))
  {
	  $id= $row3['id'];
	  
echo"<tr>";
echo"<td>".$no++."."."</td>";
echo"<td>".$row3['vendor_id']."</td>";
echo"<td>".$row3['vendor_name']."</td>";
echo"<td>".$row3['sales_person']."</td>";
echo"<td>".$row3['mobile_no']."</td>";
echo"<td> <a href='edit_sales_person.php?id=$id&&page_name=$pagename&&table_name=$table_name'> Edit </a> </td>";
echo"<td> <a href='delete.php?id=$id&&table_name=$table_name&&page_name=$pagename'> Delete </a> </td>";
echo"</tr>";

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
