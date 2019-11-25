<?php 
    session_start();
    if (isset($_GET['pageno'])) { $pageno = $_GET['pageno']; }
    else { $pageno = 1; }
    $no_of_records_per_page = 24;
    $offset = ($pageno-1) * $no_of_records_per_page; 
    require_once 'component/db.php';
?>
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
                <a class="text-white" href="general.php?type=All&category=<?php echo($_GET['category'])?>&status=All">Category: <?php echo($_GET['category']) ?></a> <i class="fas fa-angle-double-right"></i>
                <a class="text-white" href="general.php?type=All&category=All&status=<?php echo($_GET['status'])?>">Status: <?php echo($_GET['status']) ?></a> <i class="fas fa-angle-double-right"></i>
                <a class="text-white" href="general.php?type=<?php echo($_GET['type'])?>&category=All&status=All"><?php echo($_GET['type']) ?></a> <i class="fas fa-angle-double-right"></i> 
                <span class="text-white">Page <?php echo $pageno ?></span>
            </div>
            <?php
                $category = $_GET['category'];
                $status = $_GET['status'];
                $type = $_GET['type'];
                $manga_id = array();
                $manga_name = array();
                $views = array();
                $image = array();
                $manga_short = array();
                $desc = array();
                $i = 0;
                if ($category != "All") { // when certain category is clicked
                    $sql = "SELECT COUNT(gl.manga_id) FROM genre_list gl, genres g WHERE g.genre = '$category' AND gl.genre_id = g.genre_id";
                    $result = mysqli_query($con, $sql);
                    $total_rows = mysqli_fetch_array($result)[0];
                    $total_pages = ceil($total_rows / $no_of_records_per_page);
                    $sql = "SELECT m.manga_id, m.manga_name, m.views, m.image, m.description FROM manga m, genre_list gl, genres g WHERE g.genre = '$category' AND gl.genre_id = g.genre_id AND gl.manga_id = m.manga_id LIMIT $offset, $no_of_records_per_page";
                    $result = $con->query($sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = $result->fetch_object()){
                            $manga_id[] = $row->manga_id;
                            $manga_name[] = $row->manga_name;
                            $views[] = $row->views;
                            $image[] = $row->image;
                            $desc[] = $row->description;
                            if (strlen($row->manga_name) > 40) { $manga_short[] = substr($row->manga_name, 0, 40).'...'; }
                            else { $manga_short[] = $row->manga_name; }
                        }
                        while ($i < mysqli_num_rows($result)) {
                            echo '<div class="card flex-md-row py-3">';
                            for ($n = 0; $n < 2; $n++) { // print 2 records per row
                                printf(' 
                                        <div class="col-6">
                                            <div class="container-fluid col-sm-4 float-left">
                                                <a href="info.php?manga_id=%d">
                                                    <img class="card-img-left img-fluid img-responsive img-thumbnail" style="height: 200px;" src="images/manga covers/%s" alt="%s">
                                                </a>
                                            </div>
                                            <div class="info d-inline w-60">
                                                <span><a class="text-dark" href="info.php?manga_id=%d" title="%s"><b>%s</b></a></span><br>
                                        ',
                                        $manga_id[$i], //from here, print basic info
                                        $image[$i],
                                        $manga_name[$i],
                                        $manga_id[$i],
                                        $manga_name[$i],
                                        $manga_short[$i]
                                    );
                                $chapter_sql = "SELECT volume, chapter_no, chapter_name FROM chapters "
                                        . "WHERE manga_id = '$manga_id[$i]' ORDER BY chapter_no DESC LIMIT 1";
                                if($answer = $con->query($chapter_sql)){ // print chapters
                                    while ($chapter_row = $answer->fetch_object()) {
                                        printf('
                                            <small><a class="chapter text-primary text-decoration-none" href="viewPages.php?manga_id=%d&chapter=%d" title="Chapter %d %s">%s CHAPTER %d</a></small><br>
                                            ',
                                            $manga_id[$i],
                                            $chapter_row->chapter_no,
                                            $chapter_row->chapter_no,
                                            $chapter_row->chapter_name,
                                            $chapter_row->volume,
                                            $chapter_row->chapter_no
                                        );
                                    }
                                } // print end, last updated & views
                                printf('<small><i class="fas fa-eye"></i> %d</small><br>', $views[$i]);
                                if (strlen($desc[$i]) > 330) {
                                    printf('<p class="text-justify"><small>%s</small><small><a class="link" href="info.php?manga_id=%d">more</a></small></p>', substr($desc[$i], 0, 330), $manga_id[$i]);
                                } else {
                                    printf('<p class="text-justify"><small>%s</small> <small><a class="link" href="info.php?manga_id=%d">more</a></small></p>', $desc[$i], $manga_id[$i]);
                                }
                                echo '</div>';
                                echo '</div>';
                                $i++;
                                if ($i >= mysqli_num_rows($result)) { break; }
                            }
                            echo '</div>';
                        }
                    }
                    else {
                        echo '<div class="card p-5 text-center">';
                        echo '<span class="font-weight-bold" style="color: #FF4500;">Sorry no manga with such category or genre is found.</span>';
                        echo '</div>';
                    }
                }
                else if ($status != 'All') { // when certain status is clicked
                    $sql = "SELECT COUNT(manga_id) FROM manga WHERE status = '$status'";
                    $result = mysqli_query($con, $sql);
                    $total_rows = mysqli_fetch_array($result)[0];
                    $total_pages = ceil($total_rows / $no_of_records_per_page);
                    $sql = "SELECT manga_id, manga_name, views, image, description FROM manga WHERE status = '$status' LIMIT $offset, $no_of_records_per_page";
                    $result = $con->query($sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = $result->fetch_object()){
                            $manga_id[] = $row->manga_id;
                            $manga_name[] = $row->manga_name;
                            $views[] = $row->views;
                            $image[] = $row->image;
                            $desc[] = $row->description;
                            if (strlen($row->manga_name) > 40) { $manga_short[] = substr($row->manga_name, 0, 40).'...'; }
                            else { $manga_short[] = $row->manga_name; }
                        }
                        while ($i < mysqli_num_rows($result)) {
                            echo '<div class="card flex-md-row py-3">';
                            for ($n = 0; $n < 2; $n++) { // print 2 records per row
                                printf(' 
                                        <div class="col-6">
                                            <div class="container-fluid col-sm-4 float-left">
                                                <a href="info.php?manga_id=%d">
                                                    <img class="card-img-left img-fluid img-responsive img-thumbnail" style="height: 200px;" src="images/manga covers/%s" alt="%s">
                                                </a>
                                            </div>
                                            <div class="info d-inline w-60">
                                                <span><a class="text-dark" href="info.php?manga_id=%d" title="%s"><b>%s</b></a></span><br>
                                        ',
                                        $manga_id[$i], //from here, print basic info
                                        $image[$i],
                                        $manga_name[$i],
                                        $manga_id[$i],
                                        $manga_name[$i],
                                        $manga_short[$i]
                                    );
                                $chapter_sql = "SELECT volume, chapter_no, chapter_name FROM chapters "
                                        . "WHERE manga_id = '$manga_id[$i]' ORDER BY chapter_no DESC LIMIT 1";
                                if($answer = $con->query($chapter_sql)){ // print chapters
                                    while ($chapter_row = $answer->fetch_object()) {
                                        printf('
                                            <small><a class="chapter text-primary text-decoration-none" href="viewPages.php?manga_id=%d&chapter=%d" title="Chapter %d %s">%s CHAPTER %d</a></small><br>
                                            ',
                                            $manga_id[$i],
                                            $chapter_row->chapter_no,
                                            $chapter_row->chapter_no,
                                            $chapter_row->chapter_name,
                                            $chapter_row->volume,
                                            $chapter_row->chapter_no
                                        );
                                    }
                                } // print end, last updated & views
                                printf('<small><i class="fas fa-eye"></i> %d</small><br>', $views[$i]);
                                if (strlen($desc[$i]) > 330) {
                                    printf('<p class="text-justify"><small>%s</small><small><a class="link" href="info.php?manga_id=%d">more</a></small></p>', substr($desc[$i], 0, 330), $manga_id[$i]);
                                } else {
                                    printf('<p class="text-justify"><small>%s</small> <small><a class="link" href="info.php?manga_id=%d">more</a></small></p>', $desc[$i], $manga_id[$i]);
                                }
                                echo '</div>';
                                echo '</div>';
                                $i++;
                                if ($i >= mysqli_num_rows($result)) { break; }
                            }
                            echo '</div>';
                        }
                    }
                    else {
                        echo '<div class="card p-5 text-center">';
                        echo '<span class="font-weight-bold" style="color: #FF4500;">Sorry no manga with such status is found.</span>';
                        echo '</div>';
                    }
                }
                else if ($type != "All") { // when certain type is clicked
                    $sql = "SELECT COUNT(tl.manga_id) FROM type_list tl, type t WHERE t.type_name = '$type' AND tl.type_id = t.type_id";
                    $result = mysqli_query($con, $sql);
                    $total_rows = mysqli_fetch_array($result)[0];
                    $total_pages = ceil($total_rows / $no_of_records_per_page);
                    $sql = "SELECT m.manga_id, m.manga_name, m.views, m.image, m.description FROM manga m, type_list tl, type t WHERE t.type_name = '$type' AND tl.type_id = t.type_id AND m.manga_id = tl.manga_id LIMIT $offset, $no_of_records_per_page";
                    $result = $con->query($sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = $result->fetch_object()){
                            $manga_id[] = $row->manga_id;
                            $manga_name[] = $row->manga_name;
                            $views[] = $row->views;
                            $image[] = $row->image;
                            $desc[] = $row->description;
                            if (strlen($row->manga_name) > 40) { $manga_short[] = substr($row->manga_name, 0, 40).'...'; }
                            else { $manga_short[] = $row->manga_name; }
                        }
                        while ($i < mysqli_num_rows($result)) {
                            echo '<div class="card flex-md-row py-3">';
                            for ($n = 0; $n < 2; $n++) { // print 2 records per row
                                printf(' 
                                        <div class="col-6">
                                            <div class="container-fluid col-sm-4 float-left">
                                                <a href="info.php?manga_id=%d">
                                                    <img class="card-img-left img-fluid img-responsive img-thumbnail" style="height: 200px;" src="images/manga covers/%s" alt="%s">
                                                </a>
                                            </div>
                                            <div class="info d-inline w-60">
                                                <span><a class="text-dark" href="info.php?manga_id=%d" title="%s"><b>%s</b></a></span><br>
                                        ',
                                        $manga_id[$i], //from here, print basic info
                                        $image[$i],
                                        $manga_name[$i],
                                        $manga_id[$i],
                                        $manga_name[$i],
                                        $manga_short[$i]
                                    );
                                $chapter_sql = "SELECT volume, chapter_no, chapter_name FROM chapters "
                                        . "WHERE manga_id = '$manga_id[$i]' ORDER BY chapter_no DESC LIMIT 1";
                                if($answer = $con->query($chapter_sql)){ // print chapters
                                    while ($chapter_row = $answer->fetch_object()) {
                                        printf('
                                            <small><a class="chapter text-primary text-decoration-none" href="viewPages.php?manga_id=%d&chapter=%d" title="Chapter %d %s">%s CHAPTER %d</a></small><br>
                                            ',
                                            $manga_id[$i],
                                            $chapter_row->chapter_no,
                                            $chapter_row->chapter_no,
                                            $chapter_row->chapter_name,
                                            $chapter_row->volume,
                                            $chapter_row->chapter_no
                                        );
                                    }
                                } // print end, last updated & views
                                printf('<small><i class="fas fa-eye"></i> %d</small><br>', $views[$i]);
                                if (strlen($desc[$i]) > 330) {
                                    printf('<p class="text-justify"><small>%s</small><small><a class="link" href="info.php?manga_id=%d">more</a></small></p>', substr($desc[$i], 0, 330), $manga_id[$i]);
                                } else {
                                    printf('<p class="text-justify"><small>%s</small> <small><a class="link" href="info.php?manga_id=%d">more</a></small></p>', $desc[$i], $manga_id[$i]);
                                }
                                echo '</div>';
                                echo '</div>';
                                $i++;
                                if ($i >= mysqli_num_rows($result)) { break; }
                            }
                            echo '</div>';
                        }
                    }
                    else {
                        echo '<div class="card p-5 text-center">';
                        echo '<span class="font-weight-bold" style="color: #FF4500;">Sorry no manga with such type is found.</span>';
                        echo '</div>';
                    }
                }
                else { // when All is all
                    $sql = "SELECT COUNT(manga_id) FROM manga";
                    $result = mysqli_query($con, $sql);
                    $total_rows = mysqli_fetch_array($result)[0];
                    $total_pages = ceil($total_rows / $no_of_records_per_page);
                    $sql = "SELECT manga_id, manga_name, views, image, description FROM manga LIMIT $offset, $no_of_records_per_page";
                    $result = $con->query($sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = $result->fetch_object()){
                            $manga_id[] = $row->manga_id;
                            $manga_name[] = $row->manga_name;
                            $views[] = $row->views;
                            $image[] = $row->image;
                            $desc[] = $row->description;
                            if (strlen($row->manga_name) > 40) { $manga_short[] = substr($row->manga_name, 0, 40).'...'; }
                            else { $manga_short[] = $row->manga_name; }
                        }
                        while ($i < mysqli_num_rows($result)) {
                            echo '<div class="card flex-md-row py-3">';
                            for ($n = 0; $n < 2; $n++) { // print 2 records per row
                                printf(' 
                                        <div class="col-6">
                                            <div class="container-fluid col-sm-4 float-left">
                                                <a href="info.php?manga_id=%d">
                                                    <img class="card-img-left img-fluid img-responsive img-thumbnail" style="height: 200px;" src="images/manga covers/%s" alt="%s">
                                                </a>
                                            </div>
                                            <div class="info d-inline w-60">
                                                <span><a class="text-dark" href="info.php?manga_id=%d" title="%s"><b>%s</b></a></span><br>
                                        ',
                                        $manga_id[$i], //from here, print basic info
                                        $image[$i],
                                        $manga_name[$i],
                                        $manga_id[$i],
                                        $manga_name[$i],
                                        $manga_short[$i]
                                    );
                                $chapter_sql = "SELECT volume, chapter_no, chapter_name FROM chapters "
                                        . "WHERE manga_id = '$manga_id[$i]' ORDER BY chapter_no DESC LIMIT 1";
                                if($answer = $con->query($chapter_sql)){ // print chapters
                                    while ($chapter_row = $answer->fetch_object()) {
                                        printf('
                                            <small><a class="chapter text-primary text-decoration-none" href="viewPages.php?manga_id=%d&chapter=%d" title="Chapter %d %s">%s CHAPTER %d</a></small><br>
                                            ',
                                            $manga_id[$i],
                                            $chapter_row->chapter_no,
                                            $chapter_row->chapter_no,
                                            $chapter_row->chapter_name,
                                            $chapter_row->volume,
                                            $chapter_row->chapter_no
                                        );
                                    }
                                } // print end, last updated & views
                                printf('<small><i class="fas fa-eye"></i> %d</small><br>', $views[$i]);
                                if (strlen($desc[$i]) > 330) {
                                    printf('<p class="text-justify"><small>%s</small><small><a class="link" href="info.php?manga_id=%d">more</a></small></p>', substr($desc[$i], 0, 330), $manga_id[$i]);
                                } else {
                                    printf('<p class="text-justify"><small>%s</small> <small><a class="link" href="info.php?manga_id=%d">more</a></small></p>', $desc[$i], $manga_id[$i]);
                                }
                                echo '</div>';
                                echo '</div>';
                                $i++;
                                if ($i >= mysqli_num_rows($result)) { break; }
                            }
                            echo '</div>';
                        }
                    }
                }
                $con->close();
            ?>
            <span class="d-inline-block bg-primary p-2 text-white" style="font-size: 13px;">Total: <?php echo $total_rows ?> STORIES</span>
            <nav class="float-right" aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="<?php if($pageno <= 1){ echo 'disabled'; } else { echo 'page-item'; } ?>">
                        <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo '?type='.$type.'&category='.$category.'&status='.$status.'&pageno='.($pageno - 1); } ?>">Previous</a>
                    </li>
                    <?php 
                        if ($total_pages == 1) {
                            echo '<li class="page-item"><a class="page-link" href="#">1</a></li>';
                        } else {
                            for ($i = 1; $i <= $total_pages ; $i++) {
                                printf ('<li class="page-item"><a class="page-link" href="?type='.$type.'&category='.$category.'&status='.$status.'&pageno=%d">%d</a></li>', $i, $i);
                            }
                        }
                    ?>
                    <li class="<?php if($pageno <= 1){ echo 'disabled'; } else { echo 'page-item'; } ?>">
                        <a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo '?type='.$type.'&category='.$category.'&status='.$status.'&pageno='.($pageno + 1); } ?>">Next</a>
                    </li>
                </ul>
            </nav>
            <?php include('component/table-genres.php') ?>
            <div class="fb-comments bg-light p-2" data-href="http://localhost/Mangakakalot/general.php?type=<?php echo $type ?>&category=<?php echo $category ?>&status=<?php echo $status ?>" data-width="100%" data-numposts="10"></div>
        </div><br>
        <?php include('component/footer.php') ?>
    </body>
</html>
