var geezMonthName=['ጥሪ', 'የካቲት','መጋቢት', 'ሚያዝያ', 'ግንቦት', 'ሰነ', 'ሓምለ', 'ነሓሰ','መስከረም', 'ጥቅምቲ','ሕዳር', 'ታሕሳስ'];
var geezDateName=['ሰንበት', 'ሰኑይ', 'ሰሉስ', 'ረቡዕ', 'ሓሙስ', 'ዓርቢ', 'ቀዳም'];

$( document ).ready(function() {
    console.log( "ready!" );
		var calender = $.calendars.instance('ethiopian');
    
		var d = calender.formatDate('DD ~ dd MM yyyy', calender.today());
		var a=$('.date1');
		a.html(d);
		a.append(' ዓ.ም.');
    var b=$('.date2');
    var date=new Date();

    b.html(geezDateName[date.getDay()]+" ~ "+date.getDate()+" "+geezMonthName[date.getMonth()]+" "+date.getFullYear());

    $('#search').keypress(function(event){
      if (event.which == 13) {
        var s=$(this).val();
        window.location.href='search.php?s='+s;
      }
    });

    $('#btnid').click(function() {
      subscribe();
    });

    $('#emailid').keypress(function(event){
      if (event.which == 13) {
          subscribe();
      }
    });


    $('#suggId').click(function(){
        suggest();
    });

    $('#navToggle').click(function(event){
      event.preventDefault();
      if($('.nav').is(':hidden')){
        $('.nav').css('display','block');
      }else{
        $('.nav').attr('style',"");
      }
    });
  	var calendar = $.calendars.instance('ethiopian');
  	//$('#popupDatepicker').calendarsPicker({calendar: calendar});
  	$('#inlineDatepicker').calendarsPicker({calendar:calendar});
  	$('#date8').hover(function(){

  	});

});

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
function subscribe(){
  $('#emailid').removeClass('err');
  var email = $('#emailid').val();
    if(email != ""){
      if(isEmail(email)){
        $.post('request.php',{email:email}, function(data){
          if(data.error != 0){
            $('#msg').removeClass("success").addClass("error").css('display','block');
            if(data.error_code == "0x0000"){
              $('#msg').html("ኢሜል ኣይተመዝገበን፥ ጽንሕ ኢልኩም ፈትኑ");
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
        $('#msg').html("ኢሜል ልክዕ ኣይኮነን");
        $('#emailid').addClass('err');
      }
    }else{
      $('#emailid').addClass('err');
      $('#msg').addClass("error").css('display','block');
      $('#msg').html("ኢሜል ኣይተመልአን");
    }
}

function suggest(){
   var txtarea = $('#suggText').val();
   var txtmail = $('#suggEmail').val();

   $('#suggText').removeClass("err");
   $('#suggEmail').removeClass("err");

  if(txtarea != ""){
    if(txtmail != ""){
      if(isEmail(txtmail)){
          $.post('request.php',{txtarea:txtarea,txtmail:txtmail}, function(data){
           if(data.error != 0){
              $('#suggmsg').removeClass("success").addClass("error").css('display','block');
              $('#suggmsg').html("ኢሜል ኣይተመዝገበን፥ ጽንሕ ኢልኩም ፈትኑ");
           }else{
             $('#suggmsg').addClass("success").css('display','block');
             $('#suggmsg').html("ርእይቶኹም ተቐቢልናዮ ኣለና");
             $('#suggEmail').val("");
             $('#suggText').val("");
           }
         },"JSON");
        // alert("Good")
      }else{
        $('#suggmsg').removeClass("success").addClass("error").css('display','block');
        $('#suggmsg').html("ኢሜል ልክዕ ኣይኮነን");
        $('#suggEmail').addClass("err");
        //alert("Email Not Correct");
      }
    }else{
      $('#suggmsg').removeClass("success").addClass("error").css('display','block');
      $('#suggmsg').html("ኢሜል ኣይተመልአን");
      $('#suggEmail').addClass("err");
      //alert("fill out email");
    }
  }else{
  $('#suggmsg').addClass("error").css('display','block').fadeOut(10000);
  $('#suggmsg').html("ርእይቶ ወይ ሕቶ ኣይተመልአን");
  $('#suggText').addClass("err");
  //alert("Fill out text");
  }
}
