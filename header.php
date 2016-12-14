<?php include_once("functions.php"); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div class="header">
<div style="width:90%; margin:auto; text-align:right; height:auto; background:transparent; color:#FFF;">
<div style="float:left;"><a href="admin/" class="lang">Login</a></div>
<a href="#" class="lang">ትግርኛ</a> | <a href="#" class="lang" style="font-size:14px;">English</a>
</div>
	<div style="background: Transparent; padding: 10px 0px;">
		<div style="width:90%; margin:auto;">
						<img src="eotc-logo.png" class="logo">
						<div class="logoName">ማሕበር ኪዳነ ምህረት - ካምፓላ</div>
						<div class="date">
							<div class="date1">
							</div>
							<div class="date2">
							</div>
						<div class="clear"></div>
  					</div>
	</div>
	<div class="clear"></div>
</div>
	<div class="nav" style="">
<div style="margin:auto; width:90%;">
		<ul>
			<a class="a" href="index.php"><li><div class="liMarginer">ቅድመ ገጽ</div></li></a>
			<a href="#">
				<li>
				<div class="liMarginer">ትምህርተ ሃይማኖት</div>
				<ul class="subnav">
					<a class="navLink" href="post.php?cat_id=1">
					<li style="position:relative;">
					5 አዕማደ ምስጢር
						<ul class="subsub" style="">
							<?php
								$posts=getPostsByCategory(1,0,1);
								$count=count($posts);
								for($i=0;$i < $count; $i++){
									?>
									<a href="post.php?post_id=<?php echo $posts[$i]['post_id']; ?>"><li><?php echo $posts[$i]['post_title']; ?></li></a>
									<?php
								}
							?>
						</ul>
				</li>
				</a>
				<a class="navLink" href="post.php?cat_id=2">
					<li style="position:relative;">7 ምስጢራተ ቤተክርስቲያን
						<ul class="subsub" style="">
							<?php
								$posts = getPostsByCategory(2,0,1);
								$count=count($posts);
								for($i=0;$i < $count; $i++){
									?>
									<a href="post.php?post_id=<?php echo $posts[$i]['post_id']; ?>"><li><?php echo $posts[$i]['post_title']; ?></li></a>
									<?php
								}
							?>
						</ul>
					</li>
				</a>

				  <a class="navLink" href="post.php?cat_id=3">
					<li style="position:relative;">ካልኦት ትምህርትታት
						<ul class="subsub" style="">
							<?php
								$posts = getPostsByCategory(3,0,1);
								$count=count($posts);
								for($i=0;$i < $count; $i++){
									?>
									<a href="post.php?post_id=<?php echo $posts[$i]['post_id']; ?>"><li><?php echo $posts[$i]['post_title']; ?></li></a>
									<?php
								}
							?>
						</ul>
					</li>
				</a>
				</ul>
			</li>
		</a>
		<a href="prayers.php">
				<li><div class="liMarginer">ስርዓተ ጸሎት</div></li>
		</a>
			<a href="post.php?post_id=14"><li><div class="liMarginer">ስብከት ወንጌል</div></li></a>
			<a href="post.php?post_id=16"><li><div class="liMarginer">ነገረ ቅዱሳን</div></li></a>
			<a href="post.php?post_id=18"><li><div class="liMarginer">ብሂል ኣበው</div></li></a>
			<a href="post.php?post_id=20"><li><div class="liMarginer">ስነ - ጽሑፍ</div></li></a>
			<a href="#"><li><div class="liMarginer">ሕቶን መልስን</div></li></a>
			<a href="about.php"><li><div class="liMarginer">ብዛዕባ ማሕበርና</div></li></a>
			<!-- <li id="date">7 መስከረም 2008 ዓ.ም.</li> -->
			<div class="clear"></div>
		</ul>
</div>
		<div class="menuDropDown">
			<div>
				<div class="left" style="width:33%;">a</div>
					<div class="left" style="width:33%;">a</div>
						<div class="left" style="width:33%;">a</div>
<div class="clear"></div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>
<link rel='stylesheet' href="style.css" type='text/css' media='all' />
<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
<link rel="stylesheet" href="css/jquery.calendars.picker.css">
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/jquery.plugin.js"></script>
<script src="js/jquery.calendars.js"></script>
<script src="js/js.js"></script>
<script src="js/jquery.calendars.plus.js"></script>
<script src="js/jquery.calendars.picker.js"></script>
<script src="js/jquery.calendars.ethiopian.js"></script>
