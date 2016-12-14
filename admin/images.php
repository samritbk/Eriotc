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
  // $('.delRelation').on("click",function(event){
  //   event.stopPropagation();
  //   alert("asds");
  //   //confirm("Are you sure you want to remove this relation?");
  // });
  $( "body" ).on( "click", "a.delRelation", function( event ) {
    event.preventDefault();
    var parent=$(this).closest('tr');
    if(confirm("Are you sure you want to remove this relation?")){
      var rel_data=$(this).attr("data");
      var Rimage_id=$('#Rimage_id').val();
      $.post('request.php', {encoded_relation_id:rel_data,image_id:Rimage_id}, function(data){
        if(data.error == 0){
          parent.fadeOut();
          var relationButton=$('.relations.readMoreButton[data-b='+Rimage_id+']');
          relationButton.attr('data-r',data.relations);

        }else{
          alert(data.err_msg);
        }
      },"JSON");
    }
  });
  //showGlobalInfo("Done");
  $('.relations').click(function(event){
    event.preventDefault();
    event.stopPropagation();
    var id=$(this).attr('data-b');
    var relationData= $(this).attr('data-r');

    var relationDataObj=jQuery.parseJSON(relationData);
    $('#Rimage_id').val(id);
    $('.topCover').show();
    if(relationDataObj.error != 0){
      $('.data_T tbody').html("<tr><td colspan='3'>No Relations</td></tr>");
    }else{
      var count= Object.keys(relationDataObj).length;
      var i=0;
      for(i; i < count-1; i++){
        var relation_id=relationDataObj[i].relation_enconded_id;
        var relative=relationDataObj[i].relative_id;
        var mode=getModeNameById(relationDataObj[i].mode);

        if(i == 0){
          $('.data_T tbody').html("<tr id="+relation_id+"><td>"+mode+"</td><td>"+relative+"</td><td><a class='delRelation' href='#' data="+relation_id+">Remove</a></td></tr>");
        }else{
          $('.data_T tbody').append("<tr id="+relation_id+"><td>"+mode+"</td><td>"+relative+"</td><td><a class='delRelation' href='#' data="+relation_id+">Remove</a></td></tr>");
        }
      }


    }


  });
  $('#saveRelation').click(function(event){
    event.preventDefault();
    event.stopPropagation();

    $('#relativeId').removeClass('err');
    $('#relativeMode').removeClass('err');

    var relativeMode=$('#relativeMode').val();
    var relativeId=$('#relativeId').val();
    var Rimage_id=$('#Rimage_id').val();
    var uid=$('#uid').val();
    var relationButton=$('.relations.readMoreButton[data-b='+Rimage_id+']');


    if(relativeMode != 0){
      if(relativeId != 0){
          $.post('request.php',{relativeMode:relativeMode, relativeId:relativeId, image_id:Rimage_id,uid:uid},function(data){

            if(data.error != 0){
              $('.relator.error').html(data.err_msg);

            }else{
              $('.topCover').hide();
              //alert(data.relations);
              relationButton.attr('data-r',data.relations);
              $('#relativeMode').val("0");
              $('#relativeId').val("");
              showGlobalInfo("Relation added successfully");
            }

          },"JSON");
      }else{
        $('.relator.error').html("Please put a valid relative id");
        $('#relativeId').addClass('err');
      }
    }else{
      $('.relator.error').html("Please select the mode");
      $('#relativeMode').addClass('err');
    }
    //alert(relativeMode+relativeId+Rimage_id);
  });
  $('#closeTopCover').click(function(event){
    event.preventDefault();
    event.stopPropagation();
    $('.topCover').hide();
    $('#relativeMode').val("0");
    $('#relativeId').val("");
  });

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
  function showGlobalInfo(text){

    $('.globalInfo').html(text).show();
    $('.globalInfo').fadeOut(5000);

  }
  function getModeNameById(mode){
    var returna;

    if(mode == 1){
      returna="Post";
    }else if(mode == 2){
      returna="News";
    }
    return returna;
  }
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
    <?php include("header.php"); ?>
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
        <div class="col-3">
        <div class="error" style="padding: 15px 0px;">
          <?php
          if(isset($_POST['imgDesc'],$_FILES['image'],$_POST['uid'])){
            $imagedesc=$_POST['imgDesc'];
            $image = $_FILES['image'];
            $uid= $_POST['uid'];

              uploadImage($image, $imagedesc);
          }
          ?>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="imgDesc" style="font-size:16; margin-bottom:5px;" placeholder="Description"/>
        <input type="file" name="image" style="font-size:16; margin-bottom:5px;" placeholder="Upload image"/>
        <input type="hidden" name="uid" value="<?php echo $uid; ?>" id="uid"/>
        <input type="submit" value="Upload">
      </form>
    </div>

          <?php
            $images=getImages(0,0);
            $count=count($images);

            for($i=0; $i < $count; $i++){
              $image=$images[$i]['img_name'];
              ?>
              <div class="col-3" style="height:250px; overflow:hidden; width:33%;">
                <div class="m90">
                <div style="height:80%; background:url(../images/<?php echo $image; ?>); background-size:cover;">
                  <!-- <img src="../images/<?php //echo $image; ?>" style="max-width:90%; max-height:100%;"/> -->
                </div>
                <div style="height:20%;">
                  <div style="background:#f25; background:transparent;">
                    <a href="#" class="relations readMoreButton" data-b="<?php echo $images[$i]['image_id'];?>" id="sendRelation" data-r='<?php echo getImageRelations($images[$i]['image_id'], true); ?>'>Add Relation</a>
                    <div class="clear"></div>
                  </div>
                </div>
                </div>
              </div>
              <?php
            }
          ?>
          <div class="clear"></div>
      </div>
    </div>
    <div class="topCover">
      <div class="popUpBox">
        <div style="background:#3F51B5; color:#FFF; padding:15px; font-weight: 500; font-size: 19px;">
          Relator
          <div class="right"><a href="#" id="closeTopCover">X</a></div>
          <div class="clear"></div>
        </div>
        <div style="padding:15px;">
          <table class="data_T" style="width:100%; text-align:center;">
          <thead>
            <tr>
              <td>Mode</td>
              <td>Relative Id</td>
              <td>Remove</td>
            </tr>
          </thead>
          <tbody>
          </tbody>
          </table>
        </div>
      <div style="padding:15px;">
        <div class="relator error"></div>
        <input type="hidden" id="Rimage_id" value="0"/>
        <select id="relativeMode">
          <option value="0">Choose relative type</option>
          <option value="1">Post</option>
          <option value="2">News</option>
        </select>
        Relative ID:<input type="text" class="short" id="relativeId" >
        <input type="hidden" value="<?php $uid; ?>" id="uid"/>
        <a href="#" id="saveRelation" class="readMoreButton small">Save Relation</a>
        <div class="clear"></div>
      </div>
      </div>
    </div>
    <div class="globalInfo">
      Image Relation Added
    </div>
</body>
</html>
