<!DOCTYPE html>
<html>
    <head>
        <title>User</title>
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
    </head>
    <body>
        <?php include('component/login-navbar.php') ?>
        <div class="container p-2 path">
            <a class="text-white" href="home.html" title="Manga Online">Manga Online</a> 
            <i class="fas fa-angle-double-right"></i> User
        </div>
        <div class="container d-block">
            <div class="row">
                <div class="p-3 col-8 bg-light">
                    <span class="h3">
                        Logged in successfully.<br>
                        Hello <b><?php echo $_SESSION["username"] ?></b>. <br>
                        <a class="text-danger text-decoration-none" href="home.html">Click here</a> go visit our homepage. 
                        <a class="text-danger text-decoration-none" href="home.html">Mangakakalot.com</a>
                    </span>
                </div>
                <?php include('component/aside-login.php') ?>
            </div>
        </div><br>
        <?php include('component/footer.php') ?>
    </body>
</html>
