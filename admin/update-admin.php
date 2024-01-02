<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>
        <?php 
    function decrypt($data, $key) {
    $data = base64_decode($data); // Si vous avez utilisé base64_encode
    $ivlen = openssl_cipher_iv_length('aes-256-cfb'); // Utilisez le même mode de chiffrement
    $iv = substr($data, 0, $ivlen); // Récupère l'IV à partir des données chiffrées
    $data = substr($data, $ivlen); // Supprime l'IV des données chiffrées
    $decrypted_data = openssl_decrypt($data, 'aes-256-cfb', $key, 0, $iv);
    return $decrypted_data;
   }

        //get id
        $id = $_GET['id'];
        //sql
        $sql ="SELECT * FROM tbl_admin WHERE id=$id";
        //execute query 
        $res = mysqli_query($conn,$sql);
        //msg succes

        if($res==true){
            //data available or not
            $count= mysqli_num_rows($res);

            if($count==1){
                //get data
                //echo "admin";
                $row=mysqli_fetch_assoc($res);

                // Clé de chiffrement (vous devez utiliser une clé sécurisée)
                $key = "CleSecrete123456";

                // Déchiffrer les données
                $decrypted_full_name = decrypt($row['full_name'], $key);
                $decrypted_username = decrypt($row['username'], $key);
            } else {
                header('location:'.SITEURL.'admin/manage-admin.php');
            }

        }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td> full Name:</td>
                    <td>
                    <input type="text" name="full_name" value="<?php  echo $decrypted_full_name;?>"> </td>
                    
                </tr>
                <tr>
                    <td> Username:</td>
                    <td>
                    <input type="text" name="username" value="<?php  echo  $decrypted_username;?>"> </td>
                    
                </tr>
                <tr>
                    
                    <td colspan="2">
                    <input type="hidden"  name ="id" value=" <?php  echo $id;?>"> 
                    <input type="submit" name="submit" value="Update" class="btn-secondar"> </td>
                    
                </tr>
                
            </table>


        </form>
    </div>
</div>

<?php 
// Fonction pour chiffrer une chaîne de caractères
function encrypt($data, $key) {
    $cipher = "aes-256-cfb"; // Utilisez le même mode de chiffrement
    $ivlen = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivlen);
    $encrypted = openssl_encrypt($data, $cipher, $key, 0, $iv);
    return base64_encode($iv . $encrypted); // Incluez l'IV avec les données chiffrées
}
//on va verifier submit cliquer ou nn
if(isset($_POST['submit'])){
   $id = $_POST['id'];
   $full_name = $_POST['full_name'];
   $username = $_POST['username'];
    // Clé de chiffrement (vous devez utiliser une clé sécurisée)
    $key = "CleSecrete123456";

    // Chiffrer les données
    $encrypted_full_name = encrypt($full_name, $key);
    $encrypted_username = encrypt($username, $key);
 
   $sql=" UPDATE tbl_admin SET 
   full_name='$encrypted_full_name',
   username='$encrypted_username'
   WHERE id='$id'";

    $res = mysqli_query($conn , $sql);
    if($res==TRUE){

        //echo "Data Inserted!!" ;
        //start session 
        $_SESSION['update']= "admin updated success";
        header("location:".SITEURL.'admin/manage-admin.php');

    }
    else{
        $_SESSION['update']= " failed to update!!"; 
        header("location:".SITEURL.'admin/manage-admin.php'); 
    }
}
?>

<?php include('partials/footer.php'); ?>
