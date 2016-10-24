<?php
  function getArticle($article_id){ //array
    $return = array();
    $article_id=(int) $article_id;

    if($article_id != 0){

      $query= mysql_query("SELECT * FROM articles WHERE article_id=$article_id");
      $num_rows=mysql_num_rows($query);
        if($num_rows != 0){
          $row = mysql_fetch_assoc($query);
          $return['error']=0;
          $return['article_id'] = $row['article_id'];
          $return['article_title'] = $row['article_title'];
          $return['article_text'] = $row['article_text'];
          // $return['last_activity'] = $row['last_activity'];
        }else{
          $return['error']=1;
          $return['err_msg']="Can't find article";
        }
      }
        return $return;
  }
  function getArticleShort($article_id){ //array
    $return = array();
    $article_id=(int) $article_id;

    $query= mysql_query("SELECT article_text FROM articles WHERE article_id=$article_id");
    $num_rows=mysql_num_rows($query);
      if($num_rows != 0){
        $row = mysql_fetch_assoc($query);
        $return['error']=0;

        if(strlen($row['article_text']) > 500){

          $return['article_short'] = substr($row['article_text'], 0, 500)."...";
        }else{
          $return['article_short'] = $row['article_text'];

        }
        // $return['last_activity'] = $row['last_activity'];
      }else{
        $return['error']=1;
        $return['err_msg']="Can't find article";
      }
        return $return;
  }
  function writeArticle($article_title, $article_text, $article_author, $email_notification=0){
    $return=array();
    $article_title=nl2br(mysql_real_escape_string(addslashes(trim($article_title))));
    $article_text=nl2br($article_text);
    $article_text=mysql_real_escape_string(addslashes(trim($article_text)));
    $article_author=(int) $article_author;
    $timestamp = time();

    if($article_author != 0){
      $query= mysql_query("INSERT INTO articles(article_title,article_text,article_author_id,date_created,last_modified) VALUES ('$article_title','$article_text','$article_author','$timestamp','$timestamp')");
      if($query){
        $return['error']=0;
        $return['last_id']=mysql_insert_id();
      }else{
        $return['error']=0;
        $retutn['err_msg']="Database error. Please try again later";
      }
    }else{
      $return['error']=1;
      $return['err_msg']="User not verified";
    }
    return json_encode($return);
  }
  function editArticle($article_id,$article_title,$article_text,$articleEditor){
    $return=array();

    $article_title=nl2br(mysql_real_escape_string($article_title));
    $article_text=nl2br($article_text);
    $article_text=mysql_real_escape_string($article_text);

    $query=mysql_query("UPDATE articles SET article_title='$article_title', article_text='$article_text', article_author_id='$articleEditor' WHERE article_id='$article_id'");
    if($query){
      $return['error']=0;
    }else{
      $return['error']=1;
      $return['err_msg']="Edit couldn't be completed";
    }
    echo mysql_error();
    return json_encode($return);
  }
  function getArticles($limit=0, $order=0){
    $return=array();
    $limit=(int) $limit;
    $order=(int) $order;
    $addon="";

    $mainQuery = "SELECT * FROM articles";
    if($order != 0 && $limit != 0){
      $addon=" ORDER BY article_id ASC LIMIT $limit";
    }else if($order != 0 && $limit == 0){
      $addon=" ORDER BY article_id ASC";
    }else if($order == 0 && $limit != 0){
      $addon=" ORDER BY article_id DESC LIMIT $limit";
    }else if($order == 0 && $limit == 0){
        $addon=" ORDER BY article_id DESC";
    }
    $query=mysql_query($mainQuery.$addon);
    while($row=mysql_fetch_assoc($query)){
      $return[]=array(
        "article_id"=>$row['article_id'],
        "article_title"=>$row['article_title'],
        "article_text"=>$row['article_text'],
        "article_author_id"=>$row['article_author_id'],
        "date_created"=>$row['date_created'],
        "last_modified"=>$row['last_modified']);
    }

    return $return;
  }
 ?>
