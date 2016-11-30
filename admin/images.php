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
        $.post('request.php',{addText:addText,addTitle:addTitle,uid:uid},function(data){
          if(data.error != 0){
            alert("There was an error");
          }else{
            window.location.href='home.php#articles';
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
    }
  });

  function getSelectionText() {
    var text = "";
    var activeEl = document.activeElement;
    var activeElTagName = activeEl ? activeEl.tagName.toLowerCase() : null;
    if (
      (activeElTagName == "textarea" || activeElTagName == "input") &&
      /^(?:text|search|password|tel|url)$/i.test(activeEl.type) &&
      (typeof activeEl.selectionStart == "number")
    ) {
      text = activeEl.value.slice(activeEl.selectionStart, activeEl.selectionEnd);
    } else if (window.getSelection) {
        text = window.getSelection().toString();
    }
    return text;
}
document.onselectionchange=function(){
    console.log(getSelectionText());
}
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
        <h3 class="left">Images Dashboard</h3>
        <div style="margin:20px 0px;">
          <div class="clear"></div>
        </div>
        <?php
        if(isset($_POST['imgDesc'],$_FILES['image'],$_POST['uid'])){
          echo $imagedesc=$_POST['imgDesc'];
          echo $image = $_FILES['image'];
          echo $uid= $_POST['uid'];

          uploadImage($image, $imagedesc);
        }
        ?>
        <div class="error" style="padding: 15px 0px;"></div>
        <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="imgDesc" style="font-size:16;" placeholder="Description"/>
        <input type="file" name="image" style="font-size:16;" placeholder="Upload image"/>
        <input type="hidden" name="uid" value="<?php echo $uid; ?>" id="uid"/>
        <input type="submit" value="Upload">
      </form>
        <div style="margin:20px 0px;">
          <div class="clear"></div>
        </div>
      </div>
    </div>
</body>
</html>
