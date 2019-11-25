<?php 
    $carou_id = array();
    $carou_name = array();
    $carou_name_sh = array();
    $carou_image = array();
    $carou_chap_no = array();
    $carou_chap_name = array();
    $sql="SELECT manga_id, manga_name, image FROM manga ORDER BY RAND() LIMIT 20";
    if($result = $con->query($sql)){
        while ($row = $result->fetch_object()) {
            $carou_id[] = $row->manga_id;
            $carou_image[] = $row->image;
            $carou_name[] = $row->manga_name;
            if (strlen($row->manga_name) > 15) { $carou_name_sh[] = substr($row->manga_name, 0, 15).'...'; }
            else { $carou_name_sh[] = $row->manga_name; }
            $carou_sql = "SELECT chapter_no, chapter_name FROM chapters WHERE manga_id = $row->manga_id ORDER BY chapter_no DESC LIMIT 1";
            if($order = $con->query($carou_sql)){
                while ($carou_row = $order->fetch_object()) {
                    $carou_chap_no[] = $carou_row->chapter_no;
                    $carou_chap_name[] = $carou_row->chapter_name;
                }
            }
        }
    }
?>

<div class="border-top border-w" style="border-color: #FF4500 !important;">
    <h6 class="text-white d-inline-block p-2">
        <i class="fas fa-thumbs-up fa-lg"></i> Popular Manga
    </h6>
</div>
<div class="row">
    <div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
        <div class="MultiCarousel-inner">
            <?php 
                for ($i = 0; $i < sizeof($carou_id); $i++) {
                    printf('<div class="item">
                                <img class="img-responsive fit-image" src="images/manga covers/%s" alt="%s">
                                <div class="w-100 caption">
                                    <h6><a href="info.php?manga_id=%d" title="%s">%s</a></h6>
                                    <a href="viewPages.php?manga_id=%d&chapter=%d" title="Chapter %d %s">Chapter %d</a>
                                </div>
                            </div>
                            ',
                            $carou_image[$i], 
                            $carou_name[$i],
                            $carou_id[$i],
                            $carou_name[$i], 
                            $carou_name_sh[$i],
                            $carou_id[$i],
                            $carou_chap_no[$i],
                            $carou_chap_no[$i],
                            $carou_chap_name[$i],
                            $carou_chap_no[$i]);
                }
            ?>
        </div>
        <button class="btn btn-primary leftLst"><i class="fas fa-angle-left fa-lg"></i></button>
        <button class="btn btn-primary rightLst"><i class="fas fa-angle-right fa-lg"></i></button>
    </div>
</div>