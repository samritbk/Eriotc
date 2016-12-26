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
    <h2>
    <?php
      if(isset($_GET['cat_id'])){
        $catName=getCategoryName($_GET['cat_id']);
        echo $catName;
      }else if(isset($_GET['post_id'])){
        $post=getPost($_GET['post_id']);
        $catName=getCategoryName($post['post_category']);
        echo $catName;
      }
    ?>
    </h2>
  </div>
</div>

<div class="content">
	<div class="marginer" style="">
    <?php
    if(isset($_GET['post_id'])){
     ?>
	<div class="left">
		<div style="background: white; border-radius:5px; margin:auto; overflow:hidden;">
			   <article>
           <?php
					 	if(isset($_GET['post_id'])){
           ?>
           <h1><?php
					 if($post['error'] == 0){
            echo $post['post_title'];
           ?></h1>
					 <section style="font-size:18px; line-height:25px; text-align:justify;">
           <?php
            echo $post['post_text'];
					}else{
						echo $post['err_msg'];
					}
				}else{
					echo "No article selected";
				}
           ?>
				 	 </section>
         </article>
    </div>
  </div>

<div class="sideBar">

  <div style="background: white; border-radius:5px; margin:auto; overflow:hidden;">
  <?php
  // get articles here
  // use for loop
  // put your box inside
  if(isset($_GET['post_id'])){

  $posts=getPostsByCategory($post['post_category'],0,1);
  $count=count($posts);
  $current_postid = $_GET['post_id'];
  for($i=0; $i < $count; $i++){
    if($posts[$i]['post_id'] != $current_postid){
  ?>
    <div class="articleBox">
      <h3><a href="post.php?post_id=<?php echo $posts[$i]['post_id']; ?>"><?php echo $posts[$i]['post_title']; ?></a></h3>
      <div>ናይ 27 መስከረም 2009</div>
      <hr></hr>
      <div class="shortDesc">
        <?php
          $postShort= getPostShort($posts[$i]['post_id'],300);
          echo $postShort['post_short'];
        ?>
      </div>
      <div class="articleBoxBottom">
        <a href="post.php?post_id=<?php echo $posts[$i]['post_id']; ?>" class="readMoreButton">ምሉእ ትሕዝቶ</a><div class="clear"></div>
      </div>
  </div>
  <?php
  }
  }
}
  ?>
</div>
	<div class="sideBarSection">

			<div class="articleBox">
        <h3>ካልኦት ጽሑፋት</h3>
        <ul class="left-nav">
          <?php
          $catNames=getCategoryName();
          $count=count($catNames);
            for($i=0; $i < 3; $i++){
          ?>
              <a href="post.php?cat_id=<?php echo $i+1; ?>"><li><?php echo $catNames[$i]; ?></li></a>
          <?php
            }
           ?>
        </ul>
      </div>
	</div>
</div>
<?php
}else if(isset($_GET['cat_id'])){
  $posts=getPostsByCategory($_GET['cat_id'], 0, 1);
  $count=count($posts);
  if($count != 0){
   for($i=0; $i < $count; $i++){
     ?>
      <div class="col-3">
        <div class="post-box" style="background:url(<?php echo assigedPostImageLoc($posts[$i]['post_id'],1); ?>);">
            <a href="post.php?post_id=<?php echo $posts[$i]['post_id']; ?>">
            <div class="post-box-title">
              <?php echo $posts[$i]['post_title']; ?>
            </div>
          </a>
        </div>
      </div>
  <?php
      }
    }else{
      ?>
      <h1>ጽሑፋት ኣብ ቀረባ ግዜ</h1>
      <?php
    }
  ?>
    <div class="clear"></div>
  <?php
}
?>
<div class="clear"></div>
</div>
</div>
<?php include("info.php"); ?>
<?php include("footer.php"); ?>
</body>
</html>
