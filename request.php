<?php
include("connection/connect.php");
include("functions/user.func.php");
include("functions/article.func.php");

if(isset($_POST['email'])){
  echo subscribe($_POST['email']);
}

?>
