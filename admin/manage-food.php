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
	background-color: #7ed6df;
	padding: 1%;
	color: white;
	text-decoration: none;
	font-weight: bold;
}

.btn-mer{
	background-color: #8D9EFF;
	padding: 1%;
	text-decoration: none;
	color: white;
	font-weight: bold;
}
.btn-mer:hover{
	background-color: #9ED5C5;
}
.btn-secondary{
	background-color: #e056fd;
	padding: 1%;
	text-decoration: none;
	color: white;
	font-weight: bold;
}
.btn-secondary:hover{
	background-color: #be2edd;
}
.btn-three{
	background-color: #ffbe76;
	padding: 1%;
	text-decoration: none;
	color: white;
	font-weight: bold;
}.btn-three:hover{
	background-color: #ff7979;
}
</style>
<body>


<?php include('partials/menu.php'); ?>


<div class="main-content">
	<div class="wapper">
	<h1>Manage food </h1>
	<br/><br/>
	<a href="add-food.php" class="btn-mer"> Add Food </a>

	<?php
if(isset($_SESSION['add'])){ 
//ki tajouti yatlaa msg
	echo $_SESSION['add'];

	unset($_SESSION['add']); //ki trefrechi lpage ytnaha msg
}
if(isset($_SESSION['upload'])){ 
//ki tajouti yatlaa msg
	echo $_SESSION['upload'];

	unset($_SESSION['upload']); //ki trefrechi lpage ytnaha msg
}
if(isset($_SESSION['no-food-found'])){ 
//ki tajouti yatlaa msg
	echo $_SESSION['no-food-found'];

	unset($_SESSION['no-food-found']); //ki trefrechi lpage ytnaha msg
}
if(isset($_SESSION['failed-remove'])){ 
//ki tfaskh yatlaa msg
	echo $_SESSION['failed-remove'];

	unset($_SESSION['failed-remove']); //ki trefrechi lpage ytnaha msg
}
if(isset($_SESSION['update'])){ 
//ki tfaskh yatlaa msg
	echo $_SESSION['update'];

	unset($_SESSION['update']); //ki trefrechi lpage ytnaha msg
}
?>

<br/><br/>

<table class="tbl-full">
	<tr>

		<th>S.N.</th>
        <th>Title</th>
        <th>Description</th>
        <th>Price</th>
        <th>Image</th>
        <th> Featured </th>
        <th> Active </th>
        <th> Actions</th>
    </tr>

    <br/><br/>

    <?php 
     
     $sql= "SELECT * FROM tbl_food";
     $res= mysqli_query($conn , $sql);

    
     if($res==true){
     	$count = mysqli_num_rows($res); //taatina all ligne
    $sn=1; //tkhali id yzid
     	if($count>0){

       while($rows=mysqli_fetch_assoc($res)){ //nestaamlou while bch jnjibou les donnees kol

       	$id=$rows['id'];
       	$title=$rows['title'];
       	$description=$rows['description'];
       	$price=$rows['price'];
       	$image_name=$rows['image_name'];
       	$featured=$rows['featured'];
       	$active=$rows['active'];

       	?>
<tr>

     	<td><?php  echo $sn++ ?> </td> 
     	<td><?php  echo"$title"?></td>
     	<td><?php  echo"$description"?></td>  
     	<td><?php  echo"$price"?></td>  

	    <td>
	    	<?php 
              if($image_name!=""){

              	?>

              	<img src="<?php echo SITEURL; ?>images/foods/<?php echo $image_name ?>" width="100px" >
              	<?php

              }else{

                echo "Image not added!";
              }



	    	?>
	    	
	    </td>

	    <td><?php  echo"$featured"?></td> 
	    <td><?php  echo"$active"?></td>
	    <td>
	    	
	    	<a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
	    	<a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>" class="btn-three">Delete</a></td> 

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