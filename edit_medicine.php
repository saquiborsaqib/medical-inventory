<?php
session_start();

if(!isset($_SESSION['user']))
{
echo'<script> window.location.href="login.php?warn=You Must Login First!"; </script>';
}
$user= $_SESSION['user'];
$pagename="edit_medicine.php";

if((!isset($_REQUEST['id']))&&(!isset($_REQUEST['page_name']))&&(!isset($_REQUEST['table_name'])))
{
echo'<script> window.location.href="create_medicine.php?warn=You Cant Edit This Medicine!"; </script>';
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
<script src="js/catfetch.js" type="text/javascript"></script>
<script src="js/purpsefetch.js" type="text/javascript"></script>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>update medicine page</title>

</head>

<body>

<div class="wrapper">

<!-- header-->
<?php include("include/header.php");   ?>
<!-- header-->

<div class="wrapper holder">

<div class="container showhead1"> <h4> UPDATE MEDICINES! </h4>  </div> <hr/>

<!-- alert -->
<?php
if(isset($_REQUEST['msg']))
{ ?>
<br/> <div class="alert alert-success" style="font-family: 'Exo 2', sans-serif;">
  <strong>NOTE!-</strong> <?php  echo $_REQUEST['msg']; ?> </div>
  <meta http-equiv="refresh" content="3; url=create_medicine.php" />


<?php }

if(isset($_REQUEST['warn']))
{
	?>
<br/> <div class="alert alert-danger" style="font-family: 'Exo 2', sans-serif;">
  <strong>NOTE!-</strong> <?php  echo $_REQUEST['warn']; ?> </div>
    <meta http-equiv="refresh" content="3; url=create_medicine.php" />

  
<?php } ?>
<!-- alert -->

<div class="container">
<div class="col-md-2"> </div>
<div class="col-md-8 form-holder">

<?php

$id= $_REQUEST['id'];

include("include/db.php");

$cqry= mysql_query("SELECT * FROM medicine_category");
$pqry= mysql_query("SELECT * FROM medicine_purpose");


$qry= "SELECT * FROM medicine_details WHERE id= '$id'";

$result= mysql_query($qry);
$row= mysql_fetch_array($result);

$pre_med= $row['med_name'];
$pre_iupac= $row['iupac'];


?>

<form method="post" action="#">

<span class="input-span"> Medicine Name:- </span> <input type="text" name="medname" value="<?php echo $row['med_name']; ?>" placeholder="Medicine Name"  required="required"/>
<br/> <br/>

<span class="input-span"> IUPAC Name:- </span> <input type="text" name="iupac" value="<?php echo $row['iupac']; ?>"  placeholder="Iupac Name" required="required"/>
<br/> <br/>

<span class="input-span"> Medicine Category:- </span> <select name="catname"   onchange="cat(this.value)" required="required">

<?php  while($crow= mysql_fetch_array($cqry))
{?>

<option value="<?php echo $crow['cat_name'];  ?>"> <?php echo $crow['cat_name'];  ?> </option>

<?php }
?>
</select>
<br/> <br/>

<span class="input-span"> Category ID:- </span> <select name="catid" id="showcat" >   </select>
<br/> <br/>

<span class="input-span"> Medicine Purpose:- </span> <select name="medpurpose"  onchange="purpse_id(this.value)" required="required">

<?php  while($prow= mysql_fetch_array($pqry))
{?>

<option value="<?php echo $prow['pur_name'];  ?>"> <?php echo $prow['pur_name'];  ?> </option>

<?php }
?>
</select>
<br/> <br/>

<span class="input-span"> Purpose ID:- </span> <select name="purposeid" id="showprpse" >   </select>
<br/> <br/>



<span class="input-span"> Manufacturer:- </span> <input type="text" name="facturer" value= "<?php echo $row['manufacturer']; ?>" placeholder="Manufacturer" required/>
<br/> <br/>

<span class="input-span"> Medicine Power- </span> <input type="text" name="power" value= "<?php echo $row['power']; ?>" placeholder="Power" required/>
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
	$catname= $_POST['catname'];
	$catid= $_POST['catid'];
	$medpurpose= $_POST['medpurpose'];
	$purposeid= $_POST['purposeid'];
	$facturer= $_POST['facturer'];
	$power= $_POST['power'];
	
	include("include/db.php");
	
	
	$qry= "SELECT * FROM medicine_details WHERE med_name= '$medname'";
	$result= mysql_query($qry);
	$row= mysql_fetch_array($result);
	if($row)
	{
		$qry1="UPDATE medicine_details SET med_name='$pre_med',iupac='$pre_iupac',cat_name='$catname',cat_id='$catid',med_purpose='$medpurpose',purpose_id='$purposeid',manufacturer='$facturer',power='$power' WHERE id='$id'";
	}
	else
	{
	$qry1="UPDATE medicine_details SET med_name='$medname',iupac='$iupac',cat_name='$catname',cat_id='$catid',med_purpose='$medpurpose',purpose_id='$purposeid',manufacturer='$facturer',power='$power' WHERE id='$id'";
	
	}
	$result1= mysql_query($qry1);
	
	if($result1)
	{		
		echo '<script> window.location.href="create_medicine.php?msg=YOUR MEDICINE IS SUCCESSFULLY UPDATED !"; </script>';
	}
	else
	{
		echo '<script> window.location.href="create_medicine.php?warn=YOUR MEDICINE UPDATED UNSUCCESSFULL !"; </script>';
	}

    	mysql_close($conn);
}
	
?>

  
<hr/>
</div> 

<!-- footer  -->
<?php include("include/footer.php");   ?>
<!-- footer  -->

</div>

</body>
</html>

