<?php
$pagename= 'change_password.php';
session_start();
if(!isset($_SESSION['user']))
{
	echo "<script>  window.location.href='login.php?warn=You Must Login First!'  </script>";
}
$user= $_SESSION['user'];
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
<title>Change Password</title>

</head>

<body>

<div class="wrapper">

<!-- header-->
<?php include("include/header.php");   ?>
<!-- header-->

<div class="wrapper holder">

<div class="container showhead1"> <h4> Fill Below Details To Change Password! </h4>  </div> <hr/>

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

<div class="container-fluid">
<div class="col-md-2"> </div>
<div class="col-md-8 form-holder">


<form method="post" action="#">

<span class="input-span"> Enter Old Password:- </span> <input type="text" name="old_psw" placeholder="Old Password"  class="input-float" required/>
<br/> <br/>

<span class="input-span"> Enter New Password:- </span> <input type="text" name="new_psw" placeholder="New Password"  class="input-float" required/>
<br/> <br/>

<span class="input-span"> Confirm Password:- </span> <input type="text" name="confirm_psw" placeholder="Confirm Password"  class="input-float" required/>
<br/> <br/>

<span class="sub-span"> <input type="submit" name="sub"/> </span> <input type="reset" name="reset" value="reset"/>

</form>

</div>
<div class="col-md-2"> </div>
</div>

</br>

<?php
if(isset($_POST['sub']))
{
$old_psw= $_POST['old_psw'];
$new_psw= $_POST['new_psw'];
$confirm_psw= $_POST['confirm_psw'];

include("include/db.php");
	
$qry= "SELECT * FROM signup WHERE email= '$user' and psw= '$old_psw'";

$result= mysql_query($qry);

$row= mysql_fetch_array($result);

if($row)
{
	if($new_psw == $confirm_psw)
	{
		$qry1= "UPDATE signup SET psw='$confirm_psw' WHERE psw= '$old_psw'";
		$result1= mysql_query($qry1);
		
		if($result1)
		{
		echo "<div class='alert alert-success' style='font-family: 'Exo 2', sans-serif;'>
              <strong>NOTE!-</strong> YOUR PASSWORD IS CHANGED SUCCESSFULLY! </div>";  
			  }
		else
		{
			echo "<div class='alert alert-danger' style='font-family: 'Exo 2', sans-serif;'>
                  <strong>NOTE!-</strong> YOUR PASSWORD IS NOT CHANGED TRY AGAIN! </div>";
				  }
			}
		 else
		  {
			  echo "<div class='alert alert-danger' style='font-family: 'Exo 2', sans-serif;'>
                      <strong>NOTE!-</strong> NEW PASSWORD and CONFIRM PASSWORD DOESNOT MATCH! </div>";
					  }
        }

        else
           {
			   echo "<div class='alert alert-danger' style='font-family: 'Exo 2', sans-serif;'>
                     <strong>NOTE!-</strong> YOUR OLD PASSWORD IS WRONG! </div>";
				
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

