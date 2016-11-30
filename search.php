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
<div style="height:80px; line-height:80px; background: whitesmoke;">
	<div class="marginer" style="width:90%; margin:auto;">
    <h2 style="float:left;">
    <?php
    if(isset($_GET['s'])){
      ?>
        መልሲ ናይ "<?php echo $_GET['s']; ?>"
      <?php
    }
    ?>
    </h2>
    <div class="right" style="line-height:64px; height:100%; display: table-cell;
    vertical-align: middle;">
      <div class="searchBoxCover">
        <i class="ion-search" style="font-size:16px; margin-right:10px;"></i>
        <input type="search" id="search" placeholder="ጽሑፋት ድለ" value="<?php if(isset($_GET['s']) && $_GET['s'] != null){ echo $_GET['s']; }?>">
      </div>
    </div>
    <div class="clear"></div>
  </div>
</div>

<div class="content">
<?php //print_r(searchArticles("ሻይ")); ?>

<div class="marginer" style="">
	<div class="col-3">
    <h3>Articles</h3>
    <?php
    if(isset($_GET['s']) && $_GET['s'] != null){
      if($_GET['s'] != null){
        $searchResult=searchArticles($_GET['s']);
        $count=count($searchResult);
        //print_r($searchResult);
        if($count != 0){
        for($i=0; $i < $count; $i++){
        ?>
        <div class="articleBox">
          <a href="article.php?id=<?php echo $searchResult[$i]['article_id']; ?>"><h3><?php echo $searchResult[$i]['article_title']; ?></h3></a>
          <div class="shortDesc">
            <?php
              $articleShort= getArticleShort($searchResult[$i]['article_id'],300);
              echo $articleShort['article_short'];
            ?>
          </div>
          <div class="articleBoxBottom">
            <a href="article.php?id=<?php echo $searchResult[$i]['article_id']; ?>" class="readMoreButton">ምሉእ ትሕዝቶ</a>
            <div class="clear"></div>
          </div>
        </div>
        <?php
        }
        }else{
          ?>
          <h4 style="text-align: center;">No articles found</h4>
          <?php
        }
      }
    }else{
      ?>
      <h4 style="text-align: center;">No articles found</h4>
      <?php
    }
    ?>
  </div>
  <div class="col-3">
    <h3>Posts</h3>
    <?php
    if(isset($_GET['s']) && $_GET['s'] != null){
      if($_GET['s'] != null){
        $searchResult=searchPosts($_GET['s']);
        $count=count($searchResult);
        //print_r($searchResult);
          if($count != 0){
            for($i=0; $i < $count; $i++){
            ?>
            <div class="articleBox">
              <a href="post.php?post_id=<?php echo $searchResult[$i]['post_id']; ?>">
                <h3><?php echo $searchResult[$i]['post_title']; ?></h3>
              </a>
              <div class="shortDesc">
                <?php
                  $postShort= getPostShort($searchResult[$i]['post_id'],300);
                  echo $postShort['post_short'];
                ?>
              </div>
              <div class="articleBoxBottom">
                <a href="post.php?post_id=<?php echo $searchResult[$i]['post_id']; ?>" class="readMoreButton">ምሉእ ትሕዝቶ</a>
                <div class="clear"></div>
              </div>
            </div>
            <?php
            }
          }else{
            ?>
            <h4 style="text-align: center;">No article found</h4>
            <?php
          }
        }
    }else{
      ?>
      <h4 style="text-align: center;">No posts found</h4>
      <?php
    }
    ?>
  </div>
  <div class="col-3">
    <h3>News</h3>
    <?php
    if(isset($_GET['s']) && $_GET['s'] != null){
      if($_GET['s'] != null){
        $searchResult=searchNews($_GET['s']);
        $count=count($searchResult);
        //print_r($searchResult);
        if($count != 0){
        for($i=0; $i < $count; $i++){
    ?>
    <div class="articleBox">
      <h3><?php echo $searchResult[$i]['news_title']; ?></h3>
    </div>
    <?php
        }
        }else{
        ?>
        <h4 style="text-align: center;">No news found</h4>
        <?php
        }
      }
    }else{
      ?>
      <h4 style="text-align: center;">No news found</h4>
      <?php
    }
    ?>
  </div>
  <div class="clear"></div>
</div>
</div>
<?php include("info.php"); ?>
<?php include("footer.php"); ?>
</body>
</html>
