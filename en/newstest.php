<?php
  include("connection/connect.php");
  include("functions/user.func.php");
  include("functions/news.func.php");


?>
  </br>
  <meta charset="UTF-8" />
  <p>
<?php

  if(isset($_POST['submit'])){
    if(isset($_POST['title']) && isset($_POST['news'])){
      $title=$_POST['title'];
      $news=nl2br($_POST['news']);
      $timestamp = time();
      $query= mysql_query("INSERT INTO news VALUES ('','$title','$news','1','$timestamp','$timestamp')");
    }
  }
?>
</br>
<form action="" method="post">
  <input type="text" name="title" placeholder="Title"></p>
  <textarea name="news" placeholder="Place News Here..." cols="150" rows="10"></textarea></p>
  <input type = "submit" name="submit" value="Submit"/>
 </form>
