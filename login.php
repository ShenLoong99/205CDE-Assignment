<?php
    if(isset($_POST['submit'])){
        $username = trim($_POST['uname']);
        $password = trim($_POST['password']);
        if(!empty($_POST["remember"])) {
            setcookie ("username", $username, time()+ (10 * 365 * 24 * 60 * 60));
            setcookie ("password", $password, time()+ (10 * 365 * 24 * 60 * 60));
        } else {
            setcookie ("username", "");
            setcookie ("password", "");
        }
        require 'component/recaptcha.php';
        if (reCaptcha()) {
            require 'component/db.php';
            $sql = "SELECT * FROM user WHERE username = '".$username."'";
            if($result = $con -> query($sql)){
                if($result -> num_rows > 0){
                    while ($row = $result->fetch_assoc()) {
                        if (password_verify($password, $row["password"])) {
                            session_start();
                            $_SESSION["logged-in"] = true;
                            $_SESSION["id"] = $row["id"];
                            $_SESSION["name"] = $row["name"];
                            $_SESSION["username"] = $username;
                            $_SESSION["email"] = $row["email"]; 
                            $_SESSION["phone"] = $row["phone"]; 
                            $_SESSION["desc"] = $row["desc"]; 
                            header("location: user.php");
                        } else {
                            echo "<script>alert('The password you entered is incorrect!')</script>";
                            break;
                        }
                    }
                }
                else {
                    echo "<script>alert('The username you entered is incorrect!')</script>";
                }
            }
            else {
                echo "<script>alert('Query error! Unable to login')</script>";
            }
            $con->close();
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php include('component/head.php') ?>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <style>
            button:hover {
                color: dodgerblue !important;
            }
        </style>
    </head>
    <body>
        <?php include('component/navbar.php') ?>
        <div class="container">
            <div class="p-2 path mb-2">
                <a class="text-white" href="home.php" title="Manga Online">Manga Online</a> 
                <i class="fas fa-angle-double-right"></i> <a class="text-white" href="login.php">Login</a>
            </div>
            <div class="bg-light text-center">
                <div class="p-3 w-50 bg-light d-inline-block">
                    <h2><b>Login Your Account</b></h2>
                    <form class="recaptchaForm" method="post" name="myform" onsubmit="return validateform()" action="">
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                            </div>
                            <input name="uname" class="form-control" maxlength="30" value="<?php if(isset($username)) { echo $username; } else if (isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>" required placeholder="Username" type="text">
                        </div> <!-- form-group// -->
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                            </div>
                            <input name="password" class="form-control" required placeholder="Password" maxlength="50" value="<?php if (isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" type="password">
                        </div> <!-- form-group// -->
                        <div class="g-recaptcha" data-sitekey="6Lfbg78UAAAAAJziJaCoegxeSgojteRb6ZmpckCx"></div><br>
                        <label class="float-left"><input type="checkbox" <?php if(isset($_COOKIE["username"])) { echo 'checked'; } ?> name="remember">  Remember me</label>
                        <button type="submit" name="submit" class="btn btn-dark btn-lg text-uppercase active w-100"><b>sign in</b></button>
                        <div class="mt-4">
                            <div class="d-flex justify-content-center links">
                                Don't have an account? <a href="register.php" class="ml-2">Sign Up</a>
                            </div>
                            <div class="d-flex justify-content-center links">
                                <a href="get_email.php">Forgot your password?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><br>
        <?php include('component/footer.php') ?>
    </body>
</html>
