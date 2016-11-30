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
    var uid=$('#uid').val();
    if(addTitle.length != 0 && addText.length != 0 && uid != 0){
        $.post('request.php',{addNewsText:addText,addNewsTitle:addTitle,uid:uid},function(data){
          if(data.error != 0){
            $('.error').html(data.err_msg);
          }else{
            window.location.href='home.php#news';
          }
        },'JSON');
    }else{
      $('.error').html("Fill in all the feilds");
      if(addTitle.length == 0){
        $('#addTitle').addClass('err');
      }
      if(addText.length == 0){
        $('#addText').addClass('err');
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
        <h3 class="left">Add News</h3>
        <div style="margin:20px 0px;">
          <a class="button addEd">Save News</a>
          <div class="clear"></div>
        </div>
        <?php
        if(isset($_GET['news_id'])){
          $news=getNews($_GET['news_id']);
        }
        ?>
        <div class="error" style="padding:15px 0px;"></div>
        <input type="text" id="addTitle" style="width:60%; font-size:16;" placeholder="Title"/><p/>
        <textarea id="addText" style="width:100%; font-size:16;" rows="35" placeholder="Place Text Here"></textarea>
        <input type="hidden" name="uid" value="<?php echo $uid; ?>" id="uid"/>
        <div style="margin:20px 0px;">
          <a class="button addEd">Save News</a>
          <div class="clear"></div>
        </div>
      </div>
    </div>
</body>
</html>
