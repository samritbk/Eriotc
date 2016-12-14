<?php
  include("functions.php");

  //print_r(getUser(1));
?>
<html>
<head>
<!--// SITE META //-->
<meta charset="UTF-8" />
<title>ማሕበር ኪዳነ ምሕረት - ካምፓላ</title>
</head>
<body>
<?php include("header.php"); ?>
<div style="height:80px; line-height:80px; background: whitesmoke;">
	<div class="marginer" style="width:90%; margin:auto;">
    <h2 class="left">ቅድመ ገጽ</h2>
    <div class="right" style="line-height:64px; height:100%; display: table-cell;
    vertical-align: middle;">
      <div class="searchBoxCover">
        <i class="ion-search" style="font-size:16px; margin-right:10px;" ></i>
        <input id="search" type="search" placeholder="ጽሑፋት ድለ"/>
      </div>
    </div>
    <div class="clear"></div>
  </div>
</div>
<div class="content">
	<!-- <div class="marginer" style=""> -->
<div class="left-sidebar left" style="width:20%; padding-top:30px;">
	<!-- <div style="width:95%;">
		<ul class="left-nav">
			<li>fasdf</li>
			<li>adsf</li>
			<li>afdadf</li>
			<li>dsfa</li>
		</ul>
	</div> -->
<section>
	<p>ኢሜል ሳብስክሪብሽን</p>
  <span id="msg"></span>
	<input type="text" class="views" id="emailid" placeholder="example@example.com"/><p/>
	<input type="button" value="ሳብስክራይብ" id="btnid" class="button"/>
	</section>
	<section>
    <p>ሕቶ ወይ ርእይቶ</p>
    <span id="suggmsg"></span>
		<textarea rows="10" class="views" id="suggText" placeholder="ሕቶ ወይ ርእይቶ..."></textarea></p>
    <input type="text" class="views" id="suggEmail" placeholder="example@example.com"/></p>
		<input type="button" value="ስደድ" id="suggId" class="button"/>
</section>
<section>
	<div class="left social-icons">
		<a href="#"><img src="facebook.png"/></a>
	</div>
	<div class="left social-icons">
		<a href="#"><img src="twitter.png"/></a>
	</div>
	<div class="left social-icons">
		<a href="#"><img src="youtube.png"/></a>
	</div>
	<div class="clear"></div>
</section>
</div>
	<div class="mainContent left">
		<div style="background: white; border-radius:5px; margin:auto; overflow:hidden;">
		<?php
		$articles=getArticles();
		$count=count($articles);
		for($i=0; $i < $count; $i++){
		?>
			<div class="articleBox">
				<h3><a href="article.php?id=<?php echo $articles[$i]['article_id']; ?>"><?php echo $articles[$i]['article_title']; ?></a></h3>
				<div><?php echo $articles[$i]['date_created']; ?></div>
				<hr></hr>
				<div class="shortDesc">
					<?php
            $articleShort=getArticleShort($articles[$i]['article_id']);
            echo $articleShort['article_short'];
            ?>
				</div>
					<div class="articleBoxBottom">
						<a href="article.php?id=<?php echo $articles[$i]['article_id']; ?>" class="readMoreButton">ምሉእ ትሕዝቶ</a><div class="clear"></div>
					</div>
			</div>
		<?php
		}
		?>
	</div>
</div>
<div class="mainRight right" style="overflow:auto;">
	<section>
	<div class="quoteOfTheDay" id="inlineDatepicker">
			<!-- <p>ንይ ሎሚ ትምህርቲ</p>
			<div class="quoteOfTheDayText">
				ንጽባሕቱ ሰዓት 5 ድ.ቀ ሳሚ ካብ ዲያቆን ዘተቀበላ ደብዳቤ ተሰኪሙ ናብ እንዳ ቤዛ ከደ። ቤዛ ጸብሒ ክስትሰርሕ ከም ዝጸንሐት  እቲ ካብ ርሑቅ ኮንካ  ዝሽትት ዘነበረ ጨና ሽሮ ይምስክር። ናይ ኽሽነ ኣቁሑት
			</div>
			<p class="quoteOfTheDayVerse">ማት 15:15-65</p> -->
	</div>
  <!-- <a href="#" id="date8">8</a> -->
</section>
<section>
  <p>
    ማሕበርና ብ ሓገዝ ኣንበብትና ሰለትካየድ ብዝከኣለኩም መጠን ክትሕግዙና ብትሕትና ንላቦ።
  </p>
  <a href="#" class="readMoreButton" style="float:none; margin-top:5px; overflow:auto;">ሓግዙና</a>
</section>
<section class="pastArticles">
<div class="articleBox">
<p>ዝሓለፋ ጽሑፋት</p>
<ul class="left-nav">
  <?php $articles=getArticles(10); ?>
  <?php
  $count=count($articles);
  for($i=0; $i < $count; $i++){
    ?>
    <a href="article.php?id=<?php echo $articles[$i]['article_id']; ?>"><li title="<?php echo $articles[$i]['article_title']; ?>"><?php echo $articles[$i]['article_title']; ?></li></a>
    <?php
  }
  ?>
</ul>
</div>
</section>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
<?php include("newsbar.php"); ?>
<?php include("info.php"); ?>
<?php include("footer.php"); ?>
<!-- <div style="position: fixed;
    bottom: 10;
    right: 10;
    height: 50px;
    width: 50px;
    background: #131313;
    border-radius: 50%;
    line-height: 50px;
    text-align: center;">
^
</div> -->
</body>
</html>
