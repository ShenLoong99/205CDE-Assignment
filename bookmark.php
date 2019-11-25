<?php
    session_start();
    $bookmark = 0;
    require_once 'component/db.php';
    $manga_id = array();
    $image = array();
    $manga = array();
    $view_chap = array();
    $up_chap = array();
    $sql = "SELECT m.image, m.manga_name, l.manga_id, l.current_chap FROM library l, manga m WHERE l.id = ".$_SESSION["id"]." AND m.manga_id = l.manga_id AND bookmark = true";
    if ($result = $con->query($sql)) {
        while($row = $result->fetch_object()){
            $manga_id[] = $row->manga_id;
            $image[] = $row->image;
            $manga[] = $row->manga_name;
            if ($row->current_chap != null) { $view_chap[] = $row->current_chap; } 
            else { $view_chap[] = 1; }
            $chap_sql = "SELECT chapter_no FROM chapters WHERE manga_id = $row->manga_id ORDER BY chapter_no DESC LIMIT 1";
            $answer = $con->query($chap_sql);
            while($chap_row = $answer->fetch_object()){
                $up_chap[] = $chap_row->chapter_no;
            }
            $bookmark = 1;
        }
    }
    
    // clean database
    $sql = "DELETE FROM library WHERE bookmark = false AND rate = false AND history = false";
    $con->query($sql);
    
    if(isset($_POST['del_but'])){
        $del_id = $_POST["del_but"];
        $sql = "UPDATE library SET bookmark = false WHERE manga_id = $del_id AND id = ".$_SESSION["id"]."";
        $con->query($sql);
        header('Location: '.$_SERVER['REQUEST_URI']);
    }
?>

<!DOCTYPE html>
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
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v5.0"></script>
        <?php include('component/login-navbar.php') ?>
        <div class="container mt-0">
            <?php include('component/carousel.php') ?>
            <div class="row">
                <div class="col-md-7">
                    <div class="p-2 path mb-2 text-white">
                        <a class="text-white" href="home.html" title="Manga Online">Manga Online</a> <i class="fas fa-angle-double-right"></i> 
                        <a class="text-white" href="bookmark.html">Bookmark</a>
                    </div>
                    <?php 
                        if ($bookmark == 1) {
                            for ($i = 0; $i < sizeof($manga); $i++) {
                                printf('<div class="card">
                                            <div class="py-3 pr-3 border-left border-success border-w">
                                                <div class="container-fluid col-sm-2 float-left">
                                                    <a href="info.php?manga_id=%d">
                                                        <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/%s" alt="%s">
                                                    </a>
                                                </div>
                                                <div class="info">
                                                    <a class="h5 text-success text-decoration-none" href="info.php?manga_id=%d">%s</a>
                                                    <form name="myform" class="float-right" method="post"><button class="btn btn-default text-danger" name="del_but" value="%d">Remove</button></form><br>
                                                    <span>Viewed: <a class="text-decoration-none text-success" href="viewPages.php?manga_id=%d&chapter=%d">Chapter %d</a></span><br>
                                                    <span>Current: <a class="text-decoration-none text-success" href="viewPages.php?manga_id=%d&chapter=%d">Chapter %d</a></span>
                                                </div>
                                            </div>
                                        </div>
                                        ', $manga_id[$i],
                                        $image[$i], 
                                        $manga[$i],
                                        $manga_id[$i],
                                        $manga[$i],
                                        $manga_id[$i],
                                        $manga_id[$i],
                                        $view_chap[$i],
                                        $view_chap[$i],
                                        $manga_id[$i],
                                        $up_chap[$i],
                                        $up_chap[$i]);
                            }
                        }
                        else {
                            echo '<div class="card">
                                    <div class="p-5 border-left border-success border-w">
                                        <div class="info text-center">
                                            <span class="font-weight-bold" style="color: #FF4500;">It is so empty here... &#128546; &#128546;</span>
                                        </div>
                                    </div>
                                  </div>';
                        }
                    ?>
                </div>
                <?php include('component/aside.php') ?>
            </div>
        </div>
        <?php include('component/footer.php') ?>
    </body>
</html>
