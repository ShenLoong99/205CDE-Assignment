<?php 
    session_start();
    if (isset($_GET['pageno'])) { $pageno = $_GET['pageno']; }
    else { $pageno = 1; }
    $no_of_records_per_page = 20;
    $offset = ($pageno-1) * $no_of_records_per_page; 
    require_once 'component/db.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            <?php 
                echo $_GET['search']. ' Manga - Browse & Search Manga at Mangakakalot';
            ?>
        </title>
        <?php include('component/head.php') ?>
        <style>
            .border-w h6 {
                background: #FF4500;
            }
            
            .chapter:hover {
                color: yellow !important;
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
                <span class="text-white">Search</span>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="border-top border-primary border-w">
                        <h6 class="text-white d-inline-block p-2 bg-primary">
                            <i class="fas fa-arrow-alt-circle-right"></i> Keyword: <?php echo $_GET['search'] ?>
                        </h6>
                    </div>
                    <?php 
                        // declare variables and array
                        $manga_exist = false;
                        $auth_exist = false;
                        $search = $_GET['search'];
                        $i = 0;
                        $manga_id = array();
                        $manga_name = array();
                        $views = array();
                        $image = array();
                        $manga_short = array();
                        $auth_index = array();
                        $author = array();
                        // if user enter manga name in search bar
                        $sql = "SELECT COUNT(manga_id) FROM manga WHERE manga_name LIKE '%".$search."%'";
                        if ($result = mysqli_query($con, $sql)) {
                            $total_rows = mysqli_fetch_array($result)[0];
                            $total_pages = ceil($total_rows / $no_of_records_per_page);
                            $sql = "SELECT manga_id, manga_name, views, image FROM manga "
                                    . "WHERE manga_name LIKE '%$search%' LIMIT $offset, $no_of_records_per_page";
                            $result = $con->query($sql);
                            if (mysqli_num_rows($result) > 0) {
                                while($row = $result->fetch_object()){
                                    $manga_id[] = $row->manga_id;
                                    $manga_name[] = $row->manga_name;
                                    $views[] = $row->views;
                                    $image[] = $row->image;
                                    if (strlen($row->manga_name) > 20) { $manga_short[] = substr($row->manga_name, 0, 20).'...'; }
                                    else { $manga_short[] = $row->manga_name; }
                                }
                                while ($i < mysqli_num_rows($result)) {
                                    echo '<div class="card flex-md-row py-3">';
                                    for ($n = 0; $n < 2; $n++) { // print 2 records per row
                                        printf(' 
                                                <div class="col-6">
                                                    <div class="container-fluid col-sm-4 float-left">
                                                        <a href="info.php?manga_id=%d" style="height: 150px; width: 70px;">
                                                            <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/%s" alt="%s">
                                                        </a>
                                                    </div>
                                                    <div class="info d-inline-block w-60">
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
                                                . "WHERE manga_id = '$manga_id[$i]' ORDER BY chapter_no DESC LIMIT 2";
                                        if($answer = $con->query($chapter_sql)){ // print chapters
                                            while ($chapter_row = $answer->fetch_object()) {
                                                printf('
                                                    <i class="fas fa-angle-double-right"></i>
                                                    <h7 style="line-height: 0.5;"><a class="chapter text-primary text-decoration-none font-weight-bold" href="viewPages.php?manga_id=%d&chapter=%d" title="Chapter %d %s">%s CHAPTER %d</a></h7><br>
                                                    ',
                                                    $manga_id[$i],
                                                    $chapter_row->chapter_no,
                                                    $chapter_row->chapter_no,
                                                    $chapter_row->chapter_name,
                                                    $chapter_row->volume,
                                                    $chapter_row->chapter_no
                                                );
                                            }
                                        } // print author names
                                        $auth_sql = "SELECT author_name, last_update FROM author a, manga_list m WHERE a.author_id = m.author_id AND m.manga_id = '$manga_id[$i]'";
                                        if($solution = $con->query($auth_sql)){
                                            while ($auth_row = $solution->fetch_object()) {
                                                $auth_index[] = $manga_id[$i];
                                                $author[] = $auth_row->author_name;
                                                $last_update = $auth_row->last_update;
                                            }
                                        }
                                        $lenstr = 0;
                                        $l = 0;
                                        printf('<h6 style="line-height: 0.5;"><small>Author: ');  
                                        for ($k = 0; $k < sizeof($auth_index); $k++) {
                                            if ($auth_index[$k] == $manga_id[$i]) {
                                                $lenstr += strlen($author[$k]);
                                                $z = sizeof($auth_index) - $k;
                                                if ($z % 2 == 0) {
                                                    if ($lenstr > 20) { 
                                                        printf('%s...', substr($author[$k], 0, 5)); 
                                                        break;
                                                    } 
                                                    else { 
                                                        printf('%s', $author[$k]); 
                                                        break;
                                                    }
                                                }
                                                else {
                                                    if ($lenstr > 20) { // one author but too long
                                                        printf('%s...', substr($author[$k], 0, 15)); 
                                                        break;
                                                    } 
                                                    else if ($l == 1) { 
                                                        printf('%s, ', $author[$k]); 
                                                    } // normal condition
                                                    else { 
                                                        printf('%s', $author[$k]); 
                                                    } // only one author
                                                }
                                                $l++;
                                            }
                                        }// print end, last updated & views
                                        printf('</small></h6>
                                            <h6 style="line-height: 0.5;"><small>Updated: %s</small></h6>
                                            <h6 style="line-height: 0.5;"><small>View: %d</small></h6>
                                            ',
                                                $last_update,
                                                $views[$i]);  
                                        echo '</div>';
                                        echo '</div>';
                                        $i++;
                                        if ($i >= mysqli_num_rows($result)) { break; }
                                    }
                                    $manga_exist = true;
                                    echo '</div>';
                                }
                            }
                            else { // search for author
                                $author_id = array();
                                $total_rows = 0;
                                $sql = "SELECT author_id, author_name FROM author WHERE author_name LIKE '%".$search."%'";
                                if ($result = mysqli_query($con, $sql)) {
                                    while($row = $result->fetch_object()){
                                        $author_id[] = $row->author_id;
                                        $author[] = $row->author_name;
                                    }
                                }
                                for ($a = 0; $a < sizeof($author_id); $a++) {
                                    $sql = "SELECT manga_id FROM manga_list WHERE author_id = '$author_id[$a]'";
                                    $result = mysqli_query($con, $sql);
                                    while($row = $result->fetch_object()){
                                        $total_rows++;
                                    }
                                }
                                $total_pages = ceil($total_rows / $no_of_records_per_page);
                                for ($a = 0; $a < sizeof($author_id); $a++) {
                                    $sql = "SELECT m.manga_id, m.manga_name, m.views, m.image FROM manga m, manga_list ml WHERE ml.author_id = '$author_id[$a]' AND m.manga_id = ml.manga_id LIMIT $offset, $no_of_records_per_page";
                                    $result = mysqli_query($con, $sql);
                                    if (!$result) {
                                        printf("Error: %s\n", mysqli_error($con));
                                    }
                                    if (mysqli_num_rows($result) > 0) {
                                        while($row = $result->fetch_object()){
                                            $manga_id[] = $row->manga_id;
                                            $manga_name[] = $row->manga_name;
                                            $views[] = $row->views;
                                            $image[] = $row->image;
                                            if (strlen($row->manga_name) > 20) { $manga_short[] = substr($row->manga_name, 0, 20).'...'; }
                                            else { $manga_short[] = $row->manga_name; }
                                        }
                                        while ($i < mysqli_num_rows($result)) {
                                            echo '<div class="card flex-md-row py-3">';
                                            for ($n = 0; $n < 2; $n++) { // print 2 records per row
                                                printf(' 
                                                        <div class="col-6">
                                                            <div class="container-fluid col-sm-4 float-left">
                                                                <a href="info.php?manga_id=%d" style="height: 150px; width: 70px;">
                                                                    <img class="card-img-left img-fluid img-responsive img-thumbnail" src="images/manga covers/%s" alt="%s">
                                                                </a>
                                                            </div>
                                                            <div class="info d-inline-block w-60">
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
                                                        . "WHERE manga_id = '$manga_id[$i]' ORDER BY chapter_no DESC LIMIT 2";
                                                if($answer = $con->query($chapter_sql)){ // print chapters
                                                    while ($chapter_row = $answer->fetch_object()) {
                                                        printf('
                                                            <i class="fas fa-angle-double-right"></i>
                                                            <h7 style="line-height: 0.5;"><a class="chapter text-primary text-decoration-none font-weight-bold" href="viewPages.php?manga_id=%d&chapter=%d" title="Chapter %d %s">%s CHAPTER %d</a></h7><br>
                                                            ',
                                                            $manga_id[$i],
                                                            $chapter_row->chapter_no,
                                                            $chapter_row->chapter_no,
                                                            $chapter_row->chapter_name,
                                                            $chapter_row->volume,
                                                            $chapter_row->chapter_no
                                                        );
                                                    }
                                                } // print author names
                                                $auth_sql = "SELECT author_name, last_update FROM author a, manga_list m WHERE a.author_id = m.author_id AND m.manga_id = '$manga_id[$i]'";
                                                if($solution = $con->query($auth_sql)){
                                                    while ($auth_row = $solution->fetch_object()) {
                                                        $auth_index[] = $manga_id[$i];
                                                        $author[] = $auth_row->author_name;
                                                        $last_update = $auth_row->last_update;
                                                    }
                                                }
                                                $lenstr = 0;
                                                $l = 0;
                                                printf('<h6 style="line-height: 0.5;"><small>Author: ');  
                                                for ($k = 0; $k < sizeof($auth_index); $k++) {
                                                    if ($auth_index[$k] == $manga_id[$i]) {
                                                        $lenstr += strlen($author[$k]);
                                                        $z = sizeof($auth_index) - $k;
                                                        if ($z % 2 == 0) {
                                                            if ($lenstr > 20) { 
                                                                printf('%s...', substr($author[$k], 0, 5)); 
                                                                break;
                                                            } 
                                                            else { 
                                                                printf('%s', $author[$k]); 
                                                                break;
                                                            }
                                                        }
                                                        else {
                                                            if ($lenstr > 20) { // one author but too long
                                                                printf('%s...', substr($author[$k], 0, 15)); 
                                                                break;
                                                            } 
                                                            else if ($l == 1) { 
                                                                printf('%s, ', $author[$k]); 
                                                            } // normal condition
                                                            else { 
                                                                printf('%s', $author[$k]); 
                                                            } // only one author
                                                        }
                                                        $l++;
                                                    }
                                                }// print end, last updated & views
                                                printf('</small></h6>
                                                    <h6 style="line-height: 0.5;"><small>Updated: %s</small></h6>
                                                    <h6 style="line-height: 0.5;"><small>View: %d</small></h6>
                                                    ',
                                                        $last_update,
                                                        $views[$i]);  
                                                echo '</div>';
                                                echo '</div>';
                                                $i++;
                                                if ($i >= mysqli_num_rows($result)) { break; }
                                            }
                                            $auth_exist = true;
                                            echo '</div>';
                                        }
                                    }
                                }
                            }
                        }
                        if ($auth_exist == false && $manga_exist == false) {
                            echo '<div class="card flex-md-row p-5 text-center">';
                            echo '<span class="font-weight-bold" style="color: #FF4500;">Sorry no '
                            . 'manga is found. Perhaps you can shorten your search phrase so that '
                                    . 'the database may match what you are looking for...</span>';
                            echo '</div>';
                        }
                    ?>
                    <span class="d-inline-block bg-primary p-2 text-white" style="font-size: 13px;">Total: <?php echo $total_rows ?> STORIES</span>
                    <nav class="float-right" aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="<?php if($pageno <= 1){ echo 'disabled'; } else { echo 'page-item'; } ?>">
                                <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo '?search='.$search.'&pageno='.($pageno - 1); } ?>">Previous</a>
                            </li>
                            <?php 
                                if ($total_pages == 1) {
                                    echo '<li class="page-item"><a class="page-link" href="#">1</a></li>';
                                } else {
                                    for ($i = 1; $i <= $total_pages ; $i++) {
                                        printf ('<li class="page-item"><a class="page-link" href="?search='.$search.'&pageno=%d">1</a></li>', $i);
                                    }
                                }
                            ?>
                            <li class="<?php if($pageno <= 1){ echo 'disabled'; } else { echo 'page-item'; } ?>">
                                <a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo '?search='.$search.'&pageno='.($pageno + 1); } ?>">Next</a>
                            </li>
                        </ul>
                    </nav>
                    <div class="fb-comments bg-light p-2" data-href="http://localhost/Mangakakalot/search.php?search=<?php echo $search ?>" data-width="100%" data-numposts="10"></div>
                </div>
                
                <?php include('component/aside.php') ?>
            </div>
        </div><br>
        <?php include('component/footer.php') ?>
    </body>
</html>
