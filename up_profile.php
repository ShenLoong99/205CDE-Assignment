<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    session_start();
    $phone = $_SESSION["phone"];
    $phone_head = substr($phone, 0, 3);
    $phone_body = substr($phone, 3);
    
    if(isset($_POST['submit'])){
        // retrieve value
        $email = trim($_POST['email']);
        $name = $_POST['name'];
        $username = $_POST['uname'];
        $phone_head = $_POST['ddl'];
        $phone_body = $_POST['phone'];
        $phone = $phone_head . $phone_body;
        $desc = $_POST['desc'];
        //Step 1: establish connect
        require 'component/db.php';
        //Step 2: sql statement
        $sql = "UPDATE `user` SET `name` = '".$name."', `username` = '".$username."', `phone` = '".$phone."', `desc` = '".$desc."', `email` = '".$email."' WHERE `id` = '".$_SESSION["id"]."'";
        //Step 3: run sql
        $result = $con->query($sql);
        if (!$result) {
            printf("Error: %s\n", mysqli_error($con));
        }
        if ($con->query($sql)) { //update successful
            if (strcmp($email, $_SESSION["email"]) != 0) { // if email not same, send email
                $key = "random";
                $encrypted_email = openssl_encrypt($_SESSION["email"], "AES-128-ECB", $key);
                $encrypted_id = openssl_encrypt($_SESSION["id"], "AES-128-ECB", $key);
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
                $mail->Subject = "Mangakakalot Email Changes";
                $mail->MsgHTML("<div><p>Mangakakalot</p></div>"
                        . "<div><p>Dear $name,</p> "
                        . "<p></p> "
                        . "<p>We have receive a request to change email from Mangakakalot.com account by the username of $username.</p> "
                        . "<p>Please be informed that your account has changed the email address, hence we will send news and updates to this email in the future.</p> "
                        . "<p>* If you <strong>DON'T KNOW</strong> any activity about this, please click this link below </p>"
                        . "<a href='http://localhost/Mangakakalot/remain_email.php?email=$encrypted_email&id=$encrypted_id'>Reset Email</a><br><br>"
                        . "Enjoy!<br>Sincerely yours,<br>"
                        . "mangakakalot </div> <br>");
                $mail->addAddress($email, $username);// Target email
                if($mail->Send()){ // if email send successfully
                    echo '<script>alert("Changes has been made successfully! An email will be sent to the email address provided.")</script>';
                    $_SESSION["name"] = $name;
                    $_SESSION["username"] = $username;
                    $_SESSION["email"] = $email; 
                    $_SESSION["phone"] = $phone;
                    $_SESSION["desc"] = $desc;
                    header("Refresh: 0.1; url = user.php");
                }
                else { // if email cannot be sent
                    echo '<script>alert("Changes has been made successfully! Unfortunately, due to unknown errors, email cannot be sent...")</script>';
                    $_SESSION["name"] = $name;
                    $_SESSION["username"] = $username;
                    $_SESSION["email"] = $email; 
                    $_SESSION["phone"] = $phone;
                    $_SESSION["desc"] = $desc;
                    header("Refresh: 0.1; url = user.php");
                }
            }
            else { // email same
                $_SESSION["name"] = $name;
                $_SESSION["username"] = $username;
                $_SESSION["phone"] = $phone;
                $_SESSION["desc"] = $desc;
                echo '<script>alert("Changes has been made successfully!")</script>';
                header("Refresh: 0.1; url = user.php");
            }
        } else { //update failed
            echo "<script>alert('SQL error! Cannot update!')</script>";
        }
        $con->close(); // disconnect 
    }   
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Update Profile</title>
        <?php include('component/head.php') ?>
        <style>
            .option {
                margin-bottom: 350px;
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
                var email=document.myform.email.value;
                var atposition=email.indexOf("@");  
                var dotposition=email.lastIndexOf(".");
                var ddl=document.getElementById("ddl");
                var option=ddl.options[ddl.selectedIndex].value;
                var phone=document.myform.phone.value;
                
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
        <?php include('component/login-navbar.php') ?>
        <div class="container p-2 path">
            <a class="text-white" href="home.html" title="Manga Online">Manga Online</a> 
            <i class="fas fa-angle-double-right"></i> Change Info
        </div>
        <div class="container d-block">
            <div class="row">
                <div class="p-3 col-8 bg-light">
                    <h2><b>Update Profile</b></h2>
                    <form method="post" name="myform" onsubmit="return validateform()">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="<?php echo 'U'.$_SESSION["id"] ?>" readonly>
                        </div>
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                            </div>
                            <input name="name" autocomplete="off" class="form-control" maxlength="50" required pattern="^[A-Za-z ]+$" placeholder="Full Name" title="Please enter valid name" type="text" value="<?php echo $_SESSION["name"] ?>">
                        </div> <!-- form-group// -->
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                            </div>
                            <input name="uname" autocomplete="off" class="form-control" maxlength="30" required type="text" placeholder="Username" value="<?php echo $_SESSION["username"] ?>">
                        </div> <!-- form-group// -->
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                            </div>
                            <input name="email" autocomplete="off" class="form-control" maxlength="50" required type="email" placeholder="Email Address" value="<?php echo $_SESSION["email"] ?>">
                        </div> <!-- form-group// -->
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                            </div>
                            <select id="ddl" name="ddl" class="custom-select" style="max-width: 70px;">
                                <option value="010" <?php if($phone_head=="010") echo 'selected="selected"'; ?>>010</option>
                                <option value="011" <?php if($phone_head=="011") echo 'selected="selected"'; ?>>011</option>
                                <option value="012" <?php if($phone_head=="012") echo 'selected="selected"'; ?>>012</option>
                                <option value="013" <?php if($phone_head=="013") echo 'selected="selected"'; ?>>013</option>
                                <option value="014" <?php if($phone_head=="014") echo 'selected="selected"'; ?>>014</option>
                                <option value="016" <?php if($phone_head=="016") echo 'selected="selected"'; ?>>016</option>
                                <option value="017" <?php if($phone_head=="017") echo 'selected="selected"'; ?>>017</option>
                                <option value="018" <?php if($phone_head=="018") echo 'selected="selected"'; ?>>018</option>
                                <option value="019" <?php if($phone_head=="019") echo 'selected="selected"'; ?>>019</option>
                            </select>
                            <input name="phone" autocomplete="off" class="form-control" maxlength="8" required pattern="^[0-9]{7,8}$" placeholder="Phone number" title="Must contain 7 or 8 digits" type="text" value="<?php echo $phone_body ?>">
                        </div> <!-- form-group// -->
                        <div class="form-group input-group">
                            <textarea class="form-control" name="desc" rows="5" placeholder="Description..."><?php echo $_SESSION["desc"] ?></textarea>
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