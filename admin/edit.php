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

  $('.saveEd').click(function(){
    var editTitle=$('#editTitle').val();
    var editText=$('#editText').val();
    var id=$('#id').val();
    var uid=$('#uid').val();
    var mode=$('#mode').val();
      if(mode == 0){
        $.post('request.php',{editText:editText,editTitle:editTitle,aid:id,uid:uid},function(data){
          if(data.error != 0){
            alert("There was an error");
          }else{
            window.location.href='home.php#articles';
          }
        },'JSON');
      }else if(mode == 1){
        $.post('request.php',{editText:editText,editTitle:editTitle,pid:id,uid:uid},function(data){
          if(data.error != 0){
            alert("There was an error");
          }else{
            window.location.href='home.php#posts';
          }
        },'JSON');
      }
      else if(mode == 2){
        $.post('request.php',{editNewsText:editText,editNewsTitle:editTitle,nid:id,uid:uid},function(data){
          if(data.error != 0){
            alert("There was an error");
          }else{
            window.location.href='home.php#news';
          }
        },'JSON');
      }
      else if(mode == 3){
        // alert("OK");
        var ansText=$('#ansText').val();
        var sid=$('#sid').val();
        var uid=$('#uid').val();
        // alert(ansText);
        if(ansText != ""){
          $.post('request.php',{editAnswerText:ansText,sid:sid,uid:uid},function(data){
          if(data.error != 0){
            alert("There was an error");
          }else{
            window.location.href='home.php#questions';
          }
        },'JSON');
      }
      else{
        alert("Please Add Answer to Continue.");
      }
    }
    });
});
</script>
<body style="background:whitesmoke;">
    <?php include("header.php"); ?>
    <div class="marginer">
      <div class="adminMenu">
        <a href="home.php">Home</a>
        <a href="#">Posts</a>
      </div>
      <div style="padding:10px 20px; background:#FFF;">

        <h3 class="left">
        <?php
        if(isset($_GET['article_id'])){
        echo "Edit Article";
        }
        elseif (isset($_GET['news_id'])) {
          echo "Edit News";
        }
        elseif (isset($_GET['post_id'])) {
          echo "Edit Post";
        }
        elseif (isset($_GET['sugid'])) {
          echo "Answer";
        }
        ?>
        </h3>

        <div style="margin:20px 0px;">
          <a class="button saveEd">Save Edit</a>
          <div class="clear"></div>
        </div>
        <?php
        if(isset($_GET['article_id'])){
          $article=getArticle($_GET['article_id']);
          $mode=0;
          $id = $article['article_id'];
          $title=$article['article_title'];
          $text=$article['article_text'];

        }else if(isset($_GET['post_id'])){
          $post=getPost($_GET['post_id']);
          $mode=1;
          $id=$post['post_id'];
          $title=$post['post_title'];
          $text=$post['post_text'];
        }

        else if(isset($_GET['news_id'])){
          $news=getNews($_GET['news_id']);
          $mode=2;
          $id=$news['news_id'];
          $title=$news['news_title'];
          $text=$news['news_text'];
        }

        else if(isset($_GET['sugid'])){
          $qn=getQn($_GET['sugid']);
          $mode=3;
          $id=$qn['sugid'];
          $title=$qn['suggest'];
          $text=$qn['email'];

          $ans = getAns($_GET['sugid']);
          //print_r($ans);
        }

                ?>
        <?php
          if(!isset($_GET['sugid'])){

            ?>

        <legend>Title</legend>
        <input type="text" id="editTitle" value="<?php echo $title; ?>" style="width:60%; font-size:16;"/><p/>
        <legend>Article text</legend>
        <textarea id="editText" style="width:100%; font-size:16;" rows="35"><?php echo str_replace("<br />","",$text); ?></textarea>
        <input type="hidden" name="post" value="<?php echo $mode; ?>" id="mode"/>
        <input type="hidden" name="id" value="<?php echo $id; ?>" id="id"/>
        <input type="hidden" name="uid" value="<?php echo $uid; ?>" id="uid"/>
        <div style="margin:20px 0px;">
          <a class="button saveEd">Save Edit</a>
          <div class="clear"></div>
        </div>
        <?php
          }
          else{
            ?>
            <p><b>Question/Suggestion From:</b> <?php echo str_replace("<br />","",$text); ?></p>
            <textarea id="qnText" disabled="disabled" style="width:100%; font-size:16;" rows="7"><?php echo str_replace("<br />","",$title); ?></textarea></p>
            <textarea id="ansText" placeholder="መልሲ ጸሓፍ" style="width:100%; font-size:16;" rows="10"><?php if($ans['error'] == 0) echo $ans['answer_text'];?></textarea>
            <input type="hidden" value="<?php echo $mode; ?>" id="mode"/>
            <input type="hidden" value="<?php echo $uid; ?>" id="uid"/>
            <input type="hidden" value="<?php echo $_GET['sugid']; ?>" id="sid"/>
          <?php
        }
        ?>
      </div>
    </div>
</body>
</html>
