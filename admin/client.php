<?php
include('../config/config.php');

if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $websitename = $_POST['websitename'];
    $message = $_POST['message'];

    // Clé de chiffrement (vous devez utiliser une clé sécurisée)
    $key = "CleSecrete123456";

    // Fonction pour chiffrer une chaîne de caractères
    function encrypt($data, $key)
    {
        $cipher = "aes-256-cfb"; // Utilisez le même mode de chiffrement
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = openssl_random_pseudo_bytes($ivlen);
        $encrypted = openssl_encrypt($data, $cipher, $key, 0, $iv);
        return base64_encode($iv . $encrypted); // Incluez l'IV avec les données chiffrées
    }

    // Chiffrer les données
    $encrypted_firstname = encrypt($firstname, $key);
    $encrypted_lastname = encrypt($lastname, $key);
    $encrypted_email = encrypt($email, $key);
    $encrypted_websitename = encrypt($websitename, $key);
    $encrypted_message = encrypt($message, $key);

    // Assurez-vous que votre connexion à la base de données est correctement configurée dans config.php
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO client (first_name, last_name, email, website_name, message) VALUES ('$encrypted_firstname', '$encrypted_lastname', '$encrypted_email', '$encrypted_websitename', '$encrypted_message')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['add'] = "Client added successfully";
        header("location:" . SITEURL . 'admin/client.php');
    } else {
        $_SESSION['add'] = "Failed to add client!!";
        header("location:" . SITEURL . 'admin/client.php');
    }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Design by foolishdeveloper.com -->
    <title>Glassmorphism login Form Tutorial in html css</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    <style media="screen">
        /* Votre style CSS ici */
        /* ... */
    </style>
</head>
<body>
<div class="background">
    <div class="shape"></div>
    <div class="shape"></div>
</div>
<form method="post" action="#">
    <div class="form-row">
        <div class="input-data">
            <input type="text" name="firstname" required>
            <div class="underline"></div>
            <label for="firstname">First Name</label>
        </div>
        <div class="input-data">
            <input type="text" name="lastname" required>
            <div class="underline"></div>
            <label for="lastname">Last Name</label>
        </div>
    </div>
    <div class="form-row">
        <div class="input-data">
            <input type="text" name="email" required>
            <div class="underline"></div>
            <label for="email">Email Address</label>
        </div>
        <div class="input-data">
            <input type="text" name="websitename" required>
            <div class="underline"></div>
            <label for="websitename">Website Name</label>
        </div>
    </div>
    <div class="form-row">
        <div class="input-data textarea">
            <textarea name="message" rows="8" cols="80" required></textarea>
            <br />
            <div class="underline"></div>
            <label for="message">Write your message</label>
            <br />
            <div class="form-row submit-btn">
                <div class="input-data">
                    <div class="inner"></div>
                    <input type="submit" name="submit" value="Submit">
                </div>
            </div>
        </div>
    </div>
</form>
</body>
</html>
