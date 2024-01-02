
<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Update Food</h1>
  

    
</div></div>
<form action="" method="POST">
	<table class="tbl-30">
				<tr>
					<td> Food Name:</td>
					
				
				</tr>
				<tr>
					<td> Price:</td>
					
				
				
				</tr>
					<tr>
					<td> Qty:</td>
					<td>
					<input type="number" name="qty" value="<?php  echo $qty;?>"> </td>
					
				</tr>
				<tr>
					<td> Status:</td>
					<td>
					<select name="status">
						<option value="ordered">Ordered</option>
						<option value="on delivery">On Delivery</option>
						<option value="delivered">Delivered</option>
						<option value="cancelled">Cancelled</option>

						
					</select> </td>
					<tr>
					<td> Customer Name:</td>
					<td>
					<input type="text" name="customer_name" value=""> </td>
					
				</tr>
				<tr>
					<td> Customer Contact:</td>
					<td>
					<input type="text" name="customer_contact" value=""> </td>
					
				</tr>
				<tr>
					<td> Customer Email:</td>
					<td>
					<input type="text" name="customer_email" value=""> </td>
					
				</tr>
				<tr>
					<td> Customer Adress:</td>
					<td>
					<textarea  name="customer_adress" cols="30" rows="5"></textarea>  </td>
					
				</tr>


					<tr>
					
					<td colspan="2">
					<input type="hidden"  name ="id" value=" <?php  echo $id;?>"> 
					<input type="submit" name="submit" value="Update" class="btn-secondar"> </td>
					
				</tr>
				
			</table>
		</form>



<?php include('partials/footer.php'); ?>