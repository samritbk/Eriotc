<?php
  include("functions.php");
?>
<html>
<head>
<!--// SITE META //-->
<meta charset="UTF-8" />
<link rel='stylesheet' href="style.css" type='text/css' media='all' />
<title>ማሕበር ኪዳነ ምሕረት - ካምፓላ</title>
</head>
<body>
  <?php include("header.php"); ?>
<!--News Title-->
  <div style="height:80px; line-height:80px; background: whitesmoke;">
  	<div class="marginer" style="width:90%; margin:auto;"><h2>News</h2></div>
  </div>
<div class = "content">
	<div class="marginer" style="">
	<div class="left">
		<div style="background: white; border-radius: 5px; margin:auto; overflow:hidden;">
			<article>
				<?php
					if(isset($_GET['id']) && $_GET['id'] != 0){
						$news = getNews($_GET['id']);
				?>
						<h1><?php
						if($news['error'] == 0){
							echo $news['news_title'];
						?></h1>
						<section style="font-size:18px; line-height:25px; text-align:justify;">
						<?php
						echo $news['news_text'];
						}else{
							echo $news['err_msg'];
							}
						}else{
							echo "No News Selected";
						}
							?>
						</section>
			</article>
		</div>
	</div>

	<div class="right" style="width:25%; background: #FFF; padding:5px 0px;">
  <div style="background: white; border-radius:5px; margin:auto; overflow:hidden;">
  <?php
  // get articles here
  // use for loop
  // put your box inside
  $newses=getNewses();
  $count=count($newses);
  $current_newsid = $_GET['id'];
  for($i=0; $i < $count; $i++){
    if($newses[$i]['news_id'] != $current_newsid ){
  ?>
    <div class="news">
      <h3><a href="news.php?id=<?php echo $newses[$i]['news_id']; ?>"><?php echo $newses[$i]['news_title']; ?></a></h3>
      <div> ጥቅምቲ 2009</div>
      <hr></hr>
  </div>
  <?php
  }
}
  ?>
  </div>
</div>
  <div class="clear"></div>
  	</div>
  </div>
  <?php include("info.php"); ?>
  <?php include("footer.php"); ?>
</body>
</html>
