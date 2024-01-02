<?php  //autorisation

if(!isset($_SESSION['user'])){

//user madkhlch
	$_SESSION['no-login-message']  = "Please log in to access Admin Panel";
	header('location:'.SITEURL.'admin/login.php'); 
}


?>