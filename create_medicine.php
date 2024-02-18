<?php
session_start();
if(!isset($_SESSION['user']))
{echo'<script> window.location.href="login.php?warn=You Must Login First!"; </script>';}
$user= $_SESSION['user'];

$table_name="medicine_details";
$pagename="create_medicine.php";
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


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Medicine Creation Page</title>

</head>

<body>

<div class="wrapper">

<!-- header-->
<?php include("include/header.php");   ?>
<!-- header-->

<div class="wrapper holder">

<div class="container showhead1"> <h4> PLEASE CREATE MEDICINE! </h4>  </div> <hr/>

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

<div class="container">
<div class="col-md-2"> </div>
<div class="col-md-8 form-holder">

<?php

include("include/db.php");

$qry1= "SELECT * FROM medicine_category";
$result1= mysql_query($qry1);

$qry2= "SELECT * FROM medicine_purpose";
$result2= mysql_query($qry2);

?>

<form method="post" action="#">

<span class="input-span"> Medicine Name:- </span> <input type="text" name="medname" placeholder="medicine name"  class="input-float" required/>
<br/> <br/>

<span class="input-span"> IUPAC Name:- </span> <input type="text" name="iupac" placeholder="IUPAC name"  class="input-float" required/>
<br/> <br/>

<span class="input-span"> Medicine Category:- </span> <select name="catname" class="input-float" >
<?php 
while($row1= mysql_fetch_array($result1))
{
	echo "<option value=".$row1['id'].">".$row1['cat_name']."</option>";
}
?>
</select>
<br/> <br/>

<span class="input-span"> Medicine Purpose:- </span> <select name="medpurpose" class="input-float" >
<?php 
while($row2= mysql_fetch_array($result2))
{
	echo "<option value=".$row2['id'].">".$row2['pur_name']."</option>";
}
?>
</select>
<br/> <br/>

<span class="input-span"> Manufacturer Name:- </span> <input type="text" name="facturer" placeholder="manufacturer"  class="input-float" required/>
<br/> <br/>

<span class="input-span"> Power/Quantity:- </span> <input type="text" name="power" placeholder="medicine power"  class="input-float" required="required" />
<br/> <br/>


<span class="sub-span"> <input type="submit" name="sub"/> </span> <input type="reset" name="reset" value="reset"/>

</form>
</div>
<div class="col-md-2"> </div>
</div>

<?php
if(isset($_POST['sub']))
{
	
	$medname= $_POST['medname'];
	$iupac= $_POST['iupac'];
	$cat_id= $_POST['catname'];
	$purpose_id= $_POST['medpurpose'];
	$facturer= $_POST['facturer'];
	$power= $_POST['power'];
	
	include("include/db.php");
	
	$qry3= "SELECT cat_name FROM medicine_category WHERE id='$cat_id'";
	
	$result3= mysql_query($qry3);
	$row3= mysql_fetch_array($result3);
	
	$catname= $row3['cat_name'];
	
	$qry4= "SELECT pur_name FROM medicine_purpose WHERE id='$purpose_id'";
	
	$result4= mysql_query($qry4);
	$row4= mysql_fetch_array($result4);
	
	$purpose_name= $row4['pur_name'];
	
	$qry5= "SELECT * FROM medicine_details WHERE med_name= '$medname'";
	$result5= mysql_query($qry5);
	$row5= mysql_fetch_array($result5);
	
	if($row5){
		
		echo "<div class='alert alert-danger' style='font-family: 'Exo 2', sans-serif;'>
  <strong>NOTE!-</strong>  THIS MEDICINE ALREADY EXIST! </div>";
  
	}
	else
	{
	$qry6="INSERT INTO medicine_details(med_name,iupac,cat_name,cat_id,med_purpose,purpose_id,manufacturer,power) VALUES('$medname','$iupac','$catname','$cat_id','$purpose_name','$purpose_id','$facturer','$power')";
	
	$result= mysql_query($qry6);
	
	if($result)
	echo "<br/> <div class='alert alert-success' style='font-family: 'Exo 2', sans-serif;'>
  <strong>NOTE!-</strong>  YOUR MEDICINE IS SUCCESSFULLY CREATED! </div>";
		
	else
		echo  "<br/> <div class='alert alert-danger' style='font-family: 'Exo 2', sans-serif;'>
  <strong>NOTE!-</strong>  YOUR MEDICINE IS NOT SUCCESSFULLY CREATED! </div>";
  
   }
}

?>

<hr/>


<div class="wrapper">


<div class="container-fluid showhead2"> <h4>CREATED MEDICINES!<h4>  </div>

<div class="container-fluid table-holder">

<table align="center" class="table-responsive">
  <tr>
    <th>SR NO.</th>
    <th>ID</th>
    <th>MEDICINE NAME</th>
    <th>IUPAC NAME</th>
    <th>MEDICINE CATEGORY</th>
    <th>CATEGORY ID</th>
    <th>MEDICINE PURPOSE</th>
    <th>PURPOSE ID</th>
    <th>MANUFACTURER</th>
    <th>MEDICINE POWER</th>
    <th>EDIT</th>
    <th>DELETE</th>
  </tr>
  
  <?php
   $no= 1;
   
    include("include/db.php");
	
  $qry6= "SELECT * FROM  medicine_details ORDER BY ID DESC";
  
  $result6= mysql_query($qry6);
  while($row6= mysql_fetch_array($result6))
  {
  $id= $row6['id'];
  
  
echo"<tr>";
echo"<td>".$no++."."."</td>";
echo"<td>".$row6['id']."</td>";
echo"<td>".$row6['med_name']."</td>";
echo"<td>".$row6['iupac']."</td>";
echo"<td>".$row6['cat_name']."</td>";
echo"<td>".$row6['cat_id']."</td>";
echo"<td>".$row6['med_purpose']."</td>";
echo"<td>".$row6['purpose_id']."</td>";
echo"<td>".$row6['manufacturer']."</td>";
echo"<td>".$row6['power']."</td>";
echo"<td> <a href='edit_medicine.php?id=$id&&page_name=$pagename&&table_name=$table_name'> Edit </a> </td>";
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

