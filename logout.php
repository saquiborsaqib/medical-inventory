<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>logout user</title>
</head>

<body>

<?php

session_start();
if(!isset($_SESSION['user']))
{
	
echo'<script> window.location.href="login.php?warn=You Must Login First"; </script>';
}
else
{
session_unset('user');
echo'<script> window.location.href="login.php?msg=You have successfully LOGOUT!"; </script>';	
}
?>


</body>
</html>