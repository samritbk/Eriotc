<?php
  include("functions.php");

  if(isset($_POST['username'], $_POST['password'])){
    $return=compareUserPassword($_POST['username'], $_POST['password'], true, true);
    echo $return;
  }else if(isset($_POST['aid'],$_POST['uid'],$_POST['editTitle'],$_POST['editText'])){
    echo editArticle($_POST['aid'],$_POST['editTitle'],$_POST['editText'],$_POST['uid']);
  }else if(isset($_POST['addTitle'], $_POST['addText'], $_POST['uid'])){
    echo writeArticle($_POST['addTitle'], $_POST['addText'], $_POST['uid']);
  }else if(isset($_POST['nid'],$_POST['uid'],$_POST['editNewsTitle'],$_POST['editNewsText'])){
    echo editNews($_POST['nid'],$_POST['editNewsTitle'],$_POST['editNewsText'],$_POST['uid']);
  }else if(isset($_POST['addNewsTitle'], $_POST['addNewsText'], $_POST['uid'])){
    echo writeNews($_POST['addNewsTitle'], $_POST['addNewsText'], $_POST['uid']);}
  else if(isset($_POST['pid'],$_POST['uid'],$_POST['editTitle'],$_POST['editText'])){
    echo editPost($_POST['pid'],$_POST['editTitle'],$_POST['editText'],$_POST['uid']);
  }else if(isset($_POST['addPostTitle'], $_POST['addPostText'], $_POST['uid'], $_POST['catId'])){
    echo writePost($_POST['addPostTitle'],$_POST['addPostText'],$_POST['uid'],$_POST['catId']);
  }else if(isset($_POST['relativeMode'], $_POST['relativeId'], $_POST['image_id'], $_POST['uid'])){
    echo addImageRelation($_POST['image_id'],$_POST['relativeMode'],$_POST['relativeId'],$_POST['uid'],true);
  }else if(isset($_POST['encoded_relation_id'],$_POST['image_id'])){
    echo removeRelation($_POST['encoded_relation_id'],$_POST['image_id']);
  }else if(isset($_POST['sid'],$_POST['uid'],$_POST['editAnswerText'])){
    echo setAnswer($_POST['editAnswerText'],$_POST['sid'],$_POST['uid']);
  }
?>
