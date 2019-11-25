<?php 
    session_start();
    require_once 'component/db.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Mangakakalot - Read Manga Online</title>
        <?php include('component/head.php') ?>
        <style>
            .border-w h6 {
                background: #FF4500;
            }
            
            .info a, i {
                font-size: 12px;
            }
            
            .info span a {
                font-size: 14px;
            }
            
            .info small {
                font-size: 9px;
                color: #333;
            }
            
            .more {
                transition: 1s;
            }
            
            .more:hover {
                background: #4ee44e !important;
            }
        </style>
    </head>
    <body>
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v5.0"></script>
        <?php 
            if (isset($_SESSION["logged-in"]) == false) {
                include('component/navbar.php');
            }
            else if ($_SESSION["logged-in"] == true) {
                include('component/login-navbar.php');
            }
        ?>
        <section>
            <div class="container mt-0">
                <?php include('component/carousel.php') ?>
                <div class="row">
                    <div class="col-md-7">
                        <div class="border-top border-w border-primary">
                            <h6 class="d-inline-block bg-primary p-2 text-white">
                                <i class="fas fa-arrow-alt-circle-right"></i> LATEST UPDATES
                            </h6>
                        </div>
                        <?php // declare array 
                            $manga_id = array();
                            $manga_name = array();
                            $image = array();
                            $manga_short = array(); // get home page content
                            $sql = 'SELECT manga_id, manga_name, image FROM manga ORDER BY RAND()';
                            if($result = $con->query($sql)){
                                while($row = $result->fetch_object()){
                                    $manga_id[] = $row->manga_id;
                                    $manga_name[] = $row->manga_name;
                                    $manga = $row->manga_name;
                                    $image[] = $row->image;
                                    if (strlen($manga) > 23) { $manga_short[] = substr($manga, 0, 23).'...'; }
                                    else { $manga_short[] = $manga; }
                                }
                            }
                            else {
                                echo "<script>alert('SQL error! Cannot retrieve data from database!');</script>";
                            }
                            // printing results
                            $a = 0;
                            for ($i = 0; $i < 28; $i++) {
                                echo '<div class="card flex-md-row py-3">';
                                for ($n = 0; $n < 2; $n++) { // printing output
                                    printf('
                                        <div class="col-6">
                                            <div class="container-fluid col-sm-4 float-left">
                                                <a href="info.php?manga_id=%d">
                                                    <img class="card-img-left img-fluid img-responsive img-thumbnail" style="height: 100px;" src="images/manga covers/%s" alt="%s">
                                                </a>
                                            </div>
                                            <div class="info">
                                                <span><a class="text-dark" href="info.php?manga_id=%d" title="%s"><b>%s</b></a></span><br>
                                        ',
                                        $manga_id[$a],
                                        $image[$a],
                                        $manga_name[$a],
                                        $manga_id[$a],
                                        $manga_name[$a],
                                        $manga_short[$a]
                                    );
                                    $sql = "SELECT volume, chapter_no, chapter_name, time_upload FROM chapters WHERE manga_id = '$manga_id[$a]' ORDER BY chapter_no DESC";
                                    if($result = $con->query($sql)){
                                        $b = 0;
                                        while ($row = $result->fetch_object()) {
                                            printf('
                                                <i class="fas fa-angle-double-right"></i>
                                                <a class="text-dark" href="viewPages.php?manga_id=%d&chapter=%d" title="Chapter %d %s">%s CHAPTER %d</a>
                                                <span class="float-right"><small>%s</small></span><br>
                                                ',
                                                $manga_id[$a],
                                                $row->chapter_no,
                                                $row->chapter_no,
                                                $row->chapter_name,
                                                $row->volume,
                                                $row->chapter_no,
                                                substr($row->time_upload, 5, 5));
                                            $b++;
                                            if ($b == 3) {
                                                break;
                                            }
                                        }
                                    }
                                    $a++;
                                    echo '</div>';
                                    echo '</div>';
                                }
                                echo '</div>';
                            }
                        ?>
                        <a class="text-white text-decoration-none" href="general.php?type=All&category=All&status=All">
                            <div class="bg-primary p-3 d-block text-center more">
                                More <i class="fas fa-arrow-alt-circle-right fa-lg"></i>
                            </div>
                        </a>
                    </div>
                    <?php include('component/aside.php') ?>
                </div>
            </div>
        </section><br>
        <?php include('component/footer.php') ?>
    </body>
</html>