<?php
ini_set('session.cookie_httponly',true);
session_start();
include("../connection/connect.php");
include("../functions/user.func.php");
include("../functions/article.func.php");
include("../functions/post.func.php");
include("../functions/news.func.php");
include("../functions/image.func.php");
include("../functions/questions.func.php");


function restricted(){
  header("Location:index.php");
}
function noAuthorization(){
  header("Location:home.php");
}
?>
