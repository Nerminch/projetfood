<!DOCTYPE html>
<html>
<head>
	<title></title>
</head><style type="text/css">
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
	<div class="wapper">
	<h1>Manage Category </h1>
	<br/><br/>
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


if(isset($_SESSION['no-category-found'])){ 
//ki tfaskh yatlaa msg
	echo $_SESSION['no-category-found'];

	unset($_SESSION['no-category-found']); //ki trefrechi lpage ytnaha msg
}
if(isset($_SESSION['update'])){ 
//ki tfaskh yatlaa msg
	echo $_SESSION['update'];

	unset($_SESSION['update']); //ki trefrechi lpage ytnaha msg
}
if(isset($_SESSION['upload'])){ 
//ki tfaskh yatlaa msg
	echo $_SESSION['upload'];

	unset($_SESSION['upload']); //ki trefrechi lpage ytnaha msg
}
if(isset($_SESSION['failed-remove'])){ 
//ki tfaskh yatlaa msg
	echo $_SESSION['failed-remove'];

	unset($_SESSION['failed-remove']); //ki trefrechi lpage ytnaha msg
}
?>



<br/><br/>



	<a href="add-category.php" class="btn-mer"> Add Ctegory</a>
<br><br>
<table class="tbl-full">
	<tr>

		<th>S.N.</th>
        <th>Title</th>
        <th>Image</th>
        <th> Featured </th>
        <th> Active </th>
        <th> Actions</th>
    </tr>

    <br/><br/>

    <?php 
     
     $sql= "SELECT * FROM tbl_category";
     $res= mysqli_query($conn , $sql);

    
     if($res==true){
     	$count = mysqli_num_rows($res); //taatina all ligne
    $sn=1; //tkhali id yzid
     	if($count>0){

       while($rows=mysqli_fetch_assoc($res)){ //nestaamlou while bch jnjibou les donnees kol

       	$id=$rows['id'];
       	$title=$rows['title'];
       	$image_name=$rows['image_name'];
       	$featured=$rows['featured'];
       	$active=$rows['active'];

       	?>
<tr>

     	<td><?php  echo $sn++ ?> </td> 
     	<td><?php  echo"$title"?></td> 

	    <td>
	    	<?php 
              if($image_name!=""){

              	?>

              	<img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name ?>" width="100px" >
              	<?php

              }else{

                echo "Image not added!";
              }



	    	?>
	    	
	    </td>

	    <td><?php  echo"$featured"?></td> 
	    <td><?php  echo"$active"?></td>
	    <td>
	    	
	    	<a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
	    	<a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>" class="btn-three">Delete</a></td> 

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