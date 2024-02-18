<?php
session_start();
if(!isset($_SESSION['user']))
{echo '<script> window.location.href="login.php?warn=You Must Login First!"; </script>';}

if((!isset($_GET["id"])) && (!isset($_GET["page_name"])) && (!isset($_GET["table_name"])) )
{echo '<script> window.location.href="profile.php?warn=You Cannot DELETE This!"; </script>';}
$id= $_REQUEST['id'];
$page_name= $_REQUEST['page_name'];
$table_name= $_REQUEST['table_name'];
include("include/db.php");
$qry= "DELETE FROM $table_name WHERE id= $id";
$result= mysql_query($qry);
if($result){
	mysql_close($conn);
	echo "<script> window.location.href='$page_name?msg=Your Data Is Successfully DELETED!'; </script>";
}
else
{   
    mysql_close($conn);
	echo "<script> window.location.href='$page_name?warn=Your Data Is Not Successfully DELETED!'; </script>";
   
}
mysql_close($conn);
?>