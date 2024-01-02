<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Update Category</h1>

    <br><br>
<?php 
 //get id
if (isset($_GET['id'])){
  $id = $_GET['id'];

//sql
   $sql ="SELECT * FROM tbl_category WHERE id=$id";
//execute query 
$res = mysqli_query($conn,$sql);
//msg succes

  //data avalaible ou nn
  $count= mysqli_num_rows($res);

if($count==1){
  //get data
 //echo "admin";
  $row=mysqli_fetch_assoc($res);
  $title = $row['title'];
  $current_image = $row['image_name'];
  $featured = $row['featured'];
  $active = $row['active'];

} else {
  $_SESSION['no-category-found']="category not found!";
   header('location:'.SITEURL.'admin/manage-category.php');
  
}}
else{
  header('location:'.SITEURL.'admin/manage-category.php');

}
?>
   <form action="" method="POST" enctype="multipart/form-data">

      <table width="30%">
        <tr>
          <td>Title:</td>
          <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
        </tr>

        <tr>
          <td>Current Image:</td>
          <td>

            <?php
            if ($current_image != "") {
            ?>
              <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
            <?php
            }
            ?>

          </td>
        </tr>
        <tr>
          <td>New Image:</td>
          <td><input type="file" name="image"></td>
        </tr>
        <tr>
          <td>Featured:</td>
          <td><input <?php if ($featured == "Yes") {
                          echo "checked";
                        } ?> type="radio" name="featured" value="Yes"> Yes
            <input <?php if ($featured == "No") {
                      echo "checked";
                    } ?> type="radio" name="featured" value="No"> No
          </td>
        </tr>
        <tr>
          <td>Active:</td>
          <td><input <?php if ($active == "Yes") {
                          echo "checked";
                        } ?> type="radio" name="active" value="Yes"> Yes
            <input <?php if ($active == "No") {
                      echo "checked";
                    } ?> type="radio" name="active" value="No "> No
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="Update Category" class="btn-secondary">
          </td>
        </tr>
      </table>
    </form>
<?php 
//on va verifier submit cliquer ou nn
if(isset($_POST['submit'])){
  //get donnees
  $id = $_POST['id'];
   $title = $_POST['title'];
   $current_image = $_POST['current_image'];
   $featured = $_POST['featured'];
   $active = $_POST['active'];
//update image 
if(isset($_FILES['image']['name'])){

$image_name=$_FILES['image']['name'];
if($image_name!="") {
  
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
      header("location:".SITEURL.'admin/manage-category.php');
      die();

    }
    //remove current image 
    if($current_image!="") {
      
    $remove_path = "../images/category/".$current_image;
    $remove = unlink($remove_path);
    //check w9t image tetnaha wala

    if($remove==false){
      $_SESSION['failed-remove']="Failed to remove!!";
      header("location:".SITEURL.'admin/manage-category.php');
      die();
      //stop process
    }
  }
    
}
else{

   $image_name=$current_image;
}

}else{

  $image_name=$current_image;
}



  //update base
   $sql2="UPDATE tbl_category SET 
   title='$title',
   image_name= '$image_name',
   featured='$featured',
   active='$active'
   WHERE id= $id
   ";

$res2 = mysqli_query($conn , $sql2);
if($res2==TRUE){

//echo "Data Inserted!!" ;
//start session 
  $_SESSION['update']= "admin updated success";
  header("location:".SITEURL.'admin/manage-category.php');
  
}
 else{
  $_SESSION['update']= " failed to update!!"; 
  header("location:".SITEURL.'admin/manage-category.php'); }
  }
?>
  </div>
</div>



<?php include('partials/footer.php'); ?>