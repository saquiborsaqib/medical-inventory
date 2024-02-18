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
        <link href="css/login_style.css" rel="stylesheet">

		<!-- Custom css --> 
		<link href="css/custom.css" rel="stylesheet">
        
        <!-- styling css --> 
        <link href="css/styling.css" rel="stylesheet" type="text/css">
  
  
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>
<script src="js/npm.js" type="text/javascript"></script>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login Page</title>


</head>

<body>
<div class="wrapper">
<!-- header start -->
		<!-- ================ --> 
		<header class="header fixed clearfix navbar navbar-fixed-top" style="background:#b5ae63;">
			<div class="container">
				<div class="row">
					<div class="col-md-4">

						<!-- header-left start -->
						<!-- ================ -->
						<div class="header-left clearfix">

							<!-- logo -->
							<div class="logo smooth-scroll">
								<a href="#banner"><img id="logo" src="images/logo-image.png" alt="Medicalhub"></a>
							</div>

							<!-- name-and-slogan -->
							<div class="site-name-and-slogan smooth-scroll">
								<div class="site-name"><a href="#">Medicalhub</a></div>
								<div class="site-slogan">INVENTORY by <a target="_blank" href="#">Fidaato</a></div>
							</div>

						</div>
						<!-- header-left end -->

					</div>
                    <div class="col-md-8" style="font-family: 'Raleway', sans-serif; font-size:1.9em; padding:1% 6%;">
                    Welcome to MEDICALHUB INVENTORY!
                    
                    </div>
					
				</div>
			</div>
		</header>
		<!-- header end -->
<div class="login-holder" > </div>

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


    <div class="box">
    <form method="post" action="#">
    <div class="tag">LOGIN!</div> <br/>
    <div>Please Login To Enter To MEDICALHUB INVENTORY!!!</div>
    <div>
      <input type="email" name="email"  placeholder="Email*" required/>
    </div>
    <div>
      <input type="password" name="psw"  placeholder="Password*" maxlength="15" required/>
    </div>
    <div>
      <button type="submit" name="login" class="btn">SUBMIT</button>
    </div>
  </form>

  <?php
			if(isset($_POST["login"]))
			{
				
				$email= mysql_real_escape_string($_POST['email']);
			    $psw= $_POST['psw'];
				include("include/db.php");	
				
				$qry="SELECT * FROM signup WHERE email='$email' and psw='$psw'";
				
				$result= mysql_query($qry);
				$row= mysql_fetch_array($result);			
				
				if($row)
				{
					session_start();
					$_SESSION['user']= $email;
					mysql_close($conn);
					echo"<script>window.location.href='index.php';</script>";
				}
				
				else
				{
					mysql_close($conn);
					echo"<script>window.location.href='login.php?warn=Please Enter Valid Login Details!';</script>";
					
				}
				mysql_close($conn);
			}
			?>  </div>
    
<!-- footer  -->            
<div style="margin-top:3.8em;"> <?php include("include/footer.php");?> </div>
<!-- footer  -->

</div>

</body>
</html>
