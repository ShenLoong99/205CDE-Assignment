<aside class="p-3">
    <div class="fb-page mb-3" data-href="https://www.facebook.com/Read-Manga-Online-100177984696055/" data-tabs="" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Read-Manga-Online-100177984696055/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Read-Manga-Online-100177984696055/">Read Manga Online</a></blockquote></div>
    <div class="table-responsive">
        <table class="table table-borderless table-sm aside">
            <thead class="border-top border-w border-w border-danger">
                <tr>
                    <th class="d-inline-block bg-danger text-white">Most Popular Manga</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $color = array("bg-primary", "bg-success", "bg-warning", "bg-danger", "bg-info", "bg-primary", "bg-success", "bg-warning", "bg-danger", "bg-info");
                    $aside_chap_id = array();
                    $aside_manga_id = array();
                    $aside_volume = array();
                    $aside_chap_name = array();
                    $aside_manga_name = array();
                    $aside_manga_sh = array();
                    $aside_sql = "SELECT c.volume, c.chapter_no, c.chapter_name, c.manga_id, m.manga_name FROM chapters c, manga m WHERE c.manga_id = m.manga_id ORDER BY RAND() LIMIT 10";
                    $aside_result = $con->query($aside_sql);
                    if ($aside_result = $con->query($aside_sql)) {
                        while($aside_row = $aside_result->fetch_object()){
                            $aside_chap_id[] = $aside_row->chapter_no;
                            $aside_manga_id[] = $aside_row->manga_id;
                            $aside_volume[] = $aside_row->volume;
                            $aside_chap_name[] = $aside_row->chapter_name;
                            $aside_manga_name[] = $aside_row->manga_name;
                            if (strlen($aside_row->manga_name) > 30) {
                                $aside_manga_sh[] = substr($aside_row->manga_name, 0, 30).'...';
                            }
                            else {
                                $aside_manga_sh[] = $aside_row->manga_name;
                            }
                        }
                    }
                    for ($i = 0; $i < 10; $i++) {
                        printf('<tr>
                                    <td class="%s" style="width: 440px;"><a href="viewPages.php?manga_id=%d&chapter=%d" title="%s">%s - %s Chapter %d</a></td>
                                </tr>
                                ', 
                                $color[$i], 
                                $aside_manga_id[$i],
                                $aside_chap_id[$i],
                                $aside_manga_name[$i],
                                $aside_manga_sh[$i],
                                $aside_volume[$i],
                                $aside_chap_id[$i]);
                    }
                    $con->close();
                ?>
            </tbody>
        </table>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-borderless table-sm genre">
            <thead class="border-top border-w border-primary">
                <tr>
                    <th class="d-inline-block bg-primary text-white">
                        <i class="fas fa-tags"></i> GENRES
                    </th>
                </tr>
            </thead>
            <tbody class="bg-light">
                <tr class="border-bottom border-w border-danger ">
                    <td><a class="text-danger" href="general.php?type=Latest&category=All&status=All"><b>Latest</b></a></td>
                    <td><a href="general.php?type=Newest&category=All&status=All">Newest</a></td>
                    <td><a href="general.php?type=Top%20View&category=All&status=All">Top view</a></td>
                </tr>
                <tr class="border-bottom border-w border-danger">
                    <td><a class="text-danger" href="general.php?type=All&category=All&status=All"><b>ALL</b></a></td>
                    <td><a href="general.php?type=All&category=All&status=Completed">Completed</a></td>
                    <td><a href="general.php?type=All&category=All&status=Ongoing">Ongoing</a></td>
                </tr>
                <tr>
                    <td><a class="text-danger" href="general.php?type=All&category=All&status=All"><b>ALL</b></a></td>
                    <td><a href="general.php?type=All&category=Action&status=All">Action</a></td>
                    <td><a href="general.php?type=All&category=Adult&status=All">Adult</a></td>
                </tr>
                <tr>
                    <td><a href="general.php?type=All&category=Adventure&status=All">Adventure</a></td>
                    <td><a href="general.php?type=All&category=Comedy&status=All">Comedy</a></td>
                    <td><a href="general.php?type=All&category=Cooking&status=All">Cooking</a></td>
                </tr>
                <tr>
                    <td><a href="general.php?type=All&category=Doujinshi&status=All">Doujinshi</a></td>
                    <td><a href="general.php?type=All&category=Drama&status=All">Drama</a></td>
                    <td><a href="general.php?type=All&category=Ecchi&status=All">Ecchi</a></td>
                </tr>
                <tr>
                    <td><a href="general.php?type=All&category=Fantasy&status=All">Fantasy</a></td>
                    <td><a href="general.php?type=All&category=Gender%20Bender&status=All">Gender bender</a></td>
                    <td><a href="general.php?type=All&category=Harem&status=All">Harem</a></td>
                </tr>
                <tr>
                    <td><a href="general.php?type=All&category=Historical&status=All">Historical</a></td>
                    <td><a href="general.php?type=All&category=Horror&status=All">Horror</a></td>
                    <td><a href="general.php?type=All&category=Isekai&status=All">Isekai</a></td>
                </tr>
                <tr>
                    <td><a href="general.php?type=All&category=Josei&status=All">Josei</a></td>
                    <td><a href="general.php?type=All&category=Manhua&status=All">Manhua</a></td>
                    <td><a href="general.php?type=All&category=Manhwa&status=All">Manhwa</a></td>
                </tr>
                <tr>
                    <td><a href="general.php?type=All&category=Martial%20arts&status=All">Martial arts</a></td>
                    <td><a href="general.php?type=All&category=Mature&status=All">Mature</a></td>
                    <td><a href="general.php?type=All&category=Mecha&status=All">Mecha</a></td>
                </tr>
                <tr>
                    <td><a href="general.php?type=All&category=Medical&status=All">Medical</a></td>
                    <td><a href="general.php?type=All&category=Mystery&status=All">Mystery</a></td>
                    <td><a href="general.php?type=All&category=One%20shot&status=All">One shot</a></td>
                </tr>
                <tr>
                    <td><a href="general.php?type=All&category=Psychological&status=All">Psychological</a></td>
                    <td><a href="general.php?type=All&category=Romance&status=All">Romance</a></td>
                    <td><a href="general.php?type=All&category=School%20life&status=All">School life</a></td>
                </tr>
                <tr>
                    <td><a href="general.php?type=All&category=Sci%20fi&status=All">Sci fi</a></td>
                    <td><a href="general.php?type=All&category=Seinen&status=All">Seinen</a></td>
                    <td><a href="general.php?type=All&category=Shoujo&status=All">Shoujo</a></td>
                </tr>
                <tr>
                    <td><a href="general.php?type=All&category=Shoujo%20ai&status=All">Shoujo ai</a></td>
                    <td><a href="general.php?type=All&category=Shounen&status=All">Shounen</a></td>
                    <td><a href="general.php?type=All&category=Shounen%20ai&status=All">Shounen ai</a></td>
                </tr>
                <tr>
                    <td><a href="general.php?type=All&category=Slice%20of%20life&status=All">Slice of life</a></td>
                    <td><a href="general.php?type=All&category=Smut&status=All">Smut</a></td>
                    <td><a href="general.php?type=All&category=Sports&status=All">Sports</a></td>
                </tr>
                <tr>
                    <td><a href="general.php?type=All&category=Supernatural&status=All">Supernatural</a></td>
                    <td><a href="general.php?type=All&category=Tragedy&status=All">Tragedy</a></td>
                    <td><a href="general.php?type=All&category=Webtoons&status=All">Webtoons</a></td>
                </tr>
                <tr>
                    <td><a href="general.php?type=All&category=Yaoi&status=All">Yaoi</a></td>
                    <td><a href="general.php?type=All&category=Yuri&status=All">Yuri</a></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</aside>