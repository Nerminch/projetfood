 <?php include('partials/menu.php'); ?>


<div class="main-content">
	<div class="wrapper">
<h1>Dashboard</h1>
<br><br>
<?php

if(isset($_SESSION['login'])){ 
//ki tajouti yatlaa msg 
	echo $_SESSION['login'];

	unset($_SESSION['login']); //ki trefrechi lpage ytnaha msg
}
?>
<div class="col-4 text-center">
	<?php 
	$sql = "SELECT * FROM tbl_category";
	$res = mysqli_query($conn,$sql);
	$count = mysqli_num_rows($res);


	 ?>
	<h1><?php echo $count;?></h1>
	Category
</div>
<div class="col-4 text-center">
	<?php 
	$sql1 = "SELECT * FROM tbl_food";
	$res1 = mysqli_query($conn,$sql1);
	$count1 = mysqli_num_rows($res1);


	 ?>
	<h1><?php echo $count1;?></h1>
	Food
</div>
<div class="col-4 text-center">
	<?php 
	$sql2 = "SELECT * FROM tbl_order";
	$res2 = mysqli_query($conn,$sql2);
	$count2 = mysqli_num_rows($res2);


	 ?>
	<h1><?php echo $count2;?></h1>
	Total order
</div>
<div class="col-4 text-center">
	<?php
    $sql4 =" SELECT SUM(total) AS total FROM tbl_order";
    $res4 = mysqli_query($conn,$sql4);
    $row4 = mysqli_fetch_assoc($res4);
    $total_revenue=$row4['total'];
	 ?>
	<h1><?php echo $total_revenue;?></h1>
	Revenu genrated
</div>
<div class="clearfix"></div>
</div>
</div>

<?php include('partials/footer.php'); ?>



	