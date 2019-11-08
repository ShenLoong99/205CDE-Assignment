<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Bookmark</title>
        <?php include('component/head.php') ?>
        <style>
            .border-w h6 {
                background: #FF4500;
            }
        </style>
    </head>
    <body>
        <?php include('component/login-navbar.php') ?>
        <div class="container mt-0">
            <?php include('component/carousel.php') ?>
            <div class="row">
                <div class="col-md-7">
                    <div class="p-2 path mb-2 text-white">
                        <a class="text-white" href="home.html" title="Manga Online">Manga Online</a> <i class="fas fa-angle-double-right"></i> 
                        <a class="text-white" href="bookmark.html">Bookmark</a>
                    </div>
                    <div class="card">
                        <div class="py-3 pr-3 border-left border-success border-w">
                            <div class="container-fluid col-sm-2 float-left">
                                <a href="info.html">
                                    <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                                </a>
                            </div>
                            <div class="info">
                                <a class="h5 text-success text-decoration-none" href="#">Heaven Defying Sword</a>
                                <a class="text-decoration-none text-danger float-right" href="#">Remove</a><br>
                                <span>Viewed: <a class="text-decoration-none text-success" href="#">Chapter 198</a></span><br>
                                <span>Current: <a class="text-decoration-none text-success" href="#">Chapter 198</a></span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include('component/aside.php') ?>
            </div>
        </div>
        <?php include('component/footer.php') ?>
    </body>
</html>
