<?php
// FETECH PAGES.
$coverArtMode = 1;

//continue only if $_POST is set and it is a Ajax request
if (isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    include("config.inc.php");  //include config file
    //Get page number from Ajax POST
    if (isset($_POST["page"])) {
        $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
        if (!is_numeric($page_number)) {
            die('Invalid page number!');
        } //incase of invalid page number
    } else {
        $page_number = 1; //if there's no page number, set it to 1
    }

    //get total number of records from database for pagination
    $results = $mysqli->query("SELECT COUNT(*) FROM crud");
    $get_total_rows = $results->fetch_row(); //hold total records in variable
    //break records into pages
    $total_pages = ceil($get_total_rows[0]/$item_per_page);

    //get starting position to fetch the records
    $page_position = (($page_number-1) * $item_per_page);

    //Limit our results within a specified range.
    $results = $mysqli->prepare("SELECT id, name, artist, genre FROM crud ORDER BY id ASC LIMIT $page_position, $item_per_page");
    $results->execute(); //Execute prepared Query
    $results->bind_result($id, $SongName, $SongArtist, $SongGenre); //bind variables to prepared statement

    //Display records fetched from database.
    while ($results->fetch()) { //fetch values
      ?>
              <!-- Song Blocks -->
              <div class="card song_block <?php echo 'colour' . $SongGenre ?>" style="width: 18rem;">

                <!-- Song Top Image -->
                <?php if ($coverArtMode == 1) { ?>
                  <?php
                  // echo "<img class='headerimage' onerror=this.src='img/img.svg' src='img/spinner.gif' data-src=\"";
                  //       echo LastFMArtwork::getArtwork($SongArtist, $SongAlbum, true, "large");
                  //       echo "\"></a>"; ?>
                <?php } ?>

                <!-- Song Body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-9">

                      <!-- Song Name -->
                      <?php echo "<h5 class='card-text'>" . $SongName . "</h5>"; ?>

                      <!-- Song Artist -->
                      <?php echo "<h6 class='card-text'>" . $SongArtist . "</h6>"; ?>

                    </div>

                    <!-- Request Button -->
                    <div class="col-md-3">
                      <a href="index.php?request_song=<?php echo $row['id']; ?>" class="" ><i class="far fa-thumbs-up fa-2x"></i></a>
                    </div>

                  </div>
                </div>
              </div>
              <?php
    }

    echo '<div align="center">';
    echo paginate_function($item_per_page, $page_number, $get_total_rows[0], $total_pages);
    echo '</div>';

    exit;
}
################ pagination function #########################################
function paginate_function($item_per_page, $current_page, $total_records, $total_pages)
{
    $pagination = '';
    if ($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages) { //verify total pages and current page number
        $pagination .= '<ul class="pagination">';

        $right_links    = $current_page + 3;
        $previous       = $current_page - 3; //previous link
        $next           = $current_page + 1; //next link
        $first_link     = true; //boolean var to decide our first link

        if ($current_page > 1) {
            $previous_link = ($previous==0)? 1: $previous;
            $pagination .= '<li class="first page-item"><a href="#" data-page="1" title="First">&laquo;</a></li>'; //first link
            $pagination .= '<li><a href="#" data-page="'.$previous_link.'" title="Previous">&lt;</a></li>'; //previous link
                for ($i = ($current_page-2); $i < $current_page; $i++) { //Create left-hand side links
                    if ($i > 0) {
                        $pagination .= '<li><a href="#" data-page="'.$i.'" title="Page'.$i.'">'.$i.'</a></li>';
                    }
                }
            $first_link = false; //set first link to false
        }

        if ($first_link) { //if current active page is first link
            $pagination .= '<li class="first active page-item">'.$current_page.'</li>';
        } elseif ($current_page == $total_pages) { //if it's the last active link
            $pagination .= '<li class="last active page-item">'.$current_page.'</li>';
        } else { //regular current link
            $pagination .= '<li class="active page-item">'.$current_page.'</li>';
        }

        for ($i = $current_page+1; $i < $right_links ; $i++) { //create right-hand side links
            if ($i<=$total_pages) {
                $pagination .= '<li><a href="#" data-page="'.$i.'" title="Page '.$i.'">'.$i.'</a></li>';
            }
        }
        if ($current_page < $total_pages) {
            $next_link = ($i > $total_pages) ? $total_pages : $i;
            $pagination .= '<li><a href="#" data-page="'.$next_link.'" title="Next">&gt;</a></li>'; //next link
                $pagination .= '<li class="last"><a href="#" data-page="'.$total_pages.'" title="Last">&raquo;</a></li>'; //last link
        }

        $pagination .= '</ul>';
    }
    return $pagination; //return pagination links
}
