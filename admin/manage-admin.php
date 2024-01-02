<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<style type="text/css">
.tbl-full{
	width: 100%;}

	table tr th{
	border-bottom: 1px solid  black;
	padding: 1%;
	text-align:left;  
}
table tr td{
	text-align: left;
	padding: 1%;
	
}
.btn-primary{
	background-color: #f5b7b1 ;
	padding: 1%;
	color: white;
	text-decoration: none;
	font-weight: bold;
}

.btn-mer{
	background-color: #BA94D1;
	padding: 1%;
	text-decoration: none;
	color: white;
	font-weight: bold;
}
.btn-mer:hover{
	background-color: #BA94D1;
}

.btn-secondary{
	background-color: #FF9F9F;
	padding: 1%;
	text-decoration: none;
	color: white;
	font-weight: bold;
}
.btn-secondary:hover{
	background-color: #FF9F9F;
}
.btn-three{
	background-color: #9E7676;
	padding: 1%;
	text-decoration: none;
	color: white;
	font-weight: bold;
}.btn-three:hover{
	background-color: #9E7676;
}
</style>
<body>


<?php include('partials/menu.php'); ?>



<div class="main-content">
<h1>Manager Admin</h1>
<br>
<?php

if(isset($_SESSION['add'])){ 
//ki tajouti yatlaa msg
	echo $_SESSION['add'];

	unset($_SESSION['add']); //ki trefrechi lpage ytnaha msg
}

if(isset($_SESSION['delete'])){ 
//ki tfaskh yatlaa msg
	echo $_SESSION['delete'];

	unset($_SESSION['delete']); //ki trefrechi lpage ytnaha msg
}
if(isset($_SESSION['update'])){ 
//ki tmodifi  yatlaa msg
	echo $_SESSION['update'];

	unset($_SESSION['update']); //ki trefrechi lpage ytnaha msg
}
if(isset($_SESSION['user-not-found'])){ 
//ki tmodifi  yatlaa msg
	echo $_SESSION['user-not-found'];

	unset($_SESSION['user-not-found']); //ki trefrechi lpage ytnaha msg
}

if(isset($_SESSION['pwd-not-match'])){ 
//ki tmodifi  yatlaa msg
	echo $_SESSION['pwd-not-match'];

	unset($_SESSION['pwd-not-match']); //ki trefrechi lpage ytnaha msg
}
if(isset($_SESSION['change-pwd'])){ 
//ki tmodifi  yatlaa msg
	echo $_SESSION['change-pwd'];

	unset($_SESSION['change-pwd']); //ki trefrechi lpage ytnaha msg
}

?>
<br><br>
<a href="add-admin.php" class="btn-mer"> Add Admin </a>
<br><br>
<table class="tbl-full">
	<tr>

		<th>S.N.</th>
        <th>Full name</th>
        <th>Username</th>
        <th> Actions </th>
    </tr>

    <br/><br/>

    <?php 
     
     $sql= "SELECT * FROM tbl_admin";
     $res= mysqli_query($conn , $sql);

    
     if($res==true){
     	$count = mysqli_num_rows($res); //taatina all ligne
    $sn=1; //tkhali id yzid
     	if($count>0){

       while($rows=mysqli_fetch_assoc($res)){ //nestaamlou while bch jnjibou les donnees kol

       	$id=$rows['id'];
       	$full_name=$rows['full_name'];
       	$username=$rows['username'];

       	?>
<tr>

     	<td><?php  echo $sn++ ?> </td> 
     	<td><?php  echo"$full_name"?></td> 
	    <td><?php  echo"$username"?></td>
	    <td>
	    	<a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-mer"> change password</a> 
	    	<a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
	    	<a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-three">Delete</a></td> 

    </tr>

       	<?php

       }
     	}
else{

}

     }

    ?>

   

</table>







</div>
</div>

	<?php include('partials/footer.php'); ?>

</body>
</html>