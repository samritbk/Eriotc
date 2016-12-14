<?php
function searchWebsite($searchTerm){
  $query=mysql_query("SELECT * FROM posts(post_id)");

  if($query){
    echo "OK";
  }else{
    echo "Ma";
  }
}
function searchArticles($searchTerm){
  $return=array();
  $searchTerm=trim($searchTerm);

  $query=mysql_query("SELECT * FROM articles WHERE article_title LIKE '%$searchTerm%'");

  if($query){
    $num_rows=mysql_num_rows($query);
    if($num_rows){
      while($rows=mysql_fetch_assoc($query)){
        $return[]=array(
          'article_id'=> $rows['article_id'],
          'article_title'=> $rows['article_title'],
          'article_text'=> $rows['article_text']
        );
      }
    }
  }else{
    $return['error']=1;
    $return['err_msg']="Database error";
  }
  return $return;
}
function searchPosts($searchTerm){
  $return=array();
  $searchTerm=trim($searchTerm);

  $query=mysql_query("SELECT * FROM posts WHERE post_title LIKE '%$searchTerm%'");

  if($query){
    $num_rows=mysql_num_rows($query);
    if($num_rows){
      while($rows=mysql_fetch_assoc($query)){
        $return[]=array(
          'post_id'=> $rows['post_id'],
          'post_title'=> $rows['post_title'],
          'post_text'=> $rows['post_text']
        );
      }
    }
  }else{
    $return['error']=1;
    $return['err_msg']="Database error";
  }
  return $return;
}
function searchNews($searchTerm){
  $return=array();
  $searchTerm=trim($searchTerm);

  $query=mysql_query("SELECT * FROM news WHERE news_title LIKE '%$searchTerm%'");

  if($query){
    $num_rows=mysql_num_rows($query);
    if($num_rows){
      while($rows=mysql_fetch_assoc($query)){
        $return[]=array(
          'news_id'=> $rows['news_id'],
          'news_title'=> $rows['news_title'],
          'news_text'=> $rows['news_text']
        );
      }
    }
  }else{
    $return['error']=1;
    $return['err_msg']="Database error";
  }
  return $return;
}

?>
