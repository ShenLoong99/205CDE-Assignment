<?php 
    session_start();
    $manga_id = $_GET['manga_id'];
    $chapter = $_GET['chapter'];
    $history = false;
    $exist = false;
    require_once 'component/db.php'; // establish db connection
    $sql = "SELECT manga_name, views FROM manga WHERE manga_id = '$manga_id'"; // get manga information
    $result = $con->query($sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = $result->fetch_object()){
            $manga_name = $row->manga_name;
            $manga_view = $row->views;
        }
    }
    $volume = array();
    $chapter_name = array(); // get manga's chapters
    $sql = "SELECT volume, chapter_no, chapter_name FROM chapters WHERE manga_id = '$manga_id' ORDER BY chapter_no ASC";
    $result = $con->query($sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = $result->fetch_object()){
            $volume[] = $row->volume;
            $chapter_no[] = $row->chapter_no;
            $chapter_name[] = $row->chapter_name;
        }
    }
    $page_no = array(); // get all of the pages of this manga
    $sql = "SELECT page_no FROM pages WHERE manga_id = '$manga_id' AND chapter_no = '$chapter'";
    $result = $con->query($sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = $result->fetch_object()){
            $page_no[] = $row->page_no;
        }
    }
    for ($n = 0; $n < sizeof($chapter_no); $n++) { // loop all to get current chapter information
        if ($chapter_no[$n] == $chapter){ 
            $current_chap = $chapter_name[$n]; // get current chapter
            $current_vol = $volume[$n]; // get current volume 
            $c = $n; // get current index to be operated
            break; 
        }
    } // get author information (name)
    $sql = "SELECT author_name FROM author a, manga_list ml WHERE ml.manga_id = '$manga_id' AND a.author_id = ml.author_id";
    $result = $con->query($sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = $result->fetch_object()){
            $author = $row->author_name;
        }
    }
    if (isset($_SESSION["id"])) { // check whether login or not
        $sql = "SELECT history FROM library WHERE manga_id = $manga_id AND id = '".$_SESSION["id"]."'";
        $result = $con->query($sql);
        while($row = $result->fetch_object()){
            $history = $row->history;
            $exist = true;
        }
        if ($exist == true) {
            if ($history == true) { // update current chapter
                $sql = "UPDATE library SET current_chap = $chapter WHERE manga_id = $manga_id AND id = '".$_SESSION["id"]."' AND $chapter > current_chap";
                $con->query($sql);
            }
            else { // update current chapter
                $sql = "UPDATE library SET current_chap = $chapter WHERE manga_id = $manga_id AND id = '".$_SESSION["id"]."' AND $chapter > current_chap";
                $con->query($sql); // update history counter
                $sql = "UPDATE library SET history = true WHERE manga_id = $manga_id AND id = '".$_SESSION["id"]."'";
                $con->query($sql);
            }
        }
        else {
            $sql = "INSERT INTO library VALUES (".$_SESSION["id"].", $manga_id, $chapter, false, false, true)";
            mysqli_query($con, $sql);
        }
    }
    
    // update views of chapters and manga table
    $sql = "UPDATE chapters SET view = view + 1 WHERE chapter_no = $chapter AND manga_id = $manga_id";
    $con->query($sql);
    $sql = "UPDATE manga SET views = views + 1 WHERE manga_id = $manga_id";
    $con->query($sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <title><?php printf('%s %s Chapter %d %s - Mangakakalot.com',$current_vol, $manga_name, $chapter, $current_chap); ?></title>
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
                        <a class="text-white" href="info.php?manga_id=<?php echo $manga_id ?>" title="<?php echo $manga_name ?>"><?php echo $manga_name ?></a> <i class="fas fa-angle-double-right"></i> 
                        <a class="text-white" href="viewPages.php?manga_id=<?php echo $manga_id ?>&chapter=<?php echo $chapter ?>"> Chapter <?php echo $chapter ?> <?php echo $current_chap ?></a>
                    </div>
                    <div class="container bg p-2">
                        <div class="container row mb-2">
                            <div class="btn-group">
                                <button type="button" class="btn btn-light btn-sm list">Chapter <?php echo $chapter ?> <?php echo $current_chap ?></button>
                                <button type="button" class="btn btn-light btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
                                </button>
                                <div class="dropdown-menu">
                                    <?php 
                                        for ($i = 0; $i < sizeof($chapter_no); $i++) {
                                            if ($volume[$i] != null) {
                                                printf('<a class="dropdown-item" href="viewPages.php?manga_id=%d&chapter=%d">%s Chapter %d %s</a>', $manga_id, $chapter_no[$i], $volume[$i], $chapter_no[$i], $chapter_name[$i]);
                                            } 
                                            else {
                                                printf('<a class="dropdown-item" href="viewPages.php?manga_id=%d&chapter=%d">Chapter %d %s</a>', $manga_id, $chapter_no[$i], $chapter_no[$i], $chapter_name[$i]);
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                            <?php 
                                if ($chapter == $chapter_no[0]) {
                                    printf('<a class="btn btn-success active btn-sm text-white ml-2" href="viewPages.php?manga_id=%d&chapter=%d">NEXT CHAPTER</a>', $manga_id, $chapter + 1);
                                }
                                else if ($chapter == end($chapter_no)) {
                                    printf('<a class="btn btn-success active btn-sm text-white ml-2" href="viewPages.php?manga_id=%d&chapter=%d">PREV CHAPTER</a>', $manga_id, $chapter - 1);
                                }
                                else {
                                    printf('<a class="btn btn-success active btn-sm text-white ml-2" href="viewPages.php?manga_id=%d&chapter=%d">PREV CHAPTER</a>', $manga_id, $chapter - 1);
                                    printf('<a class="btn btn-success active btn-sm text-white ml-2" href="viewPages.php?manga_id=%d&chapter=%d">NEXT CHAPTER</a>', $manga_id, $chapter + 1);
                                }
                            ?>
                        </div>
                        <span class="d-inline-block bg-light text-uppercase p-1">
                            <small><?php echo $manga_name ?>: Chapter <?php echo $chapter ?> <?php echo $current_chap ?></small>
                        </span>
                    </div>
                </div>
        </header>
        <section class="container">
            <div class="container info-card text-center px-5 py-2 mt-2 mb-2">
                <span class="h3 title"><?php echo $manga_name ?>: Chapter <?php echo $chapter ?>: <?php echo $current_chap ?></span><br>
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
                <?php
                    for ($i = 0; $i < sizeof($page_no); $i++) {
                        printf('<img class="mb-2" src="images/manga pages/%s/%s/%d.jpg" alt="page %d">', $manga_name, $chapter, $i, $i);
                    }
                ?>
                <br>
                <a class="mb-2" href="home.php"><img src="images/clickhere2.png" alt="Go Home"></a>
            </div>
            <div class="container p-0">
                <div class="container bg p-2">
                    <div class="container row">
                        <div class="btn-group">
                            <button type="button" class="btn btn-light btn-sm list">Chapter <?php echo $chapter ?> <?php echo $current_chap ?></button>
                                <button type="button" class="btn btn-light btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
                                </button>
                                <div class="dropdown-menu">
                                    <?php 
                                        for ($i = 0; $i < sizeof($chapter_no); $i++) {
                                            if ($volume[$i] != null) {
                                                printf('<a class="dropdown-item" href="viewPages.php?manga_id=%d&chapter=%d">%s Chapter %d %s</a>', $manga_id, $chapter_no[$i], $volume[$i], $chapter_no[$i], $chapter_name[$i]);
                                            } 
                                            else {
                                                printf('<a class="dropdown-item" href="viewPages.php?manga_id=%d&chapter=%d">Chapter %d %s</a>', $manga_id, $chapter_no[$i], $chapter_no[$i], $chapter_name[$i]);
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                            <?php 
                                if ($chapter == $chapter_no[0]) {
                                    printf('<a class="btn btn-success active btn-sm text-white ml-2" href="viewPages.php?manga_id=%d&chapter=%d">NEXT CHAPTER</a>', $manga_id, $chapter + 1);
                                }
                                else if ($chapter == end($chapter_no)) {
                                    printf('<a class="btn btn-success active btn-sm text-white ml-2" href="viewPages.php?manga_id=%d&chapter=%d">PREV CHAPTER</a>', $manga_id, $chapter - 1);
                                }
                                else {
                                    printf('<a class="btn btn-success active btn-sm text-white ml-2" href="viewPages.php?manga_id=%d&chapter=%d">PREV CHAPTER</a>', $manga_id, $chapter - 1);
                                    printf('<a class="btn btn-success active btn-sm text-white ml-2" href="viewPages.php?manga_id=%d&chapter=%d">NEXT CHAPTER</a>', $manga_id, $chapter + 1);
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="p-2 path">
                    <a class="text-white" href="home.php" title="Manga Online">Manga Online</a> <i class="fas fa-angle-double-right"></i> 
                    <a class="text-white" href="info.php?manga_id=<?php echo $manga_id ?>" title="<?php echo $manga_name ?>"><?php echo $manga_name ?></a> <i class="fas fa-angle-double-right"></i> 
                    <a class="text-white" href="viewPages.php?manga_id=<?php echo $manga_id ?>&chapter=<?php echo $chapter ?>"> Chapter <?php echo $chapter ?> <?php echo $current_chap ?></a>
                </div>
                <div class="bg-light p-2">
                    <span>
                        <small>
                            You just finished reading <b><?php printf('%s Chapter %d %s', $manga_name, $chapter, $current_chap); ?></b> online. 
                            The Bookmark button is a very simple way to get notifications when your favorite manga 
                            have new updates. It's very useful to anyone who loves reading manga. Let's us guide you 
                            to find your best manga to read. And if you find any errors, let us know so we can fix it 
                            as soon as possible!<br> You can support us by leaving comments or just a click on the Like 
                            button!
                        </small>
                    </span><br>
                    <div class="fb-like" data-href="http://localhost:8383/Mangakakalot/viewPages.html" data-width="10px" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div><br>
                    <span><small>Related chapter: </small>
                        <?php 
                            if ($chapter == $chapter_no[0]) {
                                printf('<a class="link" href="viewPages.php?manga_id=%d&chapter=%d">%s Chapter %d %s</a>', $manga_id, $chapter_no[1], $manga_name, $chapter_no[1], $chapter_name[1]);
                            }
                            else if ($chapter == end($chapter_no)) {
                                printf('<a class="link" href="viewPages.php?manga_id=%d&chapter=%d">%s Chapter %d %s</a>', $manga_id, $chapter - 1, $manga_name, $chapter - 1, $chapter_name[$c - 1]);
                            }
                            else {
                                printf('<a class="link" href="viewPages.php?manga_id=%d&chapter=%d">%s Chapter %d %s</a>, ', $manga_id, $chapter - 1, $manga_name, $chapter - 1, $chapter_name[$c - 1]);
                                printf('<a class="link" href="viewPages.php?manga_id=%d&chapter=%d">%s Chapter %d %s</a>', $manga_id, $chapter + 1, $manga_name, $chapter + 1, $chapter_name[$c + 1]);
                            }
                        ?>
                    </span><br>
                    <div class="fb-comments p-2" data-href="http://localhost:8383/Mangakakalot/viewPages.php?manga_id=<?php echo $manga_id ?>&chapter=<?php echo $chapter ?>" data-width="500" data-numposts="10" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
                </div>
                <div>
                    <div class="bg-light p-2"><span class="recent h5 text-uppercase"><b>RECENTLY UPDATED MANGA</b></span></div>
                    <?php
                        $p = 0;
                        $new_id = array();
                        $new_name = array();
                        $new_sh = array();
                        $new_chap = array();
                        $new_view = array();
                        $new_image = array(); // get recently updated mangas
                        $sql = "SELECT manga_id, manga_name, views, image FROM manga ORDER BY RAND() LIMIT 15";
                        $result = $con->query($sql);
                        if (mysqli_num_rows($result) > 0) {
                            while($row = $result->fetch_object()){
                                $new_id[] = $row->manga_id;
                                $new_name[] = $row->manga_name;
                                $new_view[] = $row->views;
                                $new_image[] = $row->image;
                                if (strlen($row->manga_name) > 50) { $new_sh[] = substr($row->manga_name, 0, 50).'...'; }
                                else { $new_sh[] = $row->manga_name; }
                            }
                        }
                        for ($q = 0; $q < sizeof($new_id); $q++) { // get chapters from the manga selected
                            $sql = "SELECT chapter_no FROM chapters WHERE manga_id = '$new_id[$q]' ORDER BY chapter_no DESC LIMIT 1";
                            $answer = $con->query($sql);
                            if (mysqli_num_rows($answer) > 0) {
                                while($row = $answer->fetch_object()){
                                    $new_chap[] = $row->chapter_no;
                                }
                            }
                        }
                        
                        while ($p < mysqli_num_rows($result)) { // printing output
                            echo '<div class="card flex-md-row py-3">';
                            for ($div = 0; $div < 3; $div++) {
                                printf('
                                        <div class="col-4">
                                            <div class="container-fluid col-sm-4 float-left">                                    
                                                <a href="info.php?manga_id=%d">
                                                    <img class="card-img-left img-fluid img-responsive img-thumbnail" style="height: 100px; width: 70px;" src="images/manga covers/%s" alt="%s">
                                                </a>
                                            </div>
                                            <div class="info">
                                                <span class="h6"><a class="text-dark text-decoration-none" href="info.php?manga_id=%d" title="%s"><b>%s</b></a></span><br>
                                                <span class="font">
                                                    <a href="viewPages.php?manga_id=%d&chapter=%d" class="text-decoration-none chapter">Chapter %d</a><br>
                                                    <i class="fas fa-eye"></i> %d
                                                </span>
                                            </div>
                                        </div>
                                        ',
                                        $new_id[$p],
                                        $new_image[$p],
                                        $new_name[$p],
                                        $new_id[$p],
                                        $new_name[$p],
                                        $new_sh[$p],
                                        $new_id[$p],
                                        $new_chap[$p],
                                        $new_chap[$p],
                                        $new_view[$p]);
                                $p++;
                            }
                            echo '</div>';
                        }
                        $con->close();
                    ?>
                </div>
                <div class="bg-light p-2">
                    <span class="recent h5"><b><?php echo $manga_name ?> Chapter <?php echo $chapter ?>: <?php echo $current_chap ?> summary</b></span><br>
                    <span><small>
                            You're reading <?php echo $manga_name ?>. This manga has been translated by Updating. 
                            Author: <?php echo $author ?> already has <?php echo $manga_view ?> views. <br>If you want to read free manga, come 
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
