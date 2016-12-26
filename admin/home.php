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
    <?php include("header.php"); ?>
    <div class="marginer">
    <div class="adminMenu">
      <a href="home.php">Home</a>
      <a href="#posts">Posts</a>
      <a href="#news">News</a>
      <a href="images.php">Images</a>
      <?php
        $userPr=getUserPrivilage($uid);
        if($userPr['error'] == 0){
          if($userPr['privilage'] == 0){
          ?>
          <a href="users.php">Users</a>
          <?php
          }
        }
      ?>
    </div>
      <div style="padding:20px; background:#FFF;">
        <h3 id="articles">Articles</h3>
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
        <h3 id="news">News</h3>
        <div style="margin:20px 0px;"><a href="addNews.php" class="button">Add News</a></div>
        <table class="data_T" style="width:100%;">
            <thead style="text-align:center;">
              <td>News Id</td><td>News Title</td><td>View</a></td><td>Edit</td><td>Deactivate</td>
            </thead>
            <tbody>
              <?php
                $newses=getNewses(5);
                $count=count($newses);
                for($i=0; $i < $count; $i++){
              ?>
              <tr>
                <td><?php echo $newses[$i]['news_id'] ?></td>
                <td><?php echo $newses[$i]['news_title'] ?></td>
                <td><a href="../news.php?id=<?php echo $newses[$i]['news_id']; ?>" target="_blank">View</a></td>
                <td><a href="edit.php?news_id=<?php echo $newses[$i]['news_id']; ?>">Edit</a></td>
                <td><a id="deactive" dataId="<?php echo $newses[$i]['news_id'] ?>">Deactivate</a></td>
              </tr>
              <?php } ?>
            </tbody>
          </tr>
        </table>

        <h3 id="posts">Posts</h3>
        <div style="margin:20px 0px;"><a href="addPost.php" class="button">Add Post</a></div>
        <table class="data_T" style="width:100%;">
            <thead style="text-align:center;">
              <td>Post Id</td><td>Post Title</td><td>Post Category</td><td>View</a></td><td>Edit</td><td>Deactivate</td>
            </thead>
            <tbody>
              <?php
                $posts=getPostsByCategory(0);
                $count=count($posts);
                for($i=0; $i < $count; $i++){
              ?>
              <tr>
                <td><?php echo $posts[$i]['post_id']; ?></td>
                <td><?php echo $posts[$i]['post_title']; ?></td>
                <td><?php echo $posts[$i]['post_category']; ?></td>
                <td><a href="post.php?post_id=<?php echo $posts[$i]['post_id']; ?>" target="_blank">View</a></td>
                <td><a href="edit.php?post_id=<?php echo $posts[$i]['post_id']; ?>">Edit</a></td>
                <td><a id="deactive" dataId="<?php echo $posts[$i]['post_id'] ?>">Deactivate</a></td>
              </tr>
              <?php } ?>
            </tbody>
          </tr>
        </table>
        <h3 id="questions">Questions</h3>
        <div style="margin:20px 0px;"><a href="#" class="button">Add Post</a></div>
        <table class="data_T" style="width:100%;">
            <thead style="text-align:center;">
              <td>Question/Suggestion Id</td><td>Question/Suggestion</td><td>E-mail</td><td>Date</td></a><td>Edit</td><td>Deactivate</td>
            </thead>
            <tbody>
              <?php
                $qns=getQns(0);
                $count=count($qns);
                for($i=0; $i < $count; $i++){
              ?>
              <tr>
                <td><?php echo $qns[$i]['sugid']; ?></td>
                <td><?php echo $qns[$i]['suggest']; ?></td>
                <td><?php echo $qns[$i]['email']; ?></td>
                <td><?php echo gmdate("d-M-Y",$qns[$i]['timestamp']); ?></td>

                <td><a href="edit.php?sugid=<?php echo $qns[$i]['sugid']; ?>">Edit</a></td>
                <td><a id="deactive" dataId="<?php echo $posts[$i]['post_id'] ?>">Deactivate</a></td>
              </tr>
              <?php
            }
            ?>
            </tbody>
          </tr>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
