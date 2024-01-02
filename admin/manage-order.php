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
	<h1>Manage Order </h1>

	<table class="tbl-full">
	<tr>

		<th>S.N.</th>
        <th>Food</th>
        <th>Price</th>
        <th> Qty. </th>
        <th>Total</th>
        <th>Order date</th>
        <th>Status</th>
        <th> Customer name </th>
        <th> Customer contact </th>
        <th> Email</th>
        <th> Adress </th>
         <th> Action </th>
    </tr>


    <br/><br/>
    <?php 
     
     $sql= "SELECT * FROM tbl_order ORDER BY id DESC";
     $res= mysqli_query($conn , $sql);
     
     	$count = mysqli_num_rows($res); //taatina all ligne
    $sn=1; //tkhali id yzid
     	if($count>0){ 

       while($rows=mysqli_fetch_assoc($res)){ //nestaamlou while bch jnjibou les donnees kol

       	$id=$rows['id'];
       	$food=$rows['food'];
       	$price=$rows['price'];
       	$qty=$rows['qty'];
       	$total=$rows['total'];
       	$order_date=$rows['order_date'];
       	$status=$rows['status'];
       	$customer_name=$rows['customer_name'];
       	$customer_contact=$rows['customer_contact'];
       	$customer_email=$rows['customer_email'];
       	$customer_adress=$rows['customer_adress'];
       	?>
       	<tr>

     	<td> <?php  echo $sn++; ?></td> 
	    <td><?php  echo $food; ?></td> 
	    <td><?php  echo $price; ?></td> 
	    <td> <?php  echo $qty; ?></td> 
	    <td><?php  echo $total; ?></td> 
	    <td><?php  echo $order_date; ?></td>
	    <td><?php  echo $status; ?></td> 
	    <td><?php  echo $customer_name; ?></td> 
	    <td> <?php  echo $customer_contact; ?></td> 
	    <td><?php  echo $customer_email; ?></td> 
	    <td><?php  echo $customer_adress; ?></td>
	    <td><a href="update-order.php" class="btn-secondary">Update Order</a>
	    	</td> 
 
        </tr> 
       	<?php




       }
       
       }
  
    else{
       	echo "Failed!!";

     }
 
       	?>
 
</table>

</div>
</div>
<?php include('partials/footer.php'); ?>
</body>
</html>