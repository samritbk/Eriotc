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
    $('#addTitle').removeClass('err');
    $('#addText').removeClass('err');

    var addTitle=trim($('#addTitle').val());
    var addText=trim($('#addText').val());
    //var catId=$('input[name=catId]:checked').val();
    var catId=$("#catId").val();
    var uid=$('#uid').val();

    if(addTitle.length != 0 && addText.length != 0 && catId != 0 && uid != 0){
        $.post('request.php',{addPostText:addText,addPostTitle:addTitle,catId:catId,uid:uid},function(data){

          if(data.error != 0){
            $('.error').html(data.err_msg);
          }else{
            window.location.href='home.php#posts';
          }

        },'JSON');
    }else{
      $('.error').html("Fill in all the feilds");
      if(addTitle.length == 0){
        $('#addTitle').addClass("err");
      }
      if(addText.length == 0){
        $('#addText').addClass("err");
      }
      if(catId.length == 0){
        $('#catId').addClass("err");
      }
    }
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
        <div class="error" style="padding: 15px 0px; color:#d02929;"></div>
        <input type="text" id="addTitle" style="width:60%; font-size:16;" placeholder="Title"/><p/>
        <textarea id="addText" style="width:100%; font-size:16;" rows="35" placeholder="Post text"></textarea>
        <input type="hidden" name="uid" value="<?php echo $uid; ?>" id="uid"/>
        <select name="catId" id="catId">
          <option value="1">5 አዕማደ ምስጢር</option>
          <option value="2">7 ምስጢራተ ቤተክርስቲያን</option>
          <option value="3">ካልኦት ትምህርትታት</option>
        </select>
        <div style="margin:20px 0px;">
          <a class="button addEd">Save Post</a>
          <div class="clear"></div>
        </div>
      </div>
    </div>
</body>
</html>
