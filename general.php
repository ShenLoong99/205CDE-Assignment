<?php session_start() ?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            Online Manga List - 
            <?php 
                if($_GET['status'] != "All") { 
                    echo($_GET['status']);
                } else if ($_GET['category'] != "All") {
                    echo ($_GET['category']);
                } else if ($_GET['category'] == "All" && $_GET['status'] == "All") {
                    echo ($_GET['category']);
                } else {
                    echo ($_GET['type']);
                }
            ?>
        </title>
        <?php include('component/head.php') ?>
        <style>
            .border-w h6 {
                background: #FF4500;
            }
            
            .font {
                font-size: 14px;
            }
            
            a.link {
                color: #FF4500;
            }
            
            nav.float-right {
                background: transparent !important;
            }
            
            nav.float-right li a:hover {
                color: blue !important;
            }
        </style>
    </head>
    <body>
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v4.0"></script>
        <?php 
            if (isset($_SESSION["logged-in"]) == false) {
                include('component/navbar.php');
            }
            else if ($_SESSION["logged-in"] == true) {
                include('component/login-navbar.php');
            }
        ?>
        <div class="container mt-0">
            <?php include('component/carousel.php') ?>
            <div class="text-white bg-primary p-2 mb-2">
                <a class="text-white" href="home.php" title="Manga Online">Manga Online</a> <i class="fas fa-angle-double-right"></i> 
                <a class="text-white" href="general.php?type=Latest&category=<?php echo($_GET['category'])?>&status=All">Category: <?php echo($_GET['category']) ?></a> <i class="fas fa-angle-double-right"></i>
                <a class="text-white" href="general.php?type=Latest&category=All&status=<?php echo($_GET['status'])?>">Status: <?php echo($_GET['status']) ?></a> <i class="fas fa-angle-double-right"></i>
                <a class="text-white" href="general.php?type=<?php echo($_GET['type'])?>&category=All&status=All"><?php echo($_GET['type']) ?></a> <i class="fas fa-angle-double-right"></i> 
                <span class="text-white">Page 1</span>
            </div>
            <div class="card flex-md-row py-3">
                <div class="col-6">
                    <div class="container-fluid col-sm-4 float-left">
                        <a href="info.html">
                            <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                        </a>
                    </div>
                    <div class="info">
                        <span class="h5"><a class="text-dark" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                        <span class="font">
                            <a href="" class="text-decoration-none" >Chapter 213</a><br>
                            <i class="fas fa-eye"></i> 3,846,710<br>
                            Witches suddenly declare war against humans, causing two-thirds of the world to fall 
                            apart. They summon monsters called "Supporters" and devastate human residences but why? 
                            Survivors gather people with the power to combat <small><a class="link" href="">more</a></small>
                        </span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="container-fluid col-sm-4 float-left">
                        <a href="https://mangakakalot.com/manga/xk919132">
                            <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                        </a>
                    </div>
                    <div class="info">
                        <span class="h5"><a class="text-dark" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                        <span class="font">
                            <a href="" class="text-decoration-none" >Chapter 213</a><br>
                            <i class="fas fa-eye"></i> 3,846,710<br>
                            Witches suddenly declare war against humans, causing two-thirds of the world to fall 
                            apart. They summon monsters called "Supporters" and devastate human residences but why? 
                            Survivors gather people with the power to combat <small><a class="link" href="">more</a></small>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card flex-md-row py-3">
                <div class="col-6">
                    <div class="container-fluid col-sm-4 float-left">
                        <a href="https://mangakakalot.com/manga/xk919132">
                            <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                        </a>
                    </div>
                    <div class="info">
                        <span class="h5"><a class="text-dark" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                        <span class="font">
                            <a href="" class="text-decoration-none" >Chapter 213</a><br>
                            <i class="fas fa-eye"></i> 3,846,710<br>
                            Witches suddenly declare war against humans, causing two-thirds of the world to fall 
                            apart. They summon monsters called "Supporters" and devastate human residences but why? 
                            Survivors gather people with the power to combat <small><a class="link" href="">more</a></small>
                        </span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="container-fluid col-sm-4 float-left">
                        <a href="https://mangakakalot.com/manga/xk919132">
                            <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                        </a>
                    </div>
                    <div class="info">
                        <span class="h5"><a class="text-dark" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                        <span class="font">
                            <a href="" class="text-decoration-none" >Chapter 213</a><br>
                            <i class="fas fa-eye"></i> 3,846,710<br>
                            Witches suddenly declare war against humans, causing two-thirds of the world to fall 
                            apart. They summon monsters called "Supporters" and devastate human residences but why? 
                            Survivors gather people with the power to combat <small><a class="link" href="">more</a></small>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card flex-md-row py-3">
                <div class="col-6">
                    <div class="container-fluid col-sm-4 float-left">
                        <a href="https://mangakakalot.com/manga/xk919132">
                            <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                        </a>
                    </div>
                    <div class="info">
                        <span class="h5"><a class="text-dark" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                        <span class="font">
                            <a href="" class="text-decoration-none" >Chapter 213</a><br>
                            <i class="fas fa-eye"></i> 3,846,710<br>
                            Witches suddenly declare war against humans, causing two-thirds of the world to fall 
                            apart. They summon monsters called "Supporters" and devastate human residences but why? 
                            Survivors gather people with the power to combat <small><a class="link" href="">more</a></small>
                        </span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="container-fluid col-sm-4 float-left">
                        <a href="https://mangakakalot.com/manga/xk919132">
                            <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                        </a>
                    </div>
                    <div class="info">
                        <span class="h5"><a class="text-dark" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                        <span class="font">
                            <a href="" class="text-decoration-none" >Chapter 213</a><br>
                            <i class="fas fa-eye"></i> 3,846,710<br>
                            Witches suddenly declare war against humans, causing two-thirds of the world to fall 
                            apart. They summon monsters called "Supporters" and devastate human residences but why? 
                            Survivors gather people with the power to combat <small><a class="link" href="">more</a></small>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card flex-md-row py-3">
                <div class="col-6">
                    <div class="container-fluid col-sm-4 float-left">
                        <a href="https://mangakakalot.com/manga/xk919132">
                            <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                        </a>
                    </div>
                    <div class="info">
                        <span class="h5"><a class="text-dark" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                        <span class="font">
                            <a href="" class="text-decoration-none" >Chapter 213</a><br>
                            <i class="fas fa-eye"></i> 3,846,710<br>
                            Witches suddenly declare war against humans, causing two-thirds of the world to fall 
                            apart. They summon monsters called "Supporters" and devastate human residences but why? 
                            Survivors gather people with the power to combat <small><a class="link" href="">more</a></small>
                        </span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="container-fluid col-sm-4 float-left">
                        <a href="https://mangakakalot.com/manga/xk919132">
                            <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                        </a>
                    </div>
                    <div class="info">
                        <span class="h5"><a class="text-dark" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                        <span class="font">
                            <a href="" class="text-decoration-none" >Chapter 213</a><br>
                            <i class="fas fa-eye"></i> 3,846,710<br>
                            Witches suddenly declare war against humans, causing two-thirds of the world to fall 
                            apart. They summon monsters called "Supporters" and devastate human residences but why? 
                            Survivors gather people with the power to combat <small><a class="link" href="">more</a></small>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card flex-md-row py-3">
                <div class="col-6">
                    <div class="container-fluid col-sm-4 float-left">
                        <a href="https://mangakakalot.com/manga/xk919132">
                            <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                        </a>
                    </div>
                    <div class="info">
                        <span class="h5"><a class="text-dark" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                        <span class="font">
                            <a href="" class="text-decoration-none" >Chapter 213</a><br>
                            <i class="fas fa-eye"></i> 3,846,710<br>
                            Witches suddenly declare war against humans, causing two-thirds of the world to fall 
                            apart. They summon monsters called "Supporters" and devastate human residences but why? 
                            Survivors gather people with the power to combat <small><a class="link" href="">more</a></small>
                        </span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="container-fluid col-sm-4 float-left">
                        <a href="https://mangakakalot.com/manga/xk919132">
                            <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                        </a>
                    </div>
                    <div class="info">
                        <span class="h5"><a class="text-dark" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                        <span class="font">
                            <a href="" class="text-decoration-none" >Chapter 213</a><br>
                            <i class="fas fa-eye"></i> 3,846,710<br>
                            Witches suddenly declare war against humans, causing two-thirds of the world to fall 
                            apart. They summon monsters called "Supporters" and devastate human residences but why? 
                            Survivors gather people with the power to combat <small><a class="link" href="">more</a></small>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card flex-md-row py-3">
                <div class="col-6">
                    <div class="container-fluid col-sm-4 float-left">
                        <a href="https://mangakakalot.com/manga/xk919132">
                            <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                        </a>
                    </div>
                    <div class="info">
                        <span class="h5"><a class="text-dark" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                        <span class="font">
                            <a href="" class="text-decoration-none" >Chapter 213</a><br>
                            <i class="fas fa-eye"></i> 3,846,710<br>
                            Witches suddenly declare war against humans, causing two-thirds of the world to fall 
                            apart. They summon monsters called "Supporters" and devastate human residences but why? 
                            Survivors gather people with the power to combat <small><a class="link" href="">more</a></small>
                        </span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="container-fluid col-sm-4 float-left">
                        <a href="https://mangakakalot.com/manga/xk919132">
                            <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                        </a>
                    </div>
                    <div class="info">
                        <span class="h5"><a class="text-dark" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                        <span class="font">
                            <a href="" class="text-decoration-none" >Chapter 213</a><br>
                            <i class="fas fa-eye"></i> 3,846,710<br>
                            Witches suddenly declare war against humans, causing two-thirds of the world to fall 
                            apart. They summon monsters called "Supporters" and devastate human residences but why? 
                            Survivors gather people with the power to combat <small><a class="link" href="">more</a></small>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card flex-md-row py-3">
                <div class="col-6">
                    <div class="container-fluid col-sm-4 float-left">
                        <a href="https://mangakakalot.com/manga/xk919132">
                            <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                        </a>
                    </div>
                    <div class="info">
                        <span class="h5"><a class="text-dark" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                        <span class="font">
                            <a href="" class="text-decoration-none" >Chapter 213</a><br>
                            <i class="fas fa-eye"></i> 3,846,710<br>
                            Witches suddenly declare war against humans, causing two-thirds of the world to fall 
                            apart. They summon monsters called "Supporters" and devastate human residences but why? 
                            Survivors gather people with the power to combat <small><a class="link" href="">more</a></small>
                        </span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="container-fluid col-sm-4 float-left">
                        <a href="https://mangakakalot.com/manga/xk919132">
                            <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                        </a>
                    </div>
                    <div class="info">
                        <span class="h5"><a class="text-dark" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                        <span class="font">
                            <a href="" class="text-decoration-none" >Chapter 213</a><br>
                            <i class="fas fa-eye"></i> 3,846,710<br>
                            Witches suddenly declare war against humans, causing two-thirds of the world to fall 
                            apart. They summon monsters called "Supporters" and devastate human residences but why? 
                            Survivors gather people with the power to combat <small><a class="link" href="">more</a></small>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card flex-md-row py-3">
                <div class="col-6">
                    <div class="container-fluid col-sm-4 float-left">
                        <a href="https://mangakakalot.com/manga/xk919132">
                            <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                        </a>
                    </div>
                    <div class="info">
                        <span class="h5"><a class="text-dark" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                        <span class="font">
                            <a href="" class="text-decoration-none" >Chapter 213</a><br>
                            <i class="fas fa-eye"></i> 3,846,710<br>
                            Witches suddenly declare war against humans, causing two-thirds of the world to fall 
                            apart. They summon monsters called "Supporters" and devastate human residences but why? 
                            Survivors gather people with the power to combat <small><a class="link" href="">more</a></small>
                        </span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="container-fluid col-sm-4 float-left">
                        <a href="https://mangakakalot.com/manga/xk919132">
                            <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                        </a>
                    </div>
                    <div class="info">
                        <span class="h5"><a class="text-dark" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                        <span class="font">
                            <a href="" class="text-decoration-none" >Chapter 213</a><br>
                            <i class="fas fa-eye"></i> 3,846,710<br>
                            Witches suddenly declare war against humans, causing two-thirds of the world to fall 
                            apart. They summon monsters called "Supporters" and devastate human residences but why? 
                            Survivors gather people with the power to combat <small><a class="link" href="">more</a></small>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card flex-md-row py-3">
                <div class="col-6">
                    <div class="container-fluid col-sm-4 float-left">
                        <a href="https://mangakakalot.com/manga/xk919132">
                            <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                        </a>
                    </div>
                    <div class="info">
                        <span class="h5"><a class="text-dark" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                        <span class="font">
                            <a href="" class="text-decoration-none" >Chapter 213</a><br>
                            <i class="fas fa-eye"></i> 3,846,710<br>
                            Witches suddenly declare war against humans, causing two-thirds of the world to fall 
                            apart. They summon monsters called "Supporters" and devastate human residences but why? 
                            Survivors gather people with the power to combat <small><a class="link" href="">more</a></small>
                        </span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="container-fluid col-sm-4 float-left">
                        <a href="https://mangakakalot.com/manga/xk919132">
                            <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                        </a>
                    </div>
                    <div class="info">
                        <span class="h5"><a class="text-dark" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                        <span class="font">
                            <a href="" class="text-decoration-none" >Chapter 213</a><br>
                            <i class="fas fa-eye"></i> 3,846,710<br>
                            Witches suddenly declare war against humans, causing two-thirds of the world to fall 
                            apart. They summon monsters called "Supporters" and devastate human residences but why? 
                            Survivors gather people with the power to combat <small><a class="link" href="">more</a></small>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card flex-md-row py-3">
                <div class="col-6">
                    <div class="container-fluid col-sm-4 float-left">
                        <a href="https://mangakakalot.com/manga/xk919132">
                            <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                        </a>
                    </div>
                    <div class="info">
                        <span class="h5"><a class="text-dark" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                        <span class="font">
                            <a href="" class="text-decoration-none" >Chapter 213</a><br>
                            <i class="fas fa-eye"></i> 3,846,710<br>
                            Witches suddenly declare war against humans, causing two-thirds of the world to fall 
                            apart. They summon monsters called "Supporters" and devastate human residences but why? 
                            Survivors gather people with the power to combat <small><a class="link" href="">more</a></small>
                        </span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="container-fluid col-sm-4 float-left">
                        <a href="https://mangakakalot.com/manga/xk919132">
                            <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                        </a>
                    </div>
                    <div class="info">
                        <span class="h5"><a class="text-dark" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                        <span class="font">
                            <a href="" class="text-decoration-none" >Chapter 213</a><br>
                            <i class="fas fa-eye"></i> 3,846,710<br>
                            Witches suddenly declare war against humans, causing two-thirds of the world to fall 
                            apart. They summon monsters called "Supporters" and devastate human residences but why? 
                            Survivors gather people with the power to combat <small><a class="link" href="">more</a></small>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card flex-md-row py-3">
                <div class="col-6">
                    <div class="container-fluid col-sm-4 float-left">
                        <a href="https://mangakakalot.com/manga/xk919132">
                            <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                        </a>
                    </div>
                    <div class="info">
                        <span class="h5"><a class="text-dark" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                        <span class="font">
                            <a href="" class="text-decoration-none" >Chapter 213</a><br>
                            <i class="fas fa-eye"></i> 3,846,710<br>
                            Witches suddenly declare war against humans, causing two-thirds of the world to fall 
                            apart. They summon monsters called "Supporters" and devastate human residences but why? 
                            Survivors gather people with the power to combat <small><a class="link" href="">more</a></small>
                        </span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="container-fluid col-sm-4 float-left">
                        <a href="https://mangakakalot.com/manga/xk919132">
                            <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                        </a>
                    </div>
                    <div class="info">
                        <span class="h5"><a class="text-dark" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                        <span class="font">
                            <a href="" class="text-decoration-none" >Chapter 213</a><br>
                            <i class="fas fa-eye"></i> 3,846,710<br>
                            Witches suddenly declare war against humans, causing two-thirds of the world to fall 
                            apart. They summon monsters called "Supporters" and devastate human residences but why? 
                            Survivors gather people with the power to combat <small><a class="link" href="">more</a></small>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card flex-md-row py-3">
                <div class="col-6">
                    <div class="container-fluid col-sm-4 float-left">
                        <a href="https://mangakakalot.com/manga/xk919132">
                            <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                        </a>
                    </div>
                    <div class="info">
                        <span class="h5"><a class="text-dark" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                        <span class="font">
                            <a href="" class="text-decoration-none" >Chapter 213</a><br>
                            <i class="fas fa-eye"></i> 3,846,710<br>
                            Witches suddenly declare war against humans, causing two-thirds of the world to fall 
                            apart. They summon monsters called "Supporters" and devastate human residences but why? 
                            Survivors gather people with the power to combat <small><a class="link" href="">more</a></small>
                        </span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="container-fluid col-sm-4 float-left">
                        <a href="https://mangakakalot.com/manga/xk919132">
                            <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                        </a>
                    </div>
                    <div class="info">
                        <span class="h5"><a class="text-dark" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                        <span class="font">
                            <a href="" class="text-decoration-none" >Chapter 213</a><br>
                            <i class="fas fa-eye"></i> 3,846,710<br>
                            Witches suddenly declare war against humans, causing two-thirds of the world to fall 
                            apart. They summon monsters called "Supporters" and devastate human residences but why? 
                            Survivors gather people with the power to combat <small><a class="link" href="">more</a></small>
                        </span>
                    </div>
                </div>
            </div>
            <span class="d-inline-block bg-primary p-2 text-white" style="font-size: 13px;">Total: 24,189 STORIES</span>
            <nav class="float-right" aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
            <?php include('component/table-genres.php') ?>
            <div class="fb-comments bg-light p-2" data-href="http://localhost:8383/Mangakakalot/info.html" data-width="100%" data-numposts="10"></div>
        </div><br>
        <?php include('component/footer.php') ?>
    </body>
</html>
