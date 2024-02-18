<?php
session_start();
if(!isset($_SESSION['user']))
{echo'<script> window.location.href=login.php?warn=You Must Login First!"; </script>';}

$email= $_SESSION['user'];
$table_name="medicine_purpose";
$pagename="create_medicine_purpose.php";

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
<title>Medicine Purpose</title>

</head>

<body>

<div class="wrapper">

<!-- header-->
<?php include("include/header.php");   ?>
<!-- header-->

<div class="wrapper holder">

<div class="container showhead1"> <h4> PLEASE CREATE MEDICINE PURPOSE! </h4>  </div> <hr/>

<?php
if(isset($_REQUEST['msg']))
{ ?>
<br/> <div class="alert alert-success" style="font-family: 'Exo 2', sans-serif;">
  <strong>NOTE!-</strong> <?php  echo $_REQUEST['msg']; ?> </div>
	<meta http-equiv="refresh" content="3; url=create_medicine_purpose.php">
    
<?php }

if(isset($_REQUEST['warn']))
{
	?>
<br/> <div class="alert alert-danger" style="font-family: 'Exo 2', sans-serif;">
  <strong>NOTE!-</strong> <?php  echo $_REQUEST['warn']; ?> </div>
	<meta http-equiv="refresh" content="3; url=create_medicine_purpose.php">
    
<?php } ?>

<div class="container">
<div class="col-md-2"> </div>
<div class="col-md-8 form-holder">
<form method="post" action="#">

<span class="input-span"> Purpose Name:- </span> <input type="text" name="pur_name" placeholder="purpose name" required/>
<br/> <br/>

<span class="sub-span"> <input type="submit" name="sub"/> </span> <input type="reset" name="reset" value="Reset"/>

</form>
</div>
<div class="col-md-2"> </div>
</div>

<?php
if(isset($_POST['sub']))
{
	$purpose_name= $_POST['pur_name'];
	
	include("include/db.php");
	
	$load= mysql_query($seeqry= "SELECT * FROM medicine_purpose WHERE pur_name= '$purpose_name'");
	$data= mysql_fetch_array($load);
	
	if($data)
	{
		echo  "<br/> <div class='alert alert-danger' style='font-family: 'Exo 2', sans-serif;'>
  <strong>NOTE!-</strong> THIS PURPOSE IS ALREADY EXIST ! </div>";
    }
	else
	{
	$qry="INSERT INTO medicine_purpose(pur_name) VALUES('$purpose_name')";
	
	$result= mysql_query($qry);
	
	if($result)
	
		echo "<br/> <div class='alert alert-success' style='font-family: 'Exo 2', sans-serif;'>
  <strong>NOTE!-</strong>  YOUR PURPOSE IS SUCCESSFULLY CREATED </div>";
		
	else
		echo  "<br/> <div class='alert alert-danger' style='font-family: 'Exo 2', sans-serif;'>
  <strong>NOTE!-</strong>  YOUR PURPOSE IS SUCCESSFULLY CREATED </div>";
}
}
?>

<hr/>


<div class="wrapper">


<div class="container-fluid showhead2"> <h4>CREATED PURPOSES!<h4>  </div>

<div class="container-fluid table-holder">

<table align="center" class="table-responsive">
  <tr>
    <th>SR NO.</th>
    <th>ID</th>
    <th>PURPOSE NAME</th>
    <th>EDIT</th>
    <th>DELETE</th>
  </tr>
  
  
  <?php
   $no= 1;
   
    include("include/db.php");
	
  $qry= "SELECT * FROM medicine_purpose ORDER BY ID DESC";
  
  $result1= mysql_query($qry);
  while($row= mysql_fetch_array($result1))
  {
  $id= $row['id'];
  
  
echo"<tr>";
echo"<td>".$no++."."."</td>";
echo"<td>".$row['id']."</td>";
echo"<td>".$row['pur_name']."</td>";
echo"<td> <a href='edit_purpose.php?id=$id&&page_name=$pagename&&table_name=$table_name'> Edit </a> </td>";
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