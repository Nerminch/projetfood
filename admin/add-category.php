

<?php  include('partials/menu.php'); ?>


<div class="main-content">
	<div class="wrapper">
<h1>Add Category</h1>

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
		<td>Select Image:</td>
		<td><input type="file" name="image"  value="Choose File"> 
			
		</td>
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


</div>
</div>


<?php include('partials/footer.php'); ?>

<?php 
//on va verifier submit cliquer ou nn
if(isset($_POST['submit'])){

   $title = $_POST['title'];

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

 //auto rename l'image
   	//get l'extension(jpg , png, gif ..)
   	$ext=end(explode('.' , $image_name)); 

   	//rename image
   	$image_name = "Food_category_".rand(000,999).'.'.$ext; //Food_category_888.jpg


   	$source_path=$_FILES['image']['tmp_name'];
    $destination_path="../images/category/".$image_name;
    //finally upload
    $upload=move_uploaded_file($source_path, $destination_path);
    //check w9t limage ysirlha upld w w9t la
    if($upload==false){
    	//masarch 
    	$_SESSION['upload']="Failed to upload!!";
    	header("location:".SITEURL.'admin/add-category.php');
    	die();

    }else{
    	$_SESSION['upload']="Succes to upload!!";
    	header("location:".SITEURL.'admin/add-category.php');


    }



   }
   else{
   	$image_name="";

   }



   $sql=" INSERT INTO tbl_category SET 
   title='$title',
   image_name='$image_name',
   featured='$featured',
   active='$active'";

$res = mysqli_query($conn , $sql);
if($res==TRUE){

//echo "Data Inserted!!" ;
//start session 
	$_SESSION['add']= "";
	header("location:".SITEURL.'admin/manage-category.php');
	
}
 else{
	$_SESSION['add']= " failed to add!!"; 
	header("location:".SITEURL.'admin/add-category.php'); }
	}
?>