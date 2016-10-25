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

  $('.addEd').click(function(){
    var addTitle=$('#addTitle').val();
    var addText=$('#addText').val();
    var uid=$('#uid').val();

    $.post('request.php',{addText:addText,addTitle:addTitle,uid:uid},function(data){
      if(data.error != 0){
        alert("There was an error");
      }else{
        window.location.href='home.php';
      }
    },'JSON');

  });
});
</script>
<body style="background:whitesmoke;">
    <header style="height:100px; text-align:center; background:#455A64; position:relative;  color:#FFF;">
      <div style="line-height:45px; height:45px; color:#FFF;">ADMIN DASHBOARD</div>
      <div style="position:absolute; bottom:0; margin-bottom:3px; margin-left:16px; color:#FFF;">
        Logged as: <?php $data=getUsername($uid); echo $data['username']; ?>
      </div>
    </header>
    <div class="marginer">
      <div class="adminMenu">
        <a href="home.php">Home</a>
        <a href="#">Posts</a>
      </div>
      <div style="padding:10px 20px; background:#FFF;">
        <h3 class="left">Add Post</h3>
        <div style="margin:20px 0px;">
          <a class="button addEd">Save Post</a>
          <div class="clear"></div>
        </div>
        <?php
        if(isset($_GET['article_id'])){
          $article=getArticle($_GET['article_id']);
        }
        ?>
        <input type="text" id="addTitle" style="width:60%; font-size:16;" placeholder="Title"/><p/>
        <textarea id="addText" style="width:100%; font-size:16;" rows="35" placeholder="Post text"></textarea>
        <input type="radio" name="catId" value="1" title="Category 1"/> Category 1
        <input type="radio" name="catId" value="2" title="Category 2"/> Category 2
        <input type="radio" name="catId" value="3" title="Category 3"/> Category 3
        <input type="hidden" name="uid" value="<?php echo $uid; ?>" id="uid"/>
        <div style="margin:20px 0px;">
          <a class="button addEd">Save Post</a>
          <div class="clear"></div>
        </div>
      </div>
    </div>
</body>
</html>
