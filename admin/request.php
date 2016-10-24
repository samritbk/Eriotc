<?php
  include("functions.php");

  if(isset($_POST['username'], $_POST['password'])){
    $return=compareUserPassword($_POST['username'], $_POST['password'], true, true);
    echo $return;
  }else if(isset($_POST['aid'],$_POST['uid'],$_POST['editTitle'],$_POST['editText'])){
    echo editArticle($_POST['aid'],$_POST['editTitle'],$_POST['editText'],$_POST['uid']);
  }else if(isset($_POST['addTitle'], $_POST['addText'], $_POST['uid'])){
    echo writeArticle($_POST['addTitle'], $_POST['addText'], $_POST['uid']);
  }
?>
