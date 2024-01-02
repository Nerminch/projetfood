

<?php  include('partials/menu.php'); ?>


<div class="main-content">
	<div class="wrapper">
<h1>Add Admin</h1>

<?php
if(isset($_SESSION['add'])){ 
//ki tajouti yatlaa msg
	echo $_SESSION['add'];

	unset($_SESSION['add']); //ki trefrechi lpage ytnaha msg
}?>
<br/>

<form action="" method="POST">

<table width="30%">
	<tr>
		<td>Full Name:</td>
		<td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
	</tr>
	<tr>
		<td>Username:</td>
		<td><input type="text" name="username" placeholder="Enter Your Username"></td>
	</tr>
	<tr>
		<td>Password:</td>
		<td><input type="password" name="password" placeholder="Enter Your Password"></td>
	</tr>
	<tr>
		<td colspan="2">
			<input type="submit" name="submit" value="Add Admin" class="btn-secondary" >
		</td> 
	</tr>
</table>



</form>


</div>
</div>


<?php include('partials/footer.php'); ?>

<?php

// Assurez-vous d'inclure votre fichier de configuration.

// Fonction pour chiffrer une chaîne de caractères
function encrypt($data, $key) {
    $cipher = "aes-256-cfb"; // Utilisez le même mode de chiffrement
    $ivlen = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivlen);
    $encrypted = openssl_encrypt($data, $cipher, $key, 0, $iv);
    return base64_encode($iv . $encrypted); // Incluez l'IV avec les données chiffrées
}


if(isset($_POST['submit'])){
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Le mot de passe brut

    // Clé de chiffrement (vous devez utiliser une clé sécurisée)
    $key = "CleSecrete123456";

    // Chiffrer les données
    $encrypted_full_name = encrypt($full_name, $key);
    $encrypted_username = encrypt($username, $key);
    

    $sql = "INSERT INTO tbl_admin (full_name, username, password) VALUES ('$encrypted_full_name', '$encrypted_username', 'password')";

    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    if($res == TRUE) {
        $_SESSION['add'] = "admin added success";
        header("location:".SITEURL.'admin/manage-admin.php');
    } else {
        $_SESSION['add'] = "Failed to add!!";
        header("location:".SITEURL.'admin/add-admin.php');
    }
}
?>
