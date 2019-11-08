<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
                <i class="fas fa-angle-double-right"></i> <a class="text-white" href="reset_pass.php">Forgot Password</a>
            </div>
            <div class="d-block bg-light text-center">
                <div class="p-3 bg-light w-75 d-inline-block">
                    <h2><b>Forgot Your Password</b></h2>
                    <form class="recaptchaForm" method="post" name="myform" onsubmit="return validateform()" action="notify.php">
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                            </div>
                            <input name="uname" autocomplete="off" class="form-control" maxlength="30" required placeholder="Username" type="text">
                        </div> <!-- form-group// -->
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                            </div>
                            <input name="email" autocomplete="off" class="form-control" maxlength="50" required placeholder="Email address" type="email">
                        </div> <!-- form-group// -->
                        <div class="g-recaptcha" data-sitekey="6Lca37wUAAAAAIwnR6Pw4Wz_Trhx0fTQcNLcr13j"></div><br>
                        <button type="submit" class="btn btn-dark btn-lg text-uppercase active w-100 mb-4"><b>SUBMIT</b></button>
                    </form>
                </div>
            </div>
        </div><br>
        <?php include('component/footer.php') ?>
    </body>
    <script>
        $(document).ready(function(){
            $(".recaptchaForm").submit(function(event){
                var recaptcha = $("#g-recaptcha-response").val();
                if(recaptcha === "") {
                    event.preventDefault();
                    alert('Please check the Recaptcha box!');
                }
                event.preventDefault();
                $.post("component/submit.php", {
                    "secret": "6Lca37wUAAAAAM0CM65IIYpoftzAs1rxxB3DRnYV",
                    "response": recaptcha
                }, function(ajaxResponse) {
                        console.log(ajaxResponse);
                });
            });
        });
    </script>
</html>
