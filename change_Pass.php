<?php 
    session_start(); 
    if(isset($_POST['submit'])){
        $id = $_SESSION["id"];
        $old_pass = $_POST["current_pass"];
        $new_pass = $_POST["password1"];
        require 'component/db.php';
        if (chk_password($id, $old_pass, $con)) {
            $hash = password_hash($new_pass, PASSWORD_DEFAULT);
            $sql = "UPDATE `user` SET `password` = '".$hash."' WHERE `id` = '".$id."'";
            if ($con->query($sql) === TRUE) {
                //update successful
                echo "<script>alert('Password has been changed successfully!')</script>";
                header("Refresh: 0.5; url=user.php");
            } else {
                //update failed
                echo "<script>alert('SQL error! Cannot update!')</script>";
            }
        }
        $con->close(); //disconnect
    }
    
    function chk_password($id, $old_pass, $con) {
        $sql = "SELECT password FROM user WHERE id = '".$id."'";
        $result = $con->query($sql);
        if($row = $result->fetch_object()){ //retrieve 1 by 1 (record)
            //record found, keep the value
            if (password_verify($old_pass, $row->password)) { return true; }
            else { 
                echo "<script>alert('Incorrect password! Please enter the correct password...')</script>";
                return false; 
            }
        }
        else {
            echo "<script>alert('ID error! Cannot find match in database!')</script>";
            return false;
        }
    }
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Change Password</title>
        <?php include('component/head.php') ?>
        <style>
            .option {
                margin-bottom: 200px;
            }
            
            .special {
                list-style: none;
            }
            
            .special li::before {
                content: "\2022";
                color: green;
                font-size: 20px;
                display: inline-block; 
                width: 1em;
                margin-left: -1em;
                pading: 0px;
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
        <?php include('component/login-navbar.php') ?>
        <div class="container p-2 path">
            <a class="text-white" href="home.html" title="Manga Online">Manga Online</a> 
            <i class="fas fa-angle-double-right"></i> Change Password
        </div>
        <div class="container d-block">
            <div class="row">
                <div class="p-3 col-8 bg-light">
                    <h2><b>Changes password</b></h2>
                    <form method="post" name="myform" onsubmit="return validateform()">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="<?php echo $_SESSION["username"] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="current_pass" placeholder="Current Password" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password1" placeholder="New Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password2" placeholder="Repeat Password" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-dark btn-lg text-uppercase active"><b>Save Changes</b></button>
                    </form>
                </div>
                <?php include('component/aside-login.php') ?>
            </div>
        </div><br>
        <?php include('component/footer.php') ?>
    </body>
</html>
