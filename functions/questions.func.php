<?php
function getQn($sugid,$answer=false){ //array
  $return = array();
  $sugid=(int) $sugid;

  if($sugid != 0){

    $query= mysql_query("SELECT * FROM suggestionbx WHERE sugid=$sugid");
    $num_rows=mysql_num_rows($query);
      if($num_rows != 0){
        $row = mysql_fetch_assoc($query);
        $return['error']=0;
        $return['sugid'] = $row['sugid'];
        $return['suggest'] = $row['suggest'];
        $return['email'] = $row['email'];
        $return['timestamp'] = $row['timestamp'];

        $query1=mysql_query("SELECT * FROM answers WHERE sugid=$sugid");
        $num_rows=mysql_num_rows($query1);
        if($num_rows != 0){
          $row = mysql_fetch_assoc($query1);
          $return['answer_text'] = $row['answer_text'];
          $return['answer_date'] = $row['answer_date'];
        }
        else {
         $return['answer_text'] = "SASASASA";
        }
        // $return['last_activity'] = $row['last_activity'];
      }else{
        $return['error']=1;
        $return['err_msg']="Can't find article";
      }
    }
      return $return;
}

function getAns($sugid){ //array
  $return = array();
  $sugid=(int) $sugid;

  if($sugid != 0){

    $query= mysql_query("SELECT * FROM answers WHERE sugid=$sugid");
    $num_rows=mysql_num_rows($query);
      if($num_rows != 0){
        $row = mysql_fetch_assoc($query);
        $return['error']=0;
        $return['answer_id'] = $row['answer_id'];
        $return['sugid'] = $row['sugid'];
        $return['answer_text'] = $row['answer_text'];
        $return['answer_author_id'] = $row['answer_author_id'];
        $return['answer_date'] = $row['answer_date'];
        $return['last_modified'] = $row['last_modified'];
        // $return['email'] = $row['email'];
        // $return['last_activity'] = $row['last_activity'];
      }else{
        $return['error']=1;
        $return['err_msg']="Can't find Answer";
      }
    }
      return $return;
}

function getQns($limit=0, $order=0){
  $return=array();
  $limit=(int) $limit;
  $order=(int) $order;
  $addon="";

  $mainQuery = "SELECT * from suggestionbx";
  if($order !=0 && $limit !=0){
    $addon=" ORDER BY sugid ASC LIMIT $limit";
  }else if($order != 0 && $limit == 0){
    $addon=" ORDER BY sugid ASC";
  }else if($order == 0 && $limit != 0){
    $addon=" ORDER BY sugid DESC LIMIT $limit";
  }else if($order == 0 && $limit == 0){
      $addon=" ORDER BY sugid DESC";
  }
  $query=mysql_query($mainQuery.$addon);
  while($row=mysql_fetch_assoc($query)){
    $return[]=array(
      "sugid"=>$row['sugid'],
      "suggest"=>$row['suggest'],
      "email"=>$row['email'],
      "timestamp"=>$row['timestamp']);
      //"news_text"=>$row['news_text'],
      //"news_author_id"=>$row['news_author_id'],

    //  "last_modified"=>$row['last_modified']);
  }
  return $return;
}

function writeAnswer($answer_text, $answer_author, $answer_date){
  $return=array();
  $answer_text=nl2br($answer_text);
  $answer_text=mysql_real_escape_string(addslashes(trim($answer_text)));
  $answer_author=(int) $answer_author;
  $timestamp = time();

  if($answer_author != 0){
    $query= mysql_query("INSERT INTO answers(answer_text,answer_author_id,answer_date,last_modified)
    VALUES ('$answer_text','$article_author','$timestamp','$timestamp')");

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

function editAnswer($sugid){
  $return=array();
  $answer_text=nl2br($answer_text);
  $answer_text=mysql_real_escape_string($answer_text);

  $query=mysql_query("UPDATE answers SET  answer_text='$answer_text', answer_author_id='$answerEditor' WHERE sugid='$sugid'");
  if($query){
    $return['error']=0;
  }else{
    $return['error']=1;
    $return['err_msg']="Edit couldn't be completed";
  }
  //echo mysql_error();
  return json_encode($return);
}

function setAnswer($answer_text,$sugid,$uid){
        $return = array();
        $answer_text = nl2br($answer_text);
        //$answer_text = mysql_real_escape_string($answer_text);
        $sugid = (int)$sugid;
        $uid = (int) $uid;
        $timestamp = time();

        if($uid != 0){
        if(answerExists($sugid)){
          $query = mysql_query("UPDATE answers SET answer_text = '$answer_text' ,last_modified = '$timestamp' WHERE sugid='$sugid'");
          echo mysql_error();
          if($query){
            $return['error']=0;
          }else{
            $return['error']=1;
            $return['err_msg']="Database error :(";
          }
        }
        else{
          $query = mysql_query("INSERT into answers(sugid,answer_text,answer_author_id,answer_date,last_modified) VALUES('$sugid','$answer_text','$uid','$timestamp','$timestamp') ");
          echo mysql_error();
          if($query){
            $return['error']=0;
          }else{
            $return['error']=1;
            $return['err_msg']="Database error :(";
          }
        }
      }
      else {
          $return ['error'] = 1;
          $return ['err_msg'] = "Invalid User";
      }

      return json_encode($return);
}

function answerExists($sugid){
        $sugid = (int)$sugid;
        if($sugid !=0){
        $query = mysql_query("SELECT * FROM answers where sugid=$sugid");
        $num_rows = mysql_num_rows($query);
        if($num_rows != 0){
          return true;
        }
        else {
          return false;
        }
        }
         else{
           return false;
         }
}
?>
