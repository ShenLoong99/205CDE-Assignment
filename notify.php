<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Email sent</title>
        <?php include('component/head.php') ?>
    </head>
    <body>
        <?php include('component/navbar.php') ?>
        <div class="container">
            <div class="p-2 path mb-2">
                <a class="text-white" href="home.php" title="Manga Online">Manga Online</a> 
                <i class="fas fa-angle-double-right"></i> <a class="text-white" href="notify.php">Email sent</a>
            </div>
            <div class="d-block bg-light text-center">
                <div class="p-3 bg-light w-75 d-inline-block">
                    <h2><b>Email sent</b></h2>
                    <span class="h3">
                        Username: <?php ?><br>
                        Email: <?php ?><br>
                        A password reset link has been sent to your email account. Please open 
                        the link through your email account and proceed to reset password.
                    </span>
                </div>
            </div>
        </div><br>
        <?php include('component/footer.php') ?>
    </body>
</html>
