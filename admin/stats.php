<?php include($_SERVER["DOCUMENT_ROOT"] . "/dj-app2/partials/_header.php"); ?>

      <?php
      // Start session if one not running.
      if(!isset($_SESSION)){
         session_start();
      }
      ?>

      <!-- Row -->
      <div class="row">

        <!-- Small Side -->
        <div id='collectionWin' class="col-md-2">

          <!-- Actions -->
          <?php include($_SERVER["DOCUMENT_ROOT"] . "/dj-app2/partials/_action_blocks.php"); ?>

            <br>
        </div>

        <!-- Main Window -->
        <div id='mainWin' class="col-md-10">

          <div class="row">
            <div class="col-md-12">

            <div id='CRUDWindow'>

            <!-- Head -->
            <h1 class='display-4'>Stats</h1>
            <p>See all the stats of your installation.</p>
            <br>

              <!-- Message Blocks -->
              <?php if (isset($_SESSION['message'])): ?>
                <div class="msg">
                  <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                  ?>
                </div>
              <?php endif ?>

              <h1><span><i class="fas fa-music"></i></span> Songs</h1>
              <p>Information relating to the song system.</p>
              <div class="row">

                <!-- Block 1 -->
                <div class="col-md-3">
                  <div class="col-md-12 border">
                    <!-- Top Row -->
                    <div class="row">
                      <h1 class='display-4'><?php echo countSongs($db) ?></h1>
                    </div>
                    <!-- Bottom Row -->
                    <div class="row">
                      <p>Total Songs</p>
                    </div>
                  </div>
                </div>

                <!-- Block 2 -->
                <div class="col-md-3">
                  <div class="col-md-12 border">
                    <!-- Top Row -->
                    <div class="row">
                      <h1 class='display-4'><?php echo countRequestsActive($db) ?></h1>
                    </div>
                    <!-- Bottom Row -->
                    <div class="row">
                      <p>Total Active Requests</p>
                    </div>
                  </div>
                </div>

                <!-- Block 3 -->
                <div class="col-md-3">
                  <div class="col-md-12 border">
                    <!-- Top Row -->
                    <div class="row">
                      <h1 class='display-4'><?php echo countRequestsInActive($db) ?></h1>
                    </div>
                    <!-- Bottom Row -->
                    <div class="row">
                      <p>Total Inactive Requests</p>
                    </div>
                  </div>
                </div>
              </div>

              <br>

            <?php if($addon_drinks == TRUE) { ?>
              <h1><span><i class="fas fa-beer"></i></span> Drinks</h1>
              <p>Information relating to the drinks system.</p>
              <div class="row">

                <!-- Block 1 -->
                <div class="col-md-3">
                  <div class="col-md-12 border">
                    <!-- Top Row -->
                    <div class="row">
                      <h1 class='display-4'><?php echo countDrinks($db) ?></h1>
                    </div>
                    <!-- Bottom Row -->
                    <div class="row">
                      <p>Total Drinks</p>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>

              <br>

            <?php if($addon_smartthings == TRUE) { ?>
              <h1><span><i class="fas fa-plug"></i></span> Smart Things</h1>
              <p>Information about smart objects connected to this installation.</p>
              <div class="row">

                <!-- Block 1 -->
                <div class="col-md-3">
                  <div class="col-md-12 border">
                    <!-- Top Row -->
                    <div class="row">
                      <h1 class='display-4'><?php echo countSmart($db) ?></h1>
                    </div>
                    <!-- Bottom Row -->
                    <div class="row">
                      <p>Total Drinks</p>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>

            </div>
          </div>

        </div>

      </div>
      <?php include($_SERVER["DOCUMENT_ROOT"] . "/dj-app2/partials/_footer.php"); ?>
    </div>
