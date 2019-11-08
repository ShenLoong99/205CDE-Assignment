<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Heaven Defying Sword</title>
        <?php include('component/head.php') ?>
        <style>
            body {
                background: #171717;
            }
            
            .home {
                height: 200px !important;
            }
            
            .path {
                background: #459ba7;
                color: #fff;
            }
            
            .bg {
                background: #000;
            }
            
            .list {
                pointer-events: none;
                width: 400px;
            }
            
            .info-card {
                background: rgb(0,0,0,0.5);
            }
            
            .info_text {
                color: #585858;
            }
            
            .title {
                color: #AEF2AE;
            }
            
            .txt {
                color: #69AE69;
            }
            
            .img {
                background: #A2A2A2;
                color: #000;
            }
            
            .img:hover {
                color: #000;
            }
            
            .img-active {
                background: #459ba7;
                color: #fff;
            }
            
            .img-active:hover {
                color: #fff;
            }
            
            .page-footer {
                background: #459ba7; 
                font-size: 14px;
            }
            
            #myBtn {
                display: none;
                position: fixed;
                bottom: 20px;
                right: 30px;
                z-index: 99;
                font-size: 30px;
                border: none;
                outline: none;
                background: rgb(209, 209, 209, 0.5);
                color: #000;
                cursor: pointer;
                text-align: center;
                width: 50px;
                height: 50px;
                border-radius: 4px;
            }
            
            .link, .link:hover {
                color: green;
            }
            
            .chapter, .recent, .chapter:hover {
                color: green;
            }
            
            .read, .read:hover {
                color: #333;
            }
            
            .info .font {
                font-size: 14px
            }
        </style>
    </head>
    <body>
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v4.0"></script>
        <button onclick="topFunction()" id="myBtn"><i class="fas fa-angle-up fa-lg"></i></button>
        <header>
            <div class="container">
                <a href="home.php" title="Manga Online" class="home">
                    <div style="background: #fff;">
                        <img class="img-responsive mx-auto d-block" src="images/logo.png" alt="Manga Online" title="Manga Online">
                    </div>
                </a>
                <div class="mt-2">
                    <div class="p-2 path mb-2">
                        <a class="text-white" href="home.php" title="Manga Online">Manga Online</a> <i class="fas fa-angle-double-right"></i> 
                        <a class="text-white" href="info.php" title="Heaven Defying Sword">Heaven Defying Sword</a> <i class="fas fa-angle-double-right"></i> 
                        <a class="text-white" href="viewPages.php"> Chapter 67: Complete Defeat</a>
                    </div>
                    <div class="container bg p-2">
                        <div class="container row mb-2">
                            <div class="btn-group">
                                <button type="button" class="btn btn-light btn-sm list">Chapter 67: Complete Defeat</button>
                                <button type="button" class="btn btn-light btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Chapter 67: Complete Defeat</a>
                                    <a class="dropdown-item" href="#">Chapter 67: Complete Defeat</a>
                                    <a class="dropdown-item" href="#">Chapter 67: Complete Defeat</a>
                                    <a class="dropdown-item" href="#">Chapter 67: Complete Defeat</a>
                                    <a class="dropdown-item" href="#">Chapter 67: Complete Defeat</a>
                                    <a class="dropdown-item" href="#">Chapter 67: Complete Defeat</a>
                                    <a class="dropdown-item" href="#">Chapter 67: Complete Defeat</a>
                                    <a class="dropdown-item" href="#">Chapter 67: Complete Defeat</a>
                                    <a class="dropdown-item" href="#">Chapter 67: Complete Defeat</a>
                                    <a class="dropdown-item" href="#">Chapter 67: Complete Defeat</a>
                                </div>
                            </div>
                            <a class="btn btn-success active btn-sm text-white ml-2" href="#">PREV CHAPTER</a>
                            <a class="btn btn-success active btn-sm text-white ml-2" href="#">NEXT CHAPTER</a>
                        </div>
                        <span class="d-inline-block bg-light text-uppercase p-1">
                            <small>Heaven Defying Sword: Chapter 67: Complete Defeat</small>
                        </span>
                    </div>
                </div>
        </header>
        <section class="container">
            <div class="container info-card text-center px-5 py-2 mt-2 mb-2">
                <span class="h3 title">Heaven Defying Sword: Chapter 67: Complete Defeat</span><br>
                <span class="info_text">
                    <small>You're reading <b>Heaven Defying Sword Chapter 67: Complete Defeat</b> at 
                        Mangakakalot.com.<br> Please use the Bookmark button to get notifications about the latest 
                        chapters next time when you come visit Mangakakalot. You can use the F11 button to 
                        <a class="text-white text-decoration-none" href="home.php">read manga</a> 
                        in full-screen(PC only). It will be so grateful if you let Mangakakalot be your favorite manga 
                        site. We hope you'll come join us and become a manga reader in this community!<br> Have a 
                        beautiful day!</small>
                </span><br>
                <span class="txt">Image shows slow or error, you should choose another IMAGE SERVER.</span><br>
                <span class="text-white"><small><b>IMAGE SERVER: </b></small>
                    <a class="img-active p-1 text-decoration-none" href="#">1</a>
                    <a class="img p-1 text-decoration-none" href="#">2</a></span>
            </div>
            <div class="text-center mb-2">
                <img class="mb-2" src="images/manga pages/1.jpg" alt="page 1">
                <img class="mb-2" src="images/manga pages/2.jpg" alt="page 2">
                <img class="mb-2" src="images/manga pages/3.jpg" alt="page 3">
                <img class="mb-2" src="images/manga pages/4.jpg" alt="page 4">
                <img class="mb-2" src="images/manga pages/5.jpg" alt="page 5">
                <img class="mb-2" src="images/manga pages/6.jpg" alt="page 6">
                <img class="mb-2" src="images/manga pages/7.jpg" alt="page 7">
                <img class="mb-2" src="images/manga pages/8.jpg" alt="page 8">
                <img class="mb-2" src="images/manga pages/9.jpg" alt="page 9">
                <img class="mb-2" src="images/manga pages/10.jpg" alt="page 10">
                <img class="mb-2" src="images/manga pages/11.jpg" alt="page 11">
                <img class="mb-2" src="images/manga pages/12.jpg" alt="page 12">
                <img class="mb-2" src="images/manga pages/13.jpg" alt="page 13"><br>
                <a class="mb-2" href="home.php"><img src="images/clickhere2.png" alt="Go Home"></a>
            </div>
            <div class="container">
                <div class="container-fluid bg p-2">
                    <div class="container row">
                        <div class="btn-group">
                            <button type="button" class="btn btn-light btn-sm list">Chapter 67: Complete Defeat</button>
                            <button type="button" class="btn btn-light btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Chapter 67: Complete Defeat</a>
                                <a class="dropdown-item" href="#">Chapter 67: Complete Defeat</a>
                                <a class="dropdown-item" href="#">Chapter 67: Complete Defeat</a>
                                <a class="dropdown-item" href="#">Chapter 67: Complete Defeat</a>
                                <a class="dropdown-item" href="#">Chapter 67: Complete Defeat</a>
                                <a class="dropdown-item" href="#">Chapter 67: Complete Defeat</a>
                                <a class="dropdown-item" href="#">Chapter 67: Complete Defeat</a>
                                <a class="dropdown-item" href="#">Chapter 67: Complete Defeat</a>
                                <a class="dropdown-item" href="#">Chapter 67: Complete Defeat</a>
                                <a class="dropdown-item" href="#">Chapter 67: Complete Defeat</a>
                            </div>
                        </div>
                        <a class="btn btn-success active btn-sm text-white ml-2" href="#">PREV CHAPTER</a>
                        <a class="btn btn-success active btn-sm text-white ml-2" href="#">NEXT CHAPTER</a>
                    </div>
                </div>
                <div class="p-2 path">
                    <a class="text-white" href="home.php">Manga Online</a> <i class="fas fa-angle-double-right"></i> 
                    <a class="text-white" href="info.php">Heaven Defying Sword</a> <i class="fas fa-angle-double-right"></i> 
                    <a class="text-white" href="viewPages.php"> Chapter 67: Complete Defeat</a>
                </div>
                <div class="bg-light p-2">
                    <span>
                        <small>
                            You just finished reading <b>Heaven Defying Sword Chapter 67: Complete Defeat</b> online. 
                            The Bookmark button is a very simple way to get notifications when your favorite manga 
                            have new updates. It's very useful to anyone who loves reading manga. Let's us guide you 
                            to find your best manga to read. And if you find any errors, let us know so we can fix it 
                            as soon as possible!<br> You can support us by leaving comments or just a click on the Like 
                            button!
                        </small>
                    </span><br>
                    <div class="fb-like" data-href="http://localhost:8383/Mangakakalot/viewPages.html" data-width="10px" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div><br>
                    <span><small>Related chapter: </small>
                        <a class="link" href="#">Heaven Defying Sword Chapter 66: Interception</a>, 
                        <a class="link" href="#">Heaven Defying Sword Chapter 68: What a Harvest</a>
                    </span>
                    <div class="fb-comments p-2" data-href="http://localhost:8383/Mangakakalot/info.html" data-width="" data-numposts="10"></div>
                </div>
                <div>
                    <div class="bg-light p-2"><span class="recent h5 text-uppercase"><b>RECENTLY UPDATED MANGA</b></span></div>
                    <div class="card flex-md-row py-3">
                        <div class="col-4">
                            <div class="container-fluid col-sm-4 float-left">
                                <a href="info.html">
                                    <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                                </a>
                            </div>
                            <div class="info">
                                <span class="h6"><a class="text-dark text-decoration-none" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                                <span class="font">
                                    <a href="#" class="text-decoration-none chapter">Chapter 213</a><br>
                                    <i class="fas fa-eye"></i> 3,846,710
                                </span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="container-fluid col-sm-4 float-left">
                                <a href="https://mangakakalot.com/manga/xk919132">
                                    <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                                </a>
                            </div>
                            <div class="info">
                                <span class="h6"><a class="text-dark text-decoration-none" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                                <span class="font">
                                    <a href="#" class="text-decoration-none chapter">Chapter 213</a><br>
                                    <i class="fas fa-eye"></i> 3,846,710
                                </span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="container-fluid col-sm-4 float-left">
                                <a href="https://mangakakalot.com/manga/xk919132">
                                    <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                                </a>
                            </div>
                            <div class="info">
                                <span class="h6"><a class="text-dark text-decoration-none" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                                <span class="font">
                                    <a href="#" class="text-decoration-none chapter">Chapter 213</a><br>
                                    <i class="fas fa-eye"></i> 3,846,710
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card flex-md-row py-3">
                        <div class="col-4">
                            <div class="container-fluid col-sm-4 float-left">
                                <a href="info.html">
                                    <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                                </a>
                            </div>
                            <div class="info">
                                <span class="h6"><a class="text-dark text-decoration-none" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                                <span class="font">
                                    <a href="#" class="text-decoration-none chapter">Chapter 213</a><br>
                                    <i class="fas fa-eye"></i> 3,846,710
                                </span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="container-fluid col-sm-4 float-left">
                                <a href="https://mangakakalot.com/manga/xk919132">
                                    <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                                </a>
                            </div>
                            <div class="info">
                                <span class="h6"><a class="text-dark text-decoration-none" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                                <span class="font">
                                    <a href="#" class="text-decoration-none chapter">Chapter 213</a><br>
                                    <i class="fas fa-eye"></i> 3,846,710
                                </span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="container-fluid col-sm-4 float-left">
                                <a href="https://mangakakalot.com/manga/xk919132">
                                    <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                                </a>
                            </div>
                            <div class="info">
                                <span class="h6"><a class="text-dark text-decoration-none" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                                <span class="font">
                                    <a href="#" class="text-decoration-none chapter">Chapter 213</a><br>
                                    <i class="fas fa-eye"></i> 3,846,710
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card flex-md-row py-3">
                        <div class="col-4">
                            <div class="container-fluid col-sm-4 float-left">
                                <a href="info.html">
                                    <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                                </a>
                            </div>
                            <div class="info">
                                <span class="h6"><a class="text-dark text-decoration-none" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                                <span class="font">
                                    <a href="#" class="text-decoration-none chapter">Chapter 213</a><br>
                                    <i class="fas fa-eye"></i> 3,846,710
                                </span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="container-fluid col-sm-4 float-left">
                                <a href="https://mangakakalot.com/manga/xk919132">
                                    <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                                </a>
                            </div>
                            <div class="info">
                                <span class="h6"><a class="text-dark text-decoration-none" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                                <span class="font">
                                    <a href="#" class="text-decoration-none chapter">Chapter 213</a><br>
                                    <i class="fas fa-eye"></i> 3,846,710
                                </span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="container-fluid col-sm-4 float-left">
                                <a href="https://mangakakalot.com/manga/xk919132">
                                    <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                                </a>
                            </div>
                            <div class="info">
                                <span class="h6"><a class="text-dark text-decoration-none" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                                <span class="font">
                                    <a href="#" class="text-decoration-none chapter">Chapter 213</a><br>
                                    <i class="fas fa-eye"></i> 3,846,710
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card flex-md-row py-3">
                        <div class="col-4">
                            <div class="container-fluid col-sm-4 float-left">
                                <a href="info.html">
                                    <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                                </a>
                            </div>
                            <div class="info">
                                <span class="h6"><a class="text-dark text-decoration-none" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                                <span class="font">
                                    <a href="#" class="text-decoration-none chapter">Chapter 213</a><br>
                                    <i class="fas fa-eye"></i> 3,846,710
                                </span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="container-fluid col-sm-4 float-left">
                                <a href="https://mangakakalot.com/manga/xk919132">
                                    <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                                </a>
                            </div>
                            <div class="info">
                                <span class="h6"><a class="text-dark text-decoration-none" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                                <span class="font">
                                    <a href="#" class="text-decoration-none chapter">Chapter 213</a><br>
                                    <i class="fas fa-eye"></i> 3,846,710
                                </span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="container-fluid col-sm-4 float-left">
                                <a href="https://mangakakalot.com/manga/xk919132">
                                    <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                                </a>
                            </div>
                            <div class="info">
                                <span class="h6"><a class="text-dark text-decoration-none" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                                <span class="font">
                                    <a href="#" class="text-decoration-none chapter">Chapter 213</a><br>
                                    <i class="fas fa-eye"></i> 3,846,710
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card flex-md-row py-3">
                        <div class="col-4">
                            <div class="container-fluid col-sm-4 float-left">
                                <a href="info.html">
                                    <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                                </a>
                            </div>
                            <div class="info">
                                <span class="h6"><a class="text-dark text-decoration-none" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                                <span class="font">
                                    <a href="#" class="text-decoration-none chapter">Chapter 213</a><br>
                                    <i class="fas fa-eye"></i> 3,846,710
                                </span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="container-fluid col-sm-4 float-left">
                                <a href="https://mangakakalot.com/manga/xk919132">
                                    <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                                </a>
                            </div>
                            <div class="info">
                                <span class="h6"><a class="text-dark text-decoration-none" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                                <span class="font">
                                    <a href="#" class="text-decoration-none chapter">Chapter 213</a><br>
                                    <i class="fas fa-eye"></i> 3,846,710
                                </span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="container-fluid col-sm-4 float-left">
                                <a href="https://mangakakalot.com/manga/xk919132">
                                    <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/1846-uy920447.jpg" alt="Heaven Defying Sword">
                                </a>
                            </div>
                            <div class="info">
                                <span class="h6"><a class="text-dark text-decoration-none" href="info.html"><b>Heaven Defying Sword</b></a></span><br>
                                <span class="font">
                                    <a href="#" class="text-decoration-none chapter">Chapter 213</a><br>
                                    <i class="fas fa-eye"></i> 3,846,710
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-light p-2">
                    <span class="recent h5"><b>Heaven Defying Sword Chapter 67: Complete Defeat summary</b></span><br>
                    <span><small>
                            You're reading Heaven Defying Sword. This manga has been translated by Updating. 
                            Author: FengQiDongMan already has 44488 views. <br>If you want to read free manga, come 
                            visit us at anytime. We promise you that we will always bring you the latest, new and 
                            hot manga everyday. In case you don't know, Mangakakalot is a very cool responsive website 
                            and mobile-friendly, which means the images can be auto-resize to fit your pc or mobile 
                            screen. You can experience it by using your smartphone and
                            <a class="read h6 text-decoration-none" href="home.php"><b>read manga online</b></a> right 
                            now. It's manga time!!</small>
                    </span>
                </div>
            </div>
        </section><br>
        <?php include('component/footer.php') ?>
    </body>
</html>
