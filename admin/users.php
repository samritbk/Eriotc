<?php
  include("functions.php");
  if(isset($_SESSION['uid']) && $_SESSION['uid'] != 0){
    $uid=$_SESSION['uid'];
    if($uid != 0){
      if(!isSuperAdmin($uid)){
        noAuthorization();
      }
    }else{
        restricted();
    }
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
  $.getScript("js/admin.js",function(){
    openPopUp();
    $('#closeTopCover').click(function(){
      closePopUp();
    });
  });
  $('#saveEdit').click(function(event){
    event.preventDefault();

    var username=$('#editUsername').val();
    var email=$('#editEmail').val();
    var fullname=$('#editFullname').val();
    var privilage=$('#editPrivilage').val();

    // TODO: make validation of the form
    if(username != "" && email != "" && fullname != "" && privilage != ""){

    }else{

    }
  });
  function removeErrors(){
    $('#editUsername').removeClass("err");
    $('#editFullname').removeClass("err");
    $('#editEmail').removeClass("err");
    $('#editPrivilage').removeClass("err");
  }
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
        <h3 id="users">Users</h3>
        <div style="margin:20px 0px;"><a href="addArticle.php" class="button">Add User</a></div>
        <table class="data_T" style="width:100%;">
            <thead style="text-align:center;">
              <td>User id</td><td>Username</td><td>fullname</td><td>Email</td><td>Edit</td>
            </thead>
            <tbody>
              <?php
                $users=getUsers();
                $count=count($users);
                for($i=0; $i < $count; $i++){
              ?>
              <tr>
                <td><?php echo $users[$i]['user_id'] ?></td>
                <td><?php echo $users[$i]['username'] ?></td>
                <td><?php echo $users[$i]['fullname'] ?></td>
                <td><?php echo $users[$i]['email'] ?></td>
                <td><a id="deactive">Edit</a></td>
              </tr>
              <?php } ?>
            </tbody>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <div class="topCover">
    <div class="popUpBox">
      <div style="background:#3F51B5; color:#FFF; padding:15px; font-weight: 500; font-size: 19px;">
        User Edit
        <div class="right"><a href="#" id="closeTopCover">X</a></div>
        <div class="clear"></div>
      </div>
      <div style="padding:15px;">
        <div class="error">Ok</div>
        <div class="left" style="width:40%;">
          <input type="text" placeholder="Username" id="editUsername"/></p>
          <input type="text" placeholder="Fullname" id="editFullname"/></p>
        </div>
        <div class="left" style="width:50%;">
          <input type="text" placeholder="Email" id="editEmail"/></p>
          <input type="text" placeholder="{P}rivilage" id="editPrivilage"/></p>
        </div>
        <div class="clear"></div>
      </div>
    <div style="padding:15px;">
      <a href="#" id="saveEdit" class="readMoreButton small">Save Edit</a>
      <div class="clear"></div>
    </div>
  </div>
</body>
</html>
