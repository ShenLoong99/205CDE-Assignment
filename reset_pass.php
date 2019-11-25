<?php 
    $idForDecrypt = $_GET['id'];
    $password = "password";
    $id = openssl_decrypt($idForDecrypt,"AES-128-ECB",$password);
    
    if(isset($_POST['submit'])){
        $password = $_POST['password1'];
        $hash = password_hash($password, PASSWORD_DEFAULT);
        require_once 'component/db.php';
        $sql = "UPDATE user SET password = '".$hash."' WHERE id = $id";
        if ($con->query($sql)) {
            echo "<script>alert('Password has change successfully!')</script>";
            header("Refresh:0.1, url = login.php");
        }
        else {
            printf("<script>alert('Error SQL %s. Cannot Update!')</script>", mysqli_error($con));
        }
        $con->close();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Password Reset</title>
        <?php include('component/head.php') ?>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <style>
            button:hover {
                color: dodgerblue !important;
            }
        </style>
        <script>
            function validateform(){ 
                var password1=document.myform.password1.value;
                var password2=document.myform.password2.value;
                
                if(password1 != password2){ 
                    alert("Password must be same!");  
                    return false;  
                }
            }
        </script>
    </head>
    <body>
        <?php include('component/navbar.php') ?>
        <div class="container">
            <div class="p-2 path mb-2">
                <a class="text-white" href="home.php" title="Manga Online">Manga Online</a> 
                <i class="fas fa-angle-double-right"></i> <a class="text-white">Password Reset</a>
            </div>
            <div class="d-block bg-light text-center">
                <div class="p-3 bg-light w-75 d-inline-block">
                    <h2><b>Password Reset</b></h2>
                    <form method="post" name="myform" onsubmit="return validateform()">
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                            </div>
                            <input name="password1" class="form-control" required placeholder="New password" maxlength="50" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" type="password">
                        </div> <!-- form-group// -->
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                            </div>
                            <input name="password2" class="form-control" required placeholder="Repeat password" maxlength="50" type="password">
                        </div> <!-- form-group// -->
                        <button type="submit" name="submit" class="btn btn-dark btn-lg text-uppercase active w-100 mb-4"><b>SUBMIT</b></button>
                    </form>
                </div>
            </div>
        </div><br>
        <?php include('component/footer.php') ?>
    </body>
</html>
