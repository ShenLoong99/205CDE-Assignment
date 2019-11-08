<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Search result</title>
        <?php include('component/head.php') ?>
        <style>
            .border-w h6 {
                background: #FF4500;
            }
        </style>
    </head>
    <body>
        <?php include('component/navbar.php') ?>
        <section>
            <div class="container mt-0">
                <?php include('component/carousel.php') ?>
                <div class="row">
                    <div class="col-md-7">
                        <div class="bg-primary p-2">
                            <span class="text-white">
                                <a class="text-white" href="home.html" title="Manga Online">Manga Online</a> <i class="fas fa-angle-double-right"></i> 
                                Search
                            </span>
                        </div><br>
                        <div class="border-top border-w border-primary">
                            <h6 class="d-inline-block bg-primary p-2 text-white">
                                <i class="fas fa-arrow-alt-circle-right"></i> Keyword ***: ***
                            </h6>
                        </div>
                        <div class="card py-3">
                            <div class="col-12">
                                <div class="container-fluid col-sm-4 float-left">
                                    <a href="info.html">
                                        <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                                    </a>
                                </div>
                                <div class="info">
                                    <span><a class="text-dark" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                                    <i class="fas fa-angle-double-right"></i>
                                    <a class="text-dark" href="https://mangakakalot.com/chapter/xk919132/chapter_56" title="Chapter 56: Immortal Doing Evil">CHAPTER 56</a>
                                    <span class="float-right"><small>47 mins ago</small></span><br>
                                    <i class="fas fa-angle-double-right"></i>
                                    <a class="text-dark" href="https://mangakakalot.com/chapter/xk919132/chapter_56" title="Chapter 56: Immortal Doing Evil">CHAPTER 56</a>
                                    <span class="float-right"><small>47 mins ago</small></span><br>
                                    <i class="fas fa-angle-double-right"></i>
                                    <a class="text-dark" href="https://mangakakalot.com/chapter/xk919132/chapter_56" title="Chapter 56: Immortal Doing Evil">CHAPTER 56</a>
                                    <span class="float-right"><small>47 mins ago</small></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php include('component/aside.php') ?>
                </div>
            </div>
        </section>
        <?php include('component/footer.php') ?>
    </body>
</html>
