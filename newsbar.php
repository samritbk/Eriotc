<div style="height:300px; background:#148585; padding:25px 0px; background:url(background_sky.jpg) center; background-size:cover;">
	<div style="float: left;
    height: 100%;
    width: 30%;">
		<h3 style="margin:0px; padding:0px 15px; color:#333;">ዜና ቤተ ክርስቲያን</h3>
		<p style="color:#333; padding:0px 15px; font-size:18px;">ህሉው ኩነታት ቤተ ክርስቲያና</p>
	</div>
	<div style="float: left;
    height: 100%;
    width: 70%;">
    <?php
    $newses=getNewses(3);
    $count=count($newses);
    for($i=0; $i < $count; $i++){
    ?>
    <div style="height: 100%; width: 33%; float: left;">

      <div style="height: 100%; width: 95%; background: whitesmoke; margin:auto; background:url(kidanemihret.jpg); background-size:cover; position:relative;">
            <!-- Abzi Div Serah -->
              <div style="color: blue; line-height: 50px; padding-left: 10px; height:50px; margin-top:5%;  font-size:18px; position:absolute; bottom:0; right: 0; left:0; background:whitesmoke;"><!--<a href="news.php">Latest News</a></div>-->
                <a href="news.php?id=<?php echo $newses[$i]['news_id']; ?>"><?php echo $newses[$i]['news_title']; ?></a>
              </div>

              <div style="font-size:18px; position:absolute;line-height: 30px;height: 30px; right: 0; top: 0;background: #3F51B5;padding: 0px 5px;color: #fff;  ">
                  <?php echo gmdate("d-M-Y",$newses[$i]['date_created']); ?>
              </div>
                <!--<hr></hr>-->
      </div>
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
</div>
