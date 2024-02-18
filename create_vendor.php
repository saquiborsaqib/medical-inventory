<?php
session_start();
if(!isset($_SESSION['user']))
{echo'<script> window.location.href="login.php?msg=You Must Login First!"; </script>';}

$email= $_SESSION['user'];

$table_name="vendor_details";

$pagename="create_vendor.php";

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
<title>Vendor Creation Page</title>

</head>

<body>

<div class="wrapper">

<!-- header-->
<?php include("include/header.php");   ?>
<!-- header-->

<div class="wrapper holder">

<div class="container showhead1"> <h4> PLEASE CREATE VENDOR DETAILS! </h4>  </div> <hr/>

<?php
if(isset($_REQUEST['msg']))
{ ?>
<br/> <div class="alert alert-success" style="font-family: 'Exo 2', sans-serif;">
  <strong>NOTE!-</strong> <?php  echo $_REQUEST['msg']; ?> </div>
  <meta http-equiv="refresh" content="3; url=create_vendor.php" />
	
<?php }

if(isset($_REQUEST['warn']))
{
	?>
<br/> <div class="alert alert-danger" style="font-family: 'Exo 2', sans-serif;">
  <strong>NOTE!-</strong> <?php  echo $_REQUEST['warn']; ?> </div>
  <meta http-equiv="refresh" content="3; url=create_vendor.php" />

<?php } ?>

<div class="container">
<div class="col-md-2"> </div>
<div class="col-md-8 form-holder">

<form method="post" action="#">

<span class="input-span"> Vendor Name:- </span> <input type="text" name="ven_name" placeholder="vendor name"  class="input-float" required/>
<br/> <br/>

<span class="input-span"> Vendor Address:- </span> <input type="text" name="ven_add" placeholder="vendor address"  class="input-float" required/>
<br/> <br/>

<span class="input-span"> Vendor Contact No.:- </span> <input type="text" name="ven_contact" placeholder="vendor contact"  class="input-float" required/>
<br/> <br/>

<span class="sub-span"> <input type="submit" name="sub"/> </span> <input type="reset" name="reset" value="reset"/>

</form>

</div>
<div class="col-md-2"> </div>
</div>

<?php
if(isset($_POST['sub']))
{
	$vendorname= $_POST['ven_name'];
	$vendoradd= $_POST['ven_add'];
	$vendorcontact= $_POST['ven_contact'];

    include("include/db.php");
	
	$qry= "SELECT * FROM vendor_details WHERE vendor_name= '$vendorname'";
	$result= mysql_query($qry);
	$row= mysql_fetch_array($result);
	if($row)
	{?>
	
    <br/> <div class='alert alert-danger' style='font-family: 'Exo 2', sans-serif;'>
  <strong>NOTE!-</strong> <?php echo "THIS VENDOR ALREADY EXIST !"; ?> </div>
	<?php 		
	}
   else
   {
	$qry1="INSERT INTO vendor_details(vendor_name,vendor_address,vendor_contact)
	VALUES('$vendorname','$vendoradd','$vendorcontact')";
	
	$result1= mysql_query($qry1);
	
	if($result1)
	{ ?>
		<br/> <div class='alert alert-success' style='font-family: 'Exo 2', sans-serif;'>
  <strong>NOTE!-</strong> <?php echo "YOUR VENDOR IS SUCCESSFULLY CREATED"; ?> </div>
   <?php }
   
	else
	{ ?>
    <br/> <div class='alert alert-danger' style='font-family: 'Exo 2', sans-serif;'>
  <strong>NOTE!-</strong> <?php echo "YOUR VENDOR IS NOT SUCCESSFULLY CREATED"; ?> </div>
	<?php 	
	}  
      } 
	    }  ?>

<hr/>


<div class="wrapper">


<div class="container-fluid showhead2"> <h4>CREATED VENDOR!<h4>  </div>

<div class="container-fluid table-holder">

<table align="center" class="table-responsive">
  <tr>
    <th>SR NO.</th>
    <th>ID</th>
    <th>VENDOR NAME</th>
    <th>VENDOR ADDRESS</th>
    <th>VENDOR CONTACT</th>
    <th>EDIT</th>
    <th>DELETE</th>
  </tr>
  
  <?php
   $no= 1;
   
   include("include/db.php");
	
  $qry2= "SELECT * FROM vendor_details ORDER BY ID DESC ";
  
  $result2= mysql_query($qry2);
  while($row2= mysql_fetch_array($result2))
  {
  $id= $row2['id'];
  
  
echo"<tr>";
echo"<td>".$no++."."."</td>";
echo"<td>".$row2['id']."</td>";
echo"<td>".$row2['vendor_name']."</td>";
echo"<td>".$row2['vendor_address']."</td>";
echo"<td>".$row2['vendor_contact']."</td>";
echo"<td> <a href='edit_vendor.php?id=$id&&page_name=$pagename&&table_name=$table_name'> Edit </a> </td>";
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

