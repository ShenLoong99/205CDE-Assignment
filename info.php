<?php 
    session_start();
    $manga_id = $_GET['manga_id'];
    $rate = false;
    $bookmark = false;
    $exist = false;
    require_once 'component/db.php';
    $sql = "SELECT manga_name, alternative, status, views, description, rating, votes, image FROM manga WHERE manga_id = '$manga_id'";
    $result = $con->query($sql);
    while($row = $result->fetch_object()){
        $image = $row->image;
        $manga_name = $row->manga_name;
        $alt = $row->alternative;
        $status = $row->status;
        $views = $row->views;
        $desc = $row->description;
        $rating = $row->rating;
        $votes = $row->votes;
    }
    $author = array();
    $auth_sql = "SELECT author_name FROM author a, manga_list ml WHERE ml.manga_id = '$manga_id' AND a.author_id = ml.author_id";
    if ($answer = $con->query($auth_sql)) {
        while($auth_row = $answer->fetch_object()){
            $author[] = $auth_row->author_name;
        }
    } 
    $genre = array();
    $genre_sql = "SELECT genre FROM genres g, genre_list gl WHERE gl.manga_id = '$manga_id' AND g.genre_id = gl.genre_id";
    if ($outcome = $con->query($genre_sql)) {
        while($genre_row = $outcome->fetch_object()){
            $genre[] = $genre_row->genre;
        }
    }
    $volume = array();
    $chapter_no = array();
    $chapter_name = array();
    $chapter_view = array();
    $time_upload = array();
    $chap_sql = "SELECT volume, chapter_no, chapter_name, view, time_upload FROM chapters WHERE manga_id = '$manga_id' ORDER BY chapter_no ASC";
    if ($solution = $con->query($chap_sql)) {
        while($chap_row = $solution->fetch_object()){
            $volume[] = $chap_row->volume;
            $chapter_no[] = $chap_row->chapter_no;
            $chapter_name[] = $chap_row->chapter_name;
            $chapter_view[] = $chap_row->view;
            $time_upload[] = substr($chap_row->time_upload, 0, 10);
        }
    }
    if (isset($_SESSION["id"])) {  // check user login or not
        $sql = "SELECT bookmark, rate FROM library WHERE manga_id = $manga_id AND id = '".$_SESSION['id']."'";
        if ($result = $con->query($sql)){ // check manga is bookmark or rated or not
            while($row = $result->fetch_object()){
                $exist = true;
                $bookmark = $row->bookmark;
                $rate = $row->rate;
            }
        }
    }
    
    if(isset($_POST['bookmark'])){ // add bookmark function (insert)
        if(isset($_SESSION["id"])) { // if user logged in
            if ($exist == true) { // if record exist in library table
                if ($bookmark == false) { // if user didn't bookmark this manga
                    $sql = "UPDATE library SET bookmark = true WHERE manga_id = $manga_id AND id = ".$_SESSION["id"]."";
                    if ($con->query($sql)) { // update library table
                        echo "<script>alert('You have successfully bookmark this manga!')</script>";
                        header("Refresh: 0.1; url=info.php?manga_id=$manga_id");
                    }
                }
            }
            else { // if record doesn't exist in library table
                $sql = "INSERT INTO library VALUES(".$_SESSION["id"].", $manga_id, $chapter_no[0], true, false, false)";
                if (mysqli_query($con, $sql)) { // insert into library table
                    echo "<script>alert('You have successfully bookmark this manga!')</script>";
                    header("Refresh: 0.1; url=info.php?manga_id=$manga_id");
                }
            }
        }
        else { // if user didn't, prompt error message
            echo "<script>alert('Please login to bookmark this manga...')</script>";
            header("Refresh: 0.1; url=info.php?manga_id=$manga_id");
        }
    }
    
    if(isset($_POST['rate'])){ // update rating function (update)
        if(isset($_SESSION["id"])) { // check whether user login or not
            $rates = $_POST['rate'];
            $rating = $rating * $votes + $rates; // calculate ratings
            $votes++;
            $rating = $rating / $votes;
            if ($exist == true) { // if record existed in library table
                if ($rate == false) { // if user didn't rate this manga
                    $sql = "UPDATE manga m, library l SET m.rating = $rating, m.votes = $votes, l.rate = true WHERE m.manga_id = $manga_id AND l.manga_id = m.manga_id AND l.id = '".$_SESSION['id']."'";
                    if ($con->query($sql)) { // update manga details
                        header('Location: '.$_SERVER['REQUEST_URI']);
                    }
                }
            }
            else { // if record didn't exist in library table
                // update manga and insert library separately
                $sql = "UPDATE manga SET rating = $rating, votes = $votes WHERE manga_id = $manga_id"; // update manga rating and votes details
                $con->query($sql);// update manga details
                $sql = "INSERT INTO library VALUES (".$_SESSION["id"].", $manga_id, $chapter_no[0], false, true, false)";
                mysqli_query($con, $sql); // insert rating record only into library
                header('Location: '.$_SERVER['REQUEST_URI']);
            }
        }
        else {
            echo "<script>alert('Please login to bookmark this manga...')</script>";
            header('Location: '.$_SERVER['REQUEST_URI']);
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <?php header("Content-Type:text/html; charset=utf-8") ?>
        <title><?php echo $manga_name ?> - Mangakakalot.com</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php include('component/head.php') ?>
        <style>
            .border-w h6 {
                background: #FF4500;
            }
            
            hr {
                border-top: dotted 2px red;
            }
            
            .btn-link {
                display: inline-block;
                background: green;
                padding: 10px;
                width: 100%;
                border-radius: 5px;
                text-align: center;
                box-shadow: 
                    inset 0 -3em 3em rgba(0,0,0,0.1), 
                          0 0  0 2px rgb(255,255,255),
                          0.3em 0.3em 1em rgba(0,0,0,0.3);
            }
            
            .btn-link:hover {
                text-decoration: none;
                color: #fff;
            }
            
            .my-custom-scrollbar {
                position: relative;
                height: 300px;
                overflow: auto;
            }
            .table-wrapper-scroll-y {
                display: block;
            }
            
            .chapter a {
                color: #333;
            }
            
            .chapter a:hover {
                color: orange;
                text-decoration: none;
            }
            
            .chapter a:visited {
                color: orange;
            }
            
            .bookmark {
                width: 60%;
                height: 60%;
            }
            
            .fa-star {
                color: yellow;
            }
            
            .fa-star:hover {
                color: green;
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
        <section>
            <div class="container mt-0">
                <?php include('component/carousel.php') ?>
                <div class="row">
                    <div class="col-md-7 bg-light p-3">
                        <?php 
                            printf('<div class="card flex-md-row mb-4 box-shadow h-md-250 p-3">
                            <div class="chapter">
                                <img class="card-img-left flex-auto d-none d-md-block" src="images/manga covers/%s" alt="%s"><br>
                                <a class="btn-link text-white" href="#chapter-list">CHAPTER LIST</a>
                            </div>
                            <div class="card-body d-flex flex-column align-items-start">
                                <h3><b>%s</b></h3>
                                <small class="h6">Alternative : %s</small>
                                <div>
                                    Author(s) :
                                ',
                                    $image,
                                    $manga_name,
                                    $manga_name,
                                    $alt);
                            for($i = 0; $i < sizeof($author); $i++) {
                                printf('<a href="search.php?search=%s">%s</a>, ',$author[$i], $author[$i]);
                            }
                            printf('</div>
                                Status : %s<br>
                                Last updated : %s PM<br>
                                View : %s<br>
                                <p>Genres : 
                                ', 
                                    $status, 
                                    end($time_upload),
                                    $views
                                    );
                            for ($n = 0; $n < sizeof($genre); $n++) { // print category or genre
                                printf('<a rel="nofollow" href="general.php?type=All&category=%s&status=All&page=1">%s</a>, ', $genre[$n], $genre[$n]);
                            }
                            echo '<form name="myform" method="post">Rating: ';
                            if ($rate == true) {
                                echo '<small>You have rated this manga!</small>';
                            }
                            else {
                                for ($n = 1; $n <= 5; $n++) { // print rating stars
                                    printf('<button class="btn btn-default px-0" value="%d" name="rate"><i class="fa fa-star"></i></button>', $n);
                                }
                            }
                            printf('<br><small>Mangakakalot.com rate : %.2f/ 5 - %d votes</small><br>', $rating, $votes);
                            if ($bookmark == false) {echo '<button class="btn btn-default" name="bookmark"><img class="img-responsive bookmark" src="images/theodoi.png" alt="bookmark"></button>';}
                            else { echo '<small>You already bookmarked this manga!</small>'; };
                            printf('</form><div class="fb-save" data-uri="http://localhost:8383/Mangakakalot/info.php?manga_id=%d" data-size="small"></div>
                                  <div class="fb-like" data-href="http://localhost:8383/Mangakakalot/info.php?manga_id=%d" data-width="1" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                                  </div>
                                  </div>
                                  <hr>', $manga_id, $manga_id);
                            printf('<div class="px-3">
                                        <p class="text-danger">%s summary: </p>
                                        <p class="text-justify">%s</p>
                                    </div><br>
                                    ', 
                                $manga_name,
                                $desc);
                            echo '<div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar">
                                    <table class="table table-sm chapter">
                                        <thead>
                                            <tr>
                                                <th scope="col"><a name="chapter-list">Chapter Name</a></th>
                                                <th scope="col">View</th>
                                                <th scope="col">Time uploaded</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                            for ($a = 0; $a < sizeof($chapter_no); $a++) {
                                printf('<tr>
                                            <td><a href="viewPages.php?manga_id=%d&chapter=%d" title="%s Chapter %d %s">Chapter %d %s</a></td>
                                            <td>%d</td>
                                            <td>%s</td>
                                        </tr>
                                        ',
                                    $manga_id,
                                    $chapter_no[$a],
                                    $manga_name, 
                                    $chapter_no[$a],
                                    $chapter_name[$a],
                                    $chapter_no[$a],
                                    $chapter_name[$a],
                                    $chapter_view[$a],
                                    $time_upload[$a]);
                            }
                            echo '</tbody></table></div>';
                        ?>
                        <div class="fb-comments" data-href="http://localhost:8383/Mangakakalot/info.php?manga_id=<?php echo $manga_id ?>" data-width="" data-numposts="10"></div>
                    </div>
                    <?php include('component/aside.php') ?>
                </div>
            </div>
        </section><br>
        <?php include('component/footer.php') ?>
    </body>
</html>
