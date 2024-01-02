

<?php  include('partials/menu.php'); ?>


<div class="main-content">
	<div class="wrapper">
<h1>Add Food</h1>

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




?>
<br/><br/>
<br/>

<form action="" method="POST" enctype="multipart/form-data"> 

<table width="30%">
	<tr>
		<td>Title:</td>
		<td><input type="text" name="title" placeholder="Enter Title"></td>
	</tr>
	<tr>
		<td>Description:</td>
		<td><textarea name="description" cols="30" rows="5" placeholder="Description of the Food!"></textarea></td>
	</tr>
	<tr>
		<td>price:</td>
		<td><input type="number" name="price"></td>
	</tr>
	
	<tr>
		<td>Select Image:</td>
		<td><input type="file" name="image"  value="Choose File"> 
			
		</td>
	</tr>
	<tr>
		<td>Category:</td>
		<td>
			<select name="category">
				<?php 
                //create php code 
                //create sql to get all categorie active
                $sql="SELECT * FROM tbl_category WHERE active='Yes'";
                $res= mysqli_query($conn ,$sql);
                //ehseb rows bch tchof categ mwjoud wala 
                $count=mysqli_num_rows($res);
                if($count>0){

                    //3ana catg
                    while ($row=mysqli_fetch_assoc($res)) {
                    	//get details catg
                    	$id = $row['id'];
                    	$title = $row['title'];
                    	
                    	?>

                    	<option value="<?php echo $id;  ?>"><?php echo $title; ?></option>
                    	
                    	<?php

                    }

                } else{

                	//dont have catg
                	?>
                	<option value="0">No Category Found 
                	</option>
                	<?php
                }






				?>
				
			</select></td>
	</tr>
	<tr>
		<td>Featured:</td>
		<td><input type="radio" name="featured" value="Yes"> Yes
			<input type="radio" name="featured" value="No "> No
		</td>
	</tr>
	<tr>
		<td>Active:</td>
		<td><input type="radio" name="active" value="Yes"> Yes
			<input type="radio" name="active" value="No "> No
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<input type="submit" name="submit" value="Add Ctegory" class="btn-secondary" >
		</td> 
	</tr>
</table>



</form>




<?php 
//on va verifier submit cliquer ou nn
if(isset($_POST['submit'])){

   $title = $_POST['title'];
   $description = $_POST['description'];
   $price = $_POST['price'];
   $category = $_POST['category'];





   //for radio
   if(isset($_POST['featured'])){

   	//get value
   	$featured = $_POST['featured'];
   
   }else{
    $featured = "No";
   }

   if(isset($_POST['active'])){

   	//get value
   	$active = $_POST['active'];
   
   }else{
    $active = "No";
   }

//select image
  // print_r($_FILES['image']);

//die(); //break the code heere
   if(isset($_FILES['image']['name'])){
   	 //uploade img
  
   	$image_name=$_FILES['image']['name'];

   	if($image_name!=""){



 //auto rename l'image
   	//get l'extension(jpg , png, gif ..)
   	$ext=end(explode('.' , $image_name)); 

   	//rename image
   	$image_name = "Food_name_".rand(000,999).'.'.$ext; //Food_name_888.jpg


   	$source_path=$_FILES['image']['tmp_name'];
    $destination_path="../images/foods/".$image_name;
    //finally upload
    $upload=move_uploaded_file($source_path, $destination_path);
    //check w9t limage ysirlha upld w w9t la
        if($upload==false){
    	//masarch 
    	$_SESSION['upload']="Failed to upload!!";
    	header("location:".SITEURL.'admin/add-food.php');
    	die();

        }
    }




   
   else{
   	$image_name="";

   }



   $sql2=" INSERT INTO tbl_food SET 
   title='$title',
   description='$description',
   price=$price,
   image_name='$image_name',
   category_id= $category,
   featured='$featured',
   active='$active'";

$res2 = mysqli_query($conn , $sql2);
if($res2==TRUE){

//echo "Data Inserted!!" ;
//start session 
	$_SESSION['add']= "";
	header("location:".SITEURL.'admin/manage-food.php');
	
}
 else{
	$_SESSION['add']= " failed to add!!"; 
	header("location:".SITEURL.'admin/add-food.php'); }
	
	}
}

?>
</div>
</div>


<?php include('partials/footer.php'); ?>