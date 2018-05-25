<?php
// PHP FUNCTION FILE.
// Keep all functions where possible in this file. Try and keep the code organised and easy to read.

// GET VERSION NUMBER
class ApplicationVersion {
    // Define version numbering
    const MAJOR = 0;
    const MINOR = 0;
    const PATCH = 0;

    public static function get() {
        // Prepare git information to form version number.
        $commitHash = trim(exec('git log --pretty="%h" -n1 HEAD'));

        // Get date and time information.
        $commitDate = new \DateTime(trim(exec('git log -n1 --pretty=%ci HEAD')));
        $commitDate->setTimezone(new \DateTimeZone('UTC'));

        // Format all information into a version identifier.
        return sprintf('v%s.%s.%s-dev.%s (%s)', self::MAJOR, self::MINOR, self::PATCH, $commitHash, $commitDate->format('Y-m-d H:m:s'));
    }

    // Usage: echo 'MyApplication ' . ApplicationVersion::get();
}

// CHECK ONLINE
function is_connected() {
    $connected = @fsockopen("www.google.co.uk", 80);
                                        //website, port  (try 80 or 443)
    if ($connected){
        $is_conn = true; //action when connected
        fclose($connected);
    }else{
        $is_conn = false; //action in connection failure
    }

    // Displays Icon based on connected status
     if ($is_conn == true) {
       echo "<i class='fas fa-wifi' title='Connected'></i>";
     } else {
       echo "<i class='fas fa-ban' title='Not Connected'></i>";
     }
}

// GENRE ARRAY
function GenreArray() {
  // Genre Array.
  $genreList = ['Other', 'Pop', 'Rock', 'RnB', 'Hip-Hop', 'Classical', 'Rap'];

  // Loop Through Genre Array.
  for ($i=0; $i < count($genreList); $i++) {
    echo "<option value='" . $genreList[$i] ."'>" . $genreList[$i] ."</option>";
  }
}

// LIST SONGS
function ListSongs($mysqli) {
  // Attempt select query execution
  $sql = "SELECT * FROM songs ORDER BY song_name ASC";
  if($result = mysqli_query($mysqli, $sql)){
      if(mysqli_num_rows($result) > 0){
        ?>
          <table id='table_search' class='table table-bordered'>
              <tr>
                  <th class='text-center'>ID</th>
                  <th class='text-center'>Song Name</th>
                  <th class='text-center'>Song Artist</th>
                  <th class='text-center'>Song Album</th>
                  <th class='text-center'>Song Genre</th>
              </tr>
      <?php
          while($row = mysqli_fetch_array($result)){
              echo "<tr>";
                  echo "<td class='text-center'>" . $row['song_id'] . "</td>";
                  echo "<td>" . $row['song_name'] . "</td>";
                  echo "<td>" . $row['song_artist'] . "</td>";
                  echo "<td>" . $row['song_album'] . "</td>";
                  echo "<td class='colourCell" . $row['song_genre'] . "'>" . $row['song_genre'] . "</td>";
              echo "</tr>";
          }
          echo "</table>";

          // Free result set
          mysqli_free_result($result);
      } else{
          // Error Message
          echo "<p>No songs were found.</p>";
      }
  } else{
      SQLError($mysqli);
  }

  // Close connection
  mysqli_close($mysqli);
}

// REQUEST PAGE
function RequestList($mysqli) {
  // Attempt select query execution
  $sql = "SELECT * FROM requests WHERE request_active = 1 ORDER BY request_time ASC";
  if($result = mysqli_query($mysqli, $sql)){
      if(mysqli_num_rows($result) > 0){
        ?>
          <table id='table_search' class='table table-hover'>
              <tr>
                  <th class='text-center'>ID</th>
                  <th class='text-center'>Song Name</th>
                  <th class='text-center'>Song Artist</th>
                  <th class='text-center'>Song Album</th>
                  <th class='text-center'>Clear</th>
              </tr>
      <?php
          while($row = mysqli_fetch_array($result)){
            $RequestID = $row['request_id'];

              echo "<tr>";
                  echo "<td class='text-center'>" . $row['request_id'] . "</td>";
                  echo "<td class='text-center'>" . $row['request_s_name'] . "</td>";
                  echo "<td class='text-center'>" . $row['request_s_artist'] . "</td>";
                  echo "<td class='text-center'>" . $row['request_s_album'] . "</td>";
                  echo "<td class='text-center'><a href='". $_SERVER['PHP_SELF'] . "?" . $RequestID . "'>Clear</a></td>";
              echo "</tr>";
          }
          echo "</table>";
          // Free result set
          mysqli_free_result($result);
      } else{
          echo "No active requests were found.";
      }
  } else{
    SQLError($mysqli);
  }

  // Close connection
  mysqli_close($mysqli);

  if (isset($_GET[$RequestID])) {
    echo "The record " . $RequestID . " Made Inactive";
  }
}

// GLOBAL FUNCTIONS
function SQLError($mysqli) {
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($mysqli);
}
 ?>
