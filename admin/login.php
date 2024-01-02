<?php  include('../config/constants.php');?>
<html>
	<head>
		<title>Login-Food Order System</title>
	
		<link rel="stylesheet" type="text/css" href="../css/d.css">
		
	
	</head>
	<body>
	<div class="login">
		<h1 class="text-center"> login </h1>
		<br><br>
		<?php

if(isset($_SESSION['login'])){ 
//ki tajouti yatlaa msg
	echo $_SESSION['login'];

	unset($_SESSION['login']); //ki trefrechi lpage ytnaha msg
}
if(isset($_SESSION['no-login-message'])){ 
//ki tajouti yatlaa msg
	echo $_SESSION['no-login-message'];

	unset($_SESSION['no-login-message']); //ki trefrechi lpage ytnaha msg
}
?>
    <form action="" method="POST" class="text-center"> 
	 username : <br>
	<input type="text" name="username" placeholder="Enter Username"><br> <br>  
	Password:<br>

	<input type="password" name="password" placeholder="Enter Password">
	 <br><br>

	<input type="submit" name="submit" value="login" class="btn-primary"><br><br>


    </form>




		<p>   Created By - Tounsi Meriem </p>



	</div>	
	</body>
</html>
<?php 
//tenzel aala submit
if(isset($_POST['submit'])){

$username = $_POST['username'];
$password= $_POST['password'];

//sql requete
$sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
//exect sql
$res = mysqli_query($conn, $sql);

//user mawjoud wala
$count = mysqli_num_rows($res);



if($count==1){
	//mwjoud
	$_SESSION['login'] = "";
	$_SESSION['user'] = $username; //t9olk aaml log in wala tab9a authorisation
	header('location:'.SITEURL.'admin/index.php');

}else{
$_SESSION['login'] = "Login Failed";
	header('location:'.SITEURL.'admin/login.php');
}
}







?>