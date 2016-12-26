<div class="newsBar">
	<div class="newsIntro">
		<h2>Church News</h2>
		<p>Current affairs affecting our church and organization</p>
	</div>
	<div class="newsBoxWrapper">
    <?php
    $newses=getNewses(3);
    $count=count($newses);
    for($i=0; $i < $count; $i++){
    ?>
    <div class="newsBoxCol">

			<a href="news.php?news_id=<?php echo $newses[$i]['news_id']; ?>">
			<div class="newsBox" style="background:url(<?php echo assigedNewsImageLoc($newses[$i]['news_id'],1); ?>); background-size:cover;">
            <!-- Abzi Div Serah -->

							<div class="newsBoxTitle"><!--<a href="news.php">Latest News</a></div>-->
                <?php echo $newses[$i]['news_title']; ?>
              </div>
              <div class="newsBoxDate">
                  <?php echo $newses[$i]['date_created']; ?>
              </div>
                <!--<hr></hr>-->
      </div>
			</a>
      </div>
      <?php
      }
      ?>
      <!--<img src="1.jpg" style="height: 100%; width: 100%"/> </div>-->
    <!-- <div style="height: 100%; width: 50%; float: left;">
      <div style="height: 100%; width: 90%; background: whitesmoke; margin:auto; background: url(1.jpg);">

      </div>

      <img src="3.jpg" style="height: 100%; width: 100%""/> </div>
  </div> -->
	</div>
	<div class="clear"></div>

</div>
