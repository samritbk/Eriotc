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
    while($rows=mysql_fetch_assoc($query)){
      $rows=array(
        'article_id'=> $rows['article_id'],
        'article_title'=> $rows['article_title'],
        'article_text'=> $rows['article_text']
      );
    }
  }else{
    echo "Ma";
  }
}
?>
