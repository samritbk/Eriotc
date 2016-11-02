<?php include_once("functions.php"); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div class="header">
<div style="width:90%; margin:auto; text-align:right; height:auto; color:#FFF;">
<div style="float:left;"><a href="admin/" class="lang">Login</a></div>
<a href="#" class="lang">ትግርኛ</a> | <a href="#" class="lang" style="font-size:14px;">English</a>
</div>
	<div style="background: #FFF; padding: 10px 0px;">
		<div style="width:90%; margin:auto;">
						<img src="eotc-logo.png" style="height:100px; float: left;">
						<div style="height: 100px;
    line-height: 100px; float:left;  margin-left: 20px;font-weight: 600;font-size: 26px;">ማሕበር ኪዳነ ምህረት - ካምፓላ</div>
						<div class="date" style="height: 100px;
    line-height: 100px; float:right;font-size: 19px; font-size: 18px;
    letter-spacing: 1;"></div>
						<div class="clear"></div>
  </div>
	<div class="clear"></div>
</div>
	<div class="nav" style="">
<div style="margin:auto; width:90%;">
		<ul>
			<a class="a" href="index.php"><li><div style="padding:0px 25px;">ቅድመ ገጽ</div></li></a>
			<a href="#">
				<li>
				<div style="padding:0px 25px;">ትምህርተ ሃይማኖት</div>
				<ul class="subnav">
					<a class="navLink" href="post.php?cat_id=1"><li style="position:relative;">
					5 አዕማደ ምስጢር
						<ul class="subsub" style="">
							<?php
								$posts=getPostsByCategory(1,0,1);
								$count=count($posts);
								for($i=0;$i < $count; $i++){
									?>
									<a href="post.php?post_id=<?php echo $posts[$i]['post_id']; ?>"><li><?php echo $posts[$i]['post_title']; ?></li></a>
									<?php
								}
							?>
						</ul>
				</li>
				</a>
					<li>7 ምስጢራተ ቤተክርስቲያን</li>
					<li>ካልኦት ትምህርትታት</li>
				</ul>
			</li>
		</a>
			<a href="#">
				<li><div style="padding:0px 25px;">ጸሎታት</div>
					<ul class="subnav" style="">
						<li>ገኣፖ
							<ul class="subsub">
								<li>adfsdfsa</li>
								<li>dafsdas</li>
								<li>dafsdsfa</li>
							</ul>
						</li>
						<li>ስድፍስ</li>
						<li>adfsdfsa</li>
					</ul>
				</li>
		</a>
			<a href="#"><li><div style="padding:0px 25px;">ስብከት ወንጌል</div></li></a>
			<a href="#"><li><div style="padding:0px 25px;">ነገረ ቅዱሳን</div></li></a>
			<a href="#"><li><div style="padding:0px 25px;">ስነ - ጽሑፍ</div></li></a>
			<a href="#"><li><div style="padding:0px 25px;">ሕቶን መልስን</div></li></a>
			<a href="#"><li><div style="padding:0px 25px;">ብዛዕባ ማሕበርና</div></li></a>
			<!-- <li id="date">7 መስከረም 2008 ዓ.ም.</li> -->
			<div class="clear"></div>
		</ul>
</div>
		<div class="menuDropDown">
			<div>
				<div class="left" style="width:33%;">a</div>
					<div class="left" style="width:33%;">a</div>
						<div class="left" style="width:33%;">a</div>
<div class="clear"></div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>
<link rel='stylesheet' href="style.css" type='text/css' media='all' />
<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
<link rel="stylesheet" href="css/jquery.calendars.picker.css">
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/jquery.plugin.js"></script>
<script src="js/jquery.calendars.js"></script>
<script src="js/js.js"></script>
<script src="js/jquery.calendars.plus.js"></script>
<script src="js/jquery.calendars.picker.js"></script>
<script src="js/jquery.calendars.ethiopian.js"></script>
<script type="text/javascript">

$( document ).ready(function() {
    console.log( "ready!" );
		var calender = $.calendars.instance('ethiopian');

		var d = calender.formatDate('DD ~ dd MM yyyy', calender.today());
		var a=$('.date');
		a.html(d);
		a.append(' ዓ.ም.');
});
function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
function subscribe(){
  var email = $('#emailid').val();
    if(email != ""){
      if(isEmail(email)){
        $.post('request.php',{email:email}, function(data){
          if(data.error != 0){
            $('#msg').removeClass("success").addClass("error").css('display','block');
            if(data.error_code == "0x0000"){
              $('#msg').html("ኢሜል ኣይተመዝገበን፥ ጽንህ ኢልኩም ፈትኑ");
            }else if(data.error_code == "0x0001"){
              $('#msg').html("ምዝጉባት ኢኩም");
            }
          }else{
            $('#msg').addClass("success").css('display','block');
            $('#msg').html("ኢሜል ተመዝጊቡ ኣሎ");
            $('#emailid').val("");
          }
        },"JSON");
        //$.base64.encode("");
      }else{
        $('#msg').addClass("error").css('display','block');
        $('#msg').html("ኢሜል ልክእ ኣይኮነን");
      }
    }else{
      $('#msg').addClass("error").css('display','block').fadeOut(5000);
      $('#msg').html("ኢሜል ኣይተመአን");
    }
}
$( document ).ready(function() {
  $('#btnid').click(function() {
    subscribe();
  });

  $('#emailid').keypress(function(event){
    if (event.which == 13) {
        subscribe();
    }
  });
	var calendar = $.calendars.instance('ethiopian');
	//$('#popupDatepicker').calendarsPicker({calendar: calendar});
	$('#inlineDatepicker').calendarsPicker({calendar:calendar});
	$('#date8').hover(function(){

	});
});
</script>
