<?php session_start(); ?>

<?php 
    if(isset($_POST['submit'])){
        $name = $_POST['name'];             // <- dnt trim ----!! bcoz example: Tan Ooi Kai
        $username = $_POST['uname'];
        $phone_head = $_POST['ddl'];
        $phone_body = $_POST['phone'];
        $email = trim($_POST['email']);
        
        $_SESSION["name"] = $name;
        $_SESSION["username"] = $username;
        $_SESSION["phone_head"] = $phone_head;
        $_SESSION["phone_body"] = $phone_body;
        $_SESSION["email"] = $email; 
        
        require 'component/db.php';
        if (checkDuplicateEmail($email, $con) == true) {
            echo "<script>alert('Existing email detected! Please use another email')</script>";
        }
        require 'component/recaptcha.php';
        if (reCaptcha() && checkDuplicateEmail($email, $con) == false) {
            $phone = $phone_head.$phone_body;
            $password = $_POST['password2'];     // <- dnt trim ----!! bcoz mau tell user tak boleh space
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $email = $con -> real_escape_string($email);
            //sql statement
            $sql = "INSERT INTO user VALUES (null, '$name', '$username', '$phone', '$email', '$hash', null)";
            if (!mysqli_query($con, $sql)) {
                die('Error: ' . mysql_error());
            } else {
                // send email
                echo "<script>alert('New account created successfully! An email will be sent to the email address you provided.')</script>";
                header("Refresh: 0.5; url=login.php");
            }
        }
        $con->close(); //disconnect
    }
    
    function checkDuplicateEmail($email, $con){
        $exist = false;
        $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        //NOTE: real_escape_string($id)
        //convert special symbol into charset understood DB
        $email = $con -> real_escape_string($email);
        $sql = "SELECT * FROM user WHERE email = '$email'";
        // A SELECT * FROM student WHERE email = abc@gmail.com
        // B SELECT * FROM student WHERE email = 'abc@gmail.com'
        //check if there are same key?
        //NOTE: insert function $statement = $con -> prepare($sql)
        if($result = $con -> query($sql)){
            if($result -> num_rows > 0){
                $exist = true;
            }
        }
        //$result -> free(); only for search
        $result -> free();
        $con -> close();
        return $exist;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
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
                var email=document.myform.email.value;
                var atposition=email.indexOf("@");  
                var dotposition=email.lastIndexOf(".");
                var ddl=document.getElementById("ddl");
                var option=ddl.options[ddl.selectedIndex].value;
                var phone=document.myform.phone.value;
                
                if(password1 != password2){ 
                    alert("Password must be same!");  
                    return false;  
                }
                
                if (option == "010") {
                    if (phone.length != 8) {
                        alert ("Phone number start with 010 must have 8 digits followed!");
                        return false;
                    }
                }
                else {
                    if (phone.length != 7) {
                        alert ("Phone number not start with 010 must have 7 digits followed!");
                        return false;
                    }
                }
                
                if (atposition<1 || dotposition<atposition+2 || dotposition+2>=x.length){  
                    alert("Please enter a valid e-mail address");  
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
                <i class="fas fa-angle-double-right"></i> <a class="text-white" href="register.php.php">Register</a>
            </div>
            <div class="bg-light text-center">
                <div class="p-3 bg-light d-inline-block">
                    <h2><b>Create your Manga Account</b></h2>
                    <form name="myform" onsubmit="return validateform()" method="post">
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                            </div>
                            <input name="name" autocomplete="off" class="form-control" maxlength="50" required placeholder="Full name" pattern="^[A-Za-z ]+$" title="Please enter name" type="text" value="<?php if(isset($_SESSION["name"])) echo $_SESSION["name"] ?>">
                        </div> <!-- form-group// -->
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                            </div>
                            <input name="uname" autocomplete="off" class="form-control" maxlength="30" required placeholder="Username" type="text" value="<?php if(isset($_SESSION["username"])) echo $_SESSION["username"] ?>">
                        </div> <!-- form-group// -->
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                            </div>
                            <input name="email" autocomplete="off" class="form-control" maxlength="50" required placeholder="Email address" type="email" value="<?php if(isset($_SESSION["email"])) echo $_SESSION["email"] ?>">
                        </div> <!-- form-group// -->
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                            </div>
                            <select id="ddl" name="ddl" class="custom-select" style="max-width: 70px;">
                                <option value="010" <?php if(isset($_SESSION["phone_head"]) && $_SESSION["phone_head"] == "010") echo 'selected' ?>>010</option>
                                <option value="011" <?php if(isset($_SESSION["phone_head"]) && $_SESSION["phone_head"] == "011") echo 'selected' ?>>011</option>
                                <option value="012" <?php if(isset($_SESSION["phone_head"]) && $_SESSION["phone_head"] == "012") echo 'selected' ?>>012</option>
                                <option value="013" <?php if(isset($_SESSION["phone_head"]) && $_SESSION["phone_head"] == "013") echo 'selected' ?>>013</option>
                                <option value="014" <?php if(isset($_SESSION["phone_head"]) && $_SESSION["phone_head"] == "014") echo 'selected' ?>>014</option>
                                <option value="016" <?php if(isset($_SESSION["phone_head"]) && $_SESSION["phone_head"] == "016") echo 'selected' ?>>016</option>
                                <option value="017" <?php if(isset($_SESSION["phone_head"]) && $_SESSION["phone_head"] == "017") echo 'selected' ?>>017</option>
                                <option value="018" <?php if(isset($_SESSION["phone_head"]) && $_SESSION["phone_head"] == "018") echo 'selected' ?>>018</option>
                                <option value="019" <?php if(isset($_SESSION["phone_head"]) && $_SESSION["phone_head"] == "019") echo 'selected' ?>>019</option>
                            </select>
                            <input name="phone" autocomplete="off" class="form-control" maxlength="8" required pattern="^[0-9]{7,8}$" placeholder="Phone number" title="Must contain 7 or 8 digits" type="text" value="<?php if(isset($_SESSION["phone_body"])) echo $_SESSION["phone_body"] ?>">
                        </div> <!-- form-group// -->
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
                        <div class="g-recaptcha" data-sitekey="6Lfbg78UAAAAAJziJaCoegxeSgojteRb6ZmpckCx"></div>
                        <div class="form-group mt-2">
                            <button type="submit" name="submit" class="btn btn-dark btn-lg text-uppercase active w-100"><b>Sign Up</b></button>
                        </div> <!-- form-group// -->
                        <input type="hidden" id="token" name="token">
                        <p class="text-center">Have an account? <a href="login.php">Log In</a> </p>
                    </form>
                </div>
            </div>
        </div><br>
        <?php include('component/footer.php') ?>
    </body>
</html>