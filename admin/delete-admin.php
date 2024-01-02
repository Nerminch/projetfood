<?php 
include ('../config/constants.php');
//get  the id admin
 $id = $_GET['id'];
//create sql delete
$sql ="DELETE FROM tbl_admin WHERE id=$id";
//execute query 
$res = mysqli_query($conn,$sql);
//msg succes

if($res==true){
	

//session
	$_SESSION['delete']="Admin deleted";
	//traj3k ll page
	header('location:'.SITEURL.'admin/manage-admin.php');

}else{
	$_SESSION['delete']="Failed!!!!!";

	header('location:'.SITEURL.'admin/manage-admin.php');
}









?>