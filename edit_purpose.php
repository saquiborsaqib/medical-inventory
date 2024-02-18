<?php
session_start();

if(!isset($_SESSION['user']))
{echo'<script> window.location.href="login.php?warn=You Must Login First!"; </script>';
}
$user= $_SESSION['user'];
$pagename="edit_purpose.php";

if((!isset($_REQUEST['id']))&&(!isset($_REQUEST['page_name']))&&(!isset($_REQUEST['table_name'])))
{echo'<script> window.location.href="create_medicine_purpose.php?warn=You Cant Edit This Purpose!"; </script>';
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

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>update medicine Purpose</title>

</head>

<body>

<div class="wrapper">

<!-- header-->
<?php include("include/header.php");   ?>
<!-- header-->

<div class="wrapper holder">

<div class="container showhead1"> <h4> UPDATE MEDICINE PURPOSES! </h4>  </div> <hr/>

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

<?php

$id= $_REQUEST['id'];

include("include/db.php");

$qry= "SELECT * FROM medicine_purpose WHERE id= '$id'";

$result= mysql_query($qry);

$row= mysql_fetch_array($result);

?>

<table align="center" class="table-responsive">
  <tr>
    <th>ID</th>
    <th>CATEGORY NAME</th>
  </tr>
  
<form method="post" action="#">


<tr>

    <td> <?php echo $row['id']; ?> </td>
    <td> <input type="text" name="purname" placeholder="category name" value= "<?php echo $row['pur_name']; ?>" required/> </td>
	
</tr>

<tr>
<td colspan="1"> <input type="submit" name="sub"/>  </td>
<td colspan="1"> <input type="reset" name="sub"/>  </td>

</tr>

</form>

<?php
if(isset($_POST['sub']))
{
	$pur_name= $_POST['purname'];
	
	include("include/db.php");
	
     $load= mysql_query($seequery= "SELECT * FROM medicine_purpose WHERE pur_name= '$pur_name'");
	 $data= mysql_fetch_array($load);
	 
	 if($data)
	 {
		echo "<br/> <div class='alert alert-danger' style='font-family: 'Exo 2', sans-serif;'>
  <strong>NOTE!-</strong>  THIS PURPOSE NAME ALREADY EXIST! </div>";
	 }
	
	else
	{
	
	$qry="UPDATE medicine_purpose SET pur_name='$pur_name' WHERE id='$id'";
	
	$result= mysql_query($qry);
	
	if($result)
	{		
		echo '<script> window.location.href="create_medicine_purpose.php?msg=You Updated Purpose Successfully!"; </script>';
	}
	else
	{
		echo '<script> window.location.href="create_medicine_purpose.php?warn=Your Purpose Updated UnSuccessfully!"; </script>';
	}
	
} 
mysql_close($conn); }
?>

</div>

</table>
  
<hr/>
</div> 

<!-- footer  -->
<?php include("include/footer.php");   ?>
<!-- footer  -->

</div>

</body>
</html>

