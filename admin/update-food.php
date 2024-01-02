<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Update Food</h1>

    <br><br>
<?php 
 //get id
if (isset($_GET['id'])){
  $id = $_GET['id'];

//sql
   $sql2 ="SELECT * FROM tbl_food WHERE id=$id";
//execute query 
$res2 = mysqli_query($conn, $sql2);
//msg succes

  //data avalaible ou nn
  $count= mysqli_num_rows($res2);

if($count==1){
  //get data
 //echo "admin";
  $row2=mysqli_fetch_assoc($res2);
  $title = $row2['title'];
  $description = $row2['description'];
  $price = $row2['price'];
  $current_image = $row2['image_name'];
  $current_category=$row2['category_id'];
  $featured = $row2['featured'];
  $active = $row2['active'];

} else {
  $_SESSION['no-food-found']="food not found!";
   header('location:'.SITEURL.'admin/manage-food.php');
  
}}
else{
  header('location:'.SITEURL.'admin/manage-food.php');

}
?>
  <form action="" method="POST" enctype="multipart/form-data"> 

<table width="30%">
 <tr>
    <td>Title:</td>
    <td><input type="text" name="title" value="<?php  echo $title;?>" ></td>
  </tr>
  <tr>
    <td>Description:</td>
    <td><textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea></td>
</tr>

  <tr>
    <td>price:</td>
    <td><input type="number" name="price" value="<?php  echo $price;?>" ></td>
  </tr>
  <tr>
          <td>Current Image:</td>
          <td>

            <?php
            if ($current_image != "") {
            ?>
              <img src="<?php echo SITEURL; ?>images/foods/<?php echo $current_image; ?>" width="150px">
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
                      $category_id = $row['id'];
                      $category_title = $row['title'];
                      
                      ?>

                      <option <?php if($current_category==$category_id){
                        echo "selected";
                      } ?> value="<?php echo $category_id;  ?>"><?php echo $category_title; ?></option>
                      
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
    <td><input <?php if ($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
      <input <?php if ($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
    </td>
  </tr>
  <tr>
    <td>Active:</td>
    <td><input  <?php if ($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
      <input <?php if ($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No
    </td>
  </tr>
  <tr>
    <td colspan="2">

      <input type="hidden"  name ="id" value=" <?php  echo $id;?>">
       <input type="hidden"  name ="current_image" value=" <?php  echo $current_image;?>">
      
      <input type="submit" name="submit" value="Add Food" class="btn-secondary" >
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
   $description = $_POST['description'];
   $price = $_POST['price'];
   $current_image = $_POST['current_image'];
    $category = $_POST['category'];
   $featured = $_POST['featured'];
   $active = $_POST['active'];
//update image 
if(isset($_FILES['image']['name'])){

$image_name=$_FILES['image']['name'];

if($image_name!="") {
  
$ext=end(explode('.' , $image_name)); 

    //rename image
    $image_name = "Food_".rand(000,999).'.'.$ext; //Food_category_888.jpg


    $source_path=$_FILES['image']['tmp_name'];
    $destination_path="../images/foods/".$image_name;
    //finally upload
    $upload=move_uploaded_file($source_path, $destination_path);
    //check w9t limage ysirlha upld w w9t la
    if($upload==false){
      //masarch 
      $_SESSION['upload']="Failed to upload!!";
      header("location:".SITEURL.'admin/manage-food.php');
      die();

    }
    //remove current image 
    if($current_image!="") {
      
    $remove_path = "../images/foods/".$current_image;
    $remove = unlink($remove_path);
    //check w9t image tetnaha wala

    if($remove==false){
      $_SESSION['failed-remove']="Failed to remove!!";
      header("location:".SITEURL.'admin/manage-food.php');
      die();
      //stop process
    }
  }
    
}else{
  $image_name=$current_image;

}

}else{

  $image_name=$current_image;
}



  //update base
   $sql3="UPDATE tbl_food SET 
   title='$title',
   description='$description',
   price='$price',
   image_name= '$image_name',
   category_id='$category',
   featured='$featured',
   active='$active'
   WHERE id= $id
   ";

$res3 = mysqli_query($conn , $sql3);
if($res3==TRUE){

//echo "Data Inserted!!" ;
//start session 
  $_SESSION['update']= "Food updated success";
  header("location:".SITEURL.'admin/manage-food.php');
  
}
 else{
  $_SESSION['update']= " failed to update!!"; 
  header("location:".SITEURL.'admin/manage-food.php'); }
  }
?>
  </div>
</div>



<?php include('partials/footer.php'); ?>