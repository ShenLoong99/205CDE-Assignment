<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    if(isset($_POST['submit'])){
        $name = $_POST['name'];             // <- dnt trim ----!! bcoz example: Tan Ooi Kai
        $username = $_POST['uname'];
        $phone_head = $_POST['ddl'];
        $phone_body = $_POST['phone'];
        $email = trim($_POST['email']);
        require 'component/db.php';
        if (chkEmailandUname($email, $username, $con) == 1) {
            echo "<script>alert('Existed email or username detected! Please change your username or email!')</script>";
        }
        else if (chkEmailandUname($email, $username, $con) == 2) {
            echo "<script>alert('Existed account detected! Please change your username and email!')</script>";
        }
        require 'component/recaptcha.php';
        if (reCaptcha() && chkEmailandUname($email, $username, $con) == 0) {
            $phone = $phone_head.$phone_body;
            $password = $_POST['password2'];     // <- dnt trim ----!! bcoz mau tell user tak boleh space
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $email = $con -> real_escape_string($email);
            //sql statement
            $sql = "INSERT INTO user VALUES (null, '$name', '$username', '$phone', '$email', '$hash', null)";
            if (!mysqli_query($con, $sql)) {
                echo '<script>alert("Error SQL: '.mysql_error().'! Cannot be registered...")</script>';
            } else { // send email
                require "../vendor/autoload.php";
                $mail = new PHPMailer(true);
                // $mail->SMTPDebug = 2; //not nessasary .. use to find our bug
                $mail->IsSMTP();
                $mail->CharSet = "utf-8";
                $mail->SMTPSecure = "tls"; //Enable TLS encryption
                $mail->SMTPAuth = true;
                $mail->Host = "smtp.gmail.com";
                $mail->Port = 587;
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
                $mail->isHTML(true);
                $sender_email = "yithuet.tsk@gmail.com"; //Your gmail
                $mail->Username = $sender_email;
                $mail->Password = "llsvrjbrtkvpyhyf"; //Your App Password 		
                $mail->setFrom($sender_email, 'Mangakakalot');//Your application NAME and EMAIL
                $mail->Subject = "Mangakakalot Account Registration";
                $mail->MsgHTML("<div><p>Mangakakalot</p></div>"
                        . "<div><p>Dear $name,</p> "
                        . "<p></p> "
                        . "<p>Congratulation, you have successfully register an account!</p> "
                        . "<p>Your user name is <strong>$username</strong></p> "
                        . "<span>* Kindly login to your account to check for more info.</span><br><br>"
                        . "Enjoy!<br>Sincerely yours,<br>"
                        . "mangakakalot </div> <br>");
                $mail->addAddress($email, $username);// Target email
                if($mail->Send()){
                    echo '<script>alert("New account created successfully! An email will be sent to the email address provided.")</script>';
                    echo '<script language="javascript">setTimeout(function () { window.location.href = "login.php"; },100);</script>';
                }
            }
        }
        $con->close(); //disconnect
    }
    
    function chkEmailandUname($email, $username, $con){
        $exist = 0;
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
                $exist++;
            }
        } // check whether username is duplicated
        $sql = "SELECT * FROM user WHERE username = '$username'";
        if ($result = $con -> query($sql)) {
            if ($result -> num_rows > 0) {
                $exist++;
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
                            <input name="name" autocomplete="off" class="form-control" maxlength="50" required placeholder="Full name" pattern="^[A-Za-z ]+$" title="Please enter name" type="text" value="<?php if(isset($name)) echo $name ?>">
                        </div> <!-- form-group// -->
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                            </div>
                            <input name="uname" autocomplete="off" class="form-control" maxlength="30" required placeholder="Username" type="text" value="<?php if(isset($username)) echo $username ?>">
                        </div> <!-- form-group// -->
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                            </div>
                            <input name="email" autocomplete="off" class="form-control" maxlength="50" required placeholder="Email address" type="email" value="<?php if(isset($email)) echo $email ?>">
                        </div> <!-- form-group// -->
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                            </div>
                            <select id="ddl" name="ddl" class="custom-select" style="max-width: 70px;">
                                <option value="010" <?php if(isset($phone_head) && $phone_head == "010") echo 'selected' ?>>010</option>
                                <option value="011" <?php if(isset($phone_head) && $phone_head == "011") echo 'selected' ?>>011</option>
                                <option value="012" <?php if(isset($phone_head) && $phone_head == "012") echo 'selected' ?>>012</option>
                                <option value="013" <?php if(isset($phone_head) && $phone_head == "013") echo 'selected' ?>>013</option>
                                <option value="014" <?php if(isset($phone_head) && $phone_head == "014") echo 'selected' ?>>014</option>
                                <option value="016" <?php if(isset($phone_head) && $phone_head == "016") echo 'selected' ?>>016</option>
                                <option value="017" <?php if(isset($phone_head) && $phone_head == "017") echo 'selected' ?>>017</option>
                                <option value="018" <?php if(isset($phone_head) && $phone_head == "018") echo 'selected' ?>>018</option>
                                <option value="019" <?php if(isset($phone_head) && $phone_head == "019") echo 'selected' ?>>019</option>
                            </select>
                            <input name="phone" autocomplete="off" class="form-control" maxlength="8" required pattern="^[0-9]{7,8}$" placeholder="Phone number" title="Must contain 7 or 8 digits" type="text" value="<?php if(isset($phone_body)) echo $phone_body ?>">
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