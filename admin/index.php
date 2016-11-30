<?php
  include("functions.php");
?>
<html>
<head>
<!--// SITE META //-->
<meta charset="UTF-8" />
<link rel='stylesheet' href="../style.css" type='text/css' media='all' />
<script type="text/javascript" src="../js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="../js/string.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('#adminUser').focus();
  $('#adminBtn').click(function(event){
    event.preventDefault();
    event.stopPropagation();
    login();
  });
});
function login(){
      $('#adminBtn').attr('disabled',"disabled");
      $('#adminUser').removeClass('err');
      $('#adminUser').removeClass('err');
      var adminUser=trim($('#adminUser').val());
      var adminPass=trim($('#adminPass').val());
      if(adminUser != "" && adminPass != ""){
        if(adminUser.length > 3 && adminPass.length > 5){
          $.post('request.php',{username:adminUser,password:adminPass},function(data){
            if(data.error != 0){
              $('.error').html(data.err_msg);
            }else{

              window.location.href='home.php';
            }
          },"JSON");
        }else{
            if(adminUser.length <= 3){
              $('#adminUser').addClass('err');
            }
            if(adminPass.length < 6){
              $('adminPass').addClass('err');
            }

            $('.error').html("Username must be atleast 4 chars \n Password must be atleast 6 chars");
        }
      }else{
        $('.error').html("Fill in all the fields");
        if(adminUser == "")
          $('#adminUser').addClass('err');
        if(adminPass == "")
          $('#adminPass').addClass('err');
      }
      $('#adminBtn').removeAttr('disabled');
}
function log(a){
  console.log(a);
}
</script>
<div style="width:40%; margin:auto; margin-top:50px;">
  <div style="width:90%; margin:auto; min-height:300px; overflow:hidden; background:whitesmoke; border-radius:5px; border: 1px solid #CCC; box-shadow: 1px 2px 8px #CCC;">
  <div style="width:150px; margin:auto; margin-top:15px; height:150px;"><img src="../eotc-logo.png" width="150px"/></div>
  <h2 style="margin:auto; width:40%; text-align:center; margin-top:25px;">Login</h2>
  <div style="width:70%; margin:auto; margin-top:50px; ">
    <div class="error"></div>
    <form action="" method="post"  id="form" onsubmit="return false;">
      <input type="username" placeholder="username" id="adminUser" style="width:90%; margin:auto;"/><p/>
      <input type="password"  placeholder="password" id="adminPass" style="width:90%; margin:auto;"/><p/>
      <input type="submit" value="Login" id="adminBtn"/>
    </form>
  </div>
  </div>
</div>
</body>
</html>
