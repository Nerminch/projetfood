<?php include('partials/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
<h1>Change Password</h1>

<br><br>

<?php

if(isset($_GET['id'])){

   $id=$_GET['id'];

}




 ?>
<form action="" method="POST">
   <table class="tbl-30">
   	<tr>
   		<td>Current Password:</td>
   	    <td>
   	    	<input type="Password" name="current_password" placeholder="Current Pasword">
   	    </td> 	
   	</tr>
   		<tr>
   		<td>new Password:</td>
   	    <td>
   	    	<input type="Password" name="new_password" placeholder="New Pasword">
   	    </td> 	
   	</tr>
	<tr>
   		<td>Confirm Password:</td>
   	    <td>
   	    	<input type="Password" name="confirm_password" placeholder="Confirm Pasword">
   	    </td> 	
   	</tr>
   	<tr>
   		<td colspan="2">
   			<input type="hidden" name="id" value="<?php echo $id; ?>">
   			<input type="submit" name="submit" value="Change Password" >
   		</td>
   	</tr>
   </table>



</form>
</div>
</div>


<?php 

if(isset($_POST['submit'])){

//get data
	$id=$_POST['id'];
    $current_password=$_POST['current_password'];
    $new_password=$_POST['new_password'];
    $confirm_password=$_POST['confirm_password'];

$sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
$res = mysqli_query($conn,$sql);
//msg succes

if($res==true){
	//data avalaible ou nn
	$count=mysqli_num_rows($res);

if($count==1){
	//get data
  
	if($new_password==$confirm_password){

	 $sql2= "UPDATE tbl_admin  SET 
	password='$new_password'
	WHERE id=$id
	";
	$res2= mysqli_query($conn , $sql2);

	if($res2==true){

    $_SESSION['change-pwd'] = "Password changed";
	header('location:'.SITEURL.'admin/manage-admin.php');



	}else{

    $_SESSION['change-pwd'] = "Password Not changed";
	header('location:'.SITEURL.'admin/manage-admin.php');

	}


	}

else{

   $_SESSION['pwd-not-match'] = "Password not match";
	header('location:'.SITEURL.'admin/manage-admin.php');
}

	
} else {
	$_SESSION['user-not-found'] = "User Not Found";
	header('location:'.SITEURL.'admin/manage-admin.php');

}}}

 ?>

<?php include('partials/footer.php'); ?>