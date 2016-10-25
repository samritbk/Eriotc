<?php
  include("functions.php");
  if(isset($_SESSION['uid']) && $_SESSION['uid'] != 0){
    $uid=$_SESSION['uid'];
  }else{
    restricted();
  }
?>
<!-- <a href="logout.php">Logout</a> -->
<html>
<head>
<!--// SITE META //-->
<meta charset="UTF-8" />
<link rel='stylesheet' href="../style.css" type='text/css' media='all' />
<script type="text/javascript" src="../js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="../js/string.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('#deactive').click(function(){
    var dataId=$(this).attr("dataId");
    // $.post("request.php", {},function(){
    //
    // });
  });
});
</script>
<body style="background:whitesmoke;">
    <header style="height:100px; text-align:center; background:#455A64; position:relative;  color:#FFF;">
      <div style="line-height:45px; height:45px; color:#FFF;">ADMIN DASHBOARD</div>
      <div style="position:absolute; bottom:0; margin-bottom:3px; margin-left:16px; color:#FFF;">Logged as: <?php $data=getUsername($uid); echo $data['username']; ?></div>
    </header>
    <div class="marginer">
    <div class="adminMenu">
      <a href="home.php">Home</a>
      <a href="#">Posts</a>
    </div>
      <div style="padding:20px; background:#FFF;">
        <h3>Articles</h3>
        <div style="margin:20px 0px;"><a href="addArticle.php" class="button">Add Article</a></div>
        <table class="data_T" style="width:100%;">
            <thead style="text-align:center;">
              <td>Article Id</td><td>Article Title</td><td>View</a></td><td>Edit</td><td>Deactivate</td>
            </thead>
            <tbody>
              <?php
                $articles=getArticles(5);
                $count=count($articles);
                for($i=0; $i < $count; $i++){
              ?>
              <tr>
                <td><?php echo $articles[$i]['article_id'] ?></td>
                <td><?php echo $articles[$i]['article_title'] ?></td>
                <td><a href="../article.php?id=<?php echo $articles[$i]['article_id']; ?>" target="_blank">View</a></td>
                <td><a href="edit.php?article_id=<?php echo $articles[$i]['article_id']; ?>">Edit</a></td>
                <td><a id="deactive" dataId="<?php echo $articles[$i]['article_id'] ?>">Deactivate</a></td>
              </tr>
              <?php } ?>
            </tbody>
          </tr>
        </table>
        <h3>Posts</h3>
        <div style="margin:20px 0px;"><a href="addPost.php" class="button">Add Post</a></div>
        <table class="data_T" style="width:100%;">
            <thead style="text-align:center;">
              <td>Post Id</td><td>Post Title</td><td>Post Category</td><td>View</a></td><td>Edit</td><td>Deactivate</td>
            </thead>
            <tbody>
              <?php
                $posts=getPostsByCategory(5);
                $count=count($posts);
                for($i=0; $i < $count; $i++){
              ?>
              <tr>
                <td><?php echo $posts[$i]['post_id']; ?></td>
                <td><?php echo $posts[$i]['post_title']; ?></td>
                <td><?php echo $posts[$i]['post_category']; ?></td>
                <td><a href="#" target="_blank">View</a></td>
                <td><a href="edit.php?post_id=<?php echo $posts[$i]['post_id']; ?>">Edit</a></td>
                <td><a id="deactive" dataId="<?php echo $posts[$i]['post_id'] ?>">Deactivate</a></td>
              </tr>
              <?php } ?>
            </tbody>
          </tr>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
