<?php
  include("functions.php");
  if(isset($_GET['id']) && $_GET['id'] != 0)
    $article=getArticle($_GET['id']);
?>

<html>
<head>
<!--// SITE META //-->
<meta charset="UTF-8" />
<link rel='stylesheet' href="style.css" type='text/css' media='all' />
<title><?php echo $article['article_title']; ?> : ማሕበር ኪዳነ ምሕረት - ካምፓላ</title>
</head>
<body>
  <?php include("header.php"); ?>
<div style="height:80px; line-height:80px; background: whitesmoke;">
	<div class="marginer" style="width:90%; margin:auto;"><h2>Article</h2></div>
</div>

<div class="content">
	<div class="marginer" style="">
	<div class="left">
		<div style="background: white; border-radius:5px; margin:auto; overflow:auto; margin-bottom:25px;">
			   <article>
           <?php
					 	if(isset($_GET['id']) && $_GET['id'] != 0){
           ?>
           <h1><?php
					 if($article['error'] == 0){
            echo $article['article_title'];
           ?></h1>
					 <section style="font-size:18px; line-height:25px; text-align:justify;">
           <?php
            echo $article['article_text'];
					}else{
						echo $article['err_msg'];
					}
				}else{
					echo "No article selected";
				}
           ?>
				 	 </section>
           <section style="color:#333;  width:90%; background: #CFCFCF; padding:15px; border-radius:5px; margin-top:25px;">
              <p style="font-size: 18px; float:left; color: #333;">ማሕበርና ብ ሓገዝ ኣንበብትና ሰለትካየድ ብዝከኣለኩም መጠን ክትሕግዙና ብትሕትና ንላቦ።</p>
              <a class="readMoreButton" href="#" style="margin:10px 0px;">ማሕበር ንምሕጋዝ</a>
              <div class="clear"></div>
           </section>
         </article>
    </div>
  </div>

<div class="sideBar" style="">

  <div style="background: white; border-radius:5px; margin:auto; overflow:hidden;">
  <?php
  // get articles here
  // use for loop
  // put your box inside
  $articles=getArticles(5);
  $count=count($articles);
  $current_articleid = $_GET['id'];
  for($i=0; $i < $count; $i++){
    if($articles[$i]['article_id'] != $current_articleid){
  ?>
    <div class="articleBox">
      <h3><a href="article.php?id=<?php echo $articles[$i]['article_id']; ?>"><?php echo $articles[$i]['article_title']; ?></a></h3>
      <div>ናይ 27 መስከረም 2009</div>
      <hr></hr>
      <div class="shortDesc">
        <?php
          $articleShort=getArticleShort($articles[$i]['article_id'],300);
          echo $articleShort['article_short'];
        ?>
      </div>
        <div class="articleBoxBottom">
          <a href="article.php?id=<?php echo $articles[$i]['article_id']; ?>" class="readMoreButton">ምሉእ ትሕዝቶ</a><div class="clear"></div>
        </div>

  </div>
  <?php
  }
}
  ?>
</div>
	<div class="sideBarSection">
			<div class="articleBox">

      </div>
	</div>
</div>
<div class="clear"></div>
</div>
</div>
<?php include("info.php"); ?>
<?php include("footer.php"); ?>
</body>
</html>
