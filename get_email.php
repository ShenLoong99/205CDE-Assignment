<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    if(isset($_POST['submit'])){
        $username = $_POST['uname'];
        $email = trim($_POST['email']);
        require 'component/db.php';
        if (!chkNameEmail($email, $username, $con)) {
            echo "<script>alert('No such email or username existed in database. Please try again.')</script>";
        }
        require 'component/recaptcha.php';
        if (reCaptcha() && chkNameEmail($email, $username, $con)) {
            $sql = "SELECT id FROM user WHERE username = '".$username."' AND email = '".$email."'";
            if($result = $con->query($sql)){
                while ($row = $result->fetch_object()) {
                    $id = $row->id;
                }
            }
            else { printf("<script>alert('Error SQL: %s. Cannot retrieve record!')</script>", mysqli_error($con)); }
            
            $password = "password";
            $encrypted_string = openssl_encrypt($id,"AES-128-ECB",$password);
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
            $mail->Subject = "Mangakakalot Password Reset";
            $mail->MsgHTML("<div><p>Mangakakalot</p></div>"
                    . "<div><p>Dear $username,</p> "
                    . "<p></p> "
                    . "<p>You have requested to reset your account password</p> "
                    . "<p>Below is the link to reset your account password:</p> "
                    . "<a href='http://localhost/Mangakakalot/reset_pass.php?id=$encrypted_string'>Reset Password</a><br><br>"
                    . "Sincerely yours,<br>"
                    . "mangakakalot </div> <br>");
            $mail->addAddress($email, $username);// Target email
            if($mail->Send()){
                echo '<script>alert("An email will be sent to the email address provided.")</script>';
                echo '<script language="javascript">setTimeout(function () { window.location.href = "get_email.php"; },100);</script>';
            }
        }
    }
    
    function chkNameEmail($email, $username, $con){
        $exist = true;
        $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        //NOTE: real_escape_string($id)
        //convert special symbol into charset understood DB
        $email = $con -> real_escape_string($email);
        $sql = "SELECT * FROM user WHERE email = '".$email."' AND username = '".$username."'";
        // A SELECT * FROM student WHERE email = abc@gmail.com
        // B SELECT * FROM student WHERE email = 'abc@gmail.com'
        //check if there are same key?
        //NOTE: insert function $statement = $con -> prepare($sql)
        $result = $con -> query($sql);
        if (!$result) {
            printf("Error: %s\n", mysqli_error($con));
        }
        if($result = $con -> query($sql)){
            if($result -> num_rows == 0){ $exist = false; }
            else { $result -> free(); } //$result -> free(); only for search
        }
        $con -> close();
        return $exist;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Forgot your password</title>
        <?php include('component/head.php') ?>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <style>
            button:hover {
                color: dodgerblue !important;
            }
        </style>
        <script>
            function validateform(){ 
                var email=document.myform.email.value;
                var atposition=email.indexOf("@");  
                var dotposition=email.lastIndexOf(".");
                
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
                <i class="fas fa-angle-double-right"></i> <a class="text-white" href="get_email.php">Forgot Password</a>
            </div>
            <div class="d-block bg-light text-center">
                <div class="p-3 bg-light w-75 d-inline-block">
                    <h2><b>Forgot Your Password</b></h2>
                    <form method="post" name="myform" onsubmit="return validateform()">
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                            </div>
                            <input name="uname" class="form-control" maxlength="30" required placeholder="Username" value="<?php if(isset($username)) echo $username ?>" type="text">
                        </div> <!-- form-group// -->
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                            </div>
                            <input name="email" class="form-control" maxlength="50" required placeholder="Email address" value="<?php if(isset($email)) echo $email ?>" type="email">
                        </div> <!-- form-group// -->
                        <div class="g-recaptcha" data-sitekey="6Lfbg78UAAAAAJziJaCoegxeSgojteRb6ZmpckCx"></div><br>
                        <button type="submit" name="submit" class="btn btn-dark btn-lg text-uppercase active w-100 mb-4"><b>SUBMIT</b></button>
                    </form>
                </div>
            </div>
        </div><br>
        <?php include('component/footer.php') ?>
    </body>
</html>
