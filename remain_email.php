<?php
    $key = "random";
    $emailForDecrypt = $_GET['email'];
    $idForDecrypt = $_GET['id'];
    
    $email = openssl_decrypt($emailForDecrypt,"AES-128-ECB",$key);
    $id = openssl_decrypt($idForDecrypt,"AES-128-ECB",$key);
    
    require_once 'component/db.php';
    $sql = "UPDATE user SET email = '".$email."' WHERE id = $id";
    if ($con->query($sql)) {
        echo "<script>alert('Email has reset back to original...')</script>";
    }
    else {
        printf("<script>alert('Error SQL %s. Cannot Update!')</script>", mysqli_error($con));
    }
    $con->close(); // disconnect 
?>

