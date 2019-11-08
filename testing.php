<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <?php include('component/head.php') ?>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <style>
            .divider-text {
                position: relative;
                text-align: center;
                margin-top: 15px;
                margin-bottom: 15px;
            }
            .divider-text span {
                padding: 7px;
                font-size: 12px;
                position: relative;   
                z-index: 2;
            }
            .divider-text:after {
                content: "";
                position: absolute;
                width: 100%;
                border-bottom: 1px solid #ddd;
                top: 55%;
                left: 0;
                z-index: 1;
            }

            .btn-facebook {
                background-color: #405D9D;
                color: #fff;
            }
            .btn-twitter {
                background-color: #42AEEC;
                color: #fff;
            }
            
            .content {
                background: rgb(0,0,0,0.7);
                color: #fff;
            }
            
            .divider-text {
                color: black;
            }
            
            .btn-create {
                background: #FF4500;
            }
            
            .btn-create:hover {
                color: #FF4500;
                background: #fff;
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
                
                if (option == "010") {
                    if (phone.length != 8) {
                        alert ("Phone number start with 010 must have 8 digits followed!");
                        return false;
                    }
                }
                else {
                    if (phone.length > 7) {
                        alert ("Phone number not start with 010 must have 7 digits followed!");
                        return false;
                    }
                }
                
                if (atposition<1 || dotposition<atposition+2 || dotposition+2>=x.length){  
                    alert("Please enter a valid e-mail address");  
                    return false;  
                }
                
                if(password1 == password2){  
                    return true;  
                }  
                else{  
                    alert("password must be same!");  
                    return false;  
                }
            }  
        </script>
    </head>
    <body>
        <?php include('component/navbar.php') ?>
        <section class="container container-fluid">
            <div class="card content">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">Create Account</h4>
                    <p class="text-center">Get started with your free account</p>
                    <form class="recaptchaForm" name="myform" onsubmit="return validateform()" method="post">
                        <div class="g-recaptcha" data-sitekey="6Lca37wUAAAAAIwnR6Pw4Wz_Trhx0fTQcNLcr13j"></div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block btn-create" name="post"> Create Account  </button>
                        </div> <!-- form-group// -->
                        <input type="hidden" id="token" name="token">
                        <p class="text-center">Have an account? <a href="login.php">Log In</a> </p>                                                                 
                    </form>
                </article>
            </div> <!-- card.// -->
        </section><br>
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
                $.post("submit.php", {
                    "secret": "6Lca37wUAAAAAM0CM65IIYpoftzAs1rxxB3DRnYV",
                    "response": recaptcha
                }, function(ajaxResponse) {
                        console.log(ajaxResponse);
                    });
            });
        });
    </script>
</html>
